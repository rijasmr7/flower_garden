<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Plant;
use Illuminate\Support\Facades\Storage;


class PlantController extends Controller
{
    public function show(){
        return view('admin.products');
    }
    // View all plants
    public function index() {
        $plants = Plant::all();
        return view('admin.plants.index', compact('plants'));
    }

    // Show form to add a plant
    public function create() {
        return view('admin.plants.create');
    }

    // Store new plant
    public function store(Request $request) {
        $validatedData = $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'size' => 'required|max:255',
        'description' => 'required',
        'category' => 'required',
        'is_available' => 'required|boolean',
        'quantity' => 'required|integer',
        'leave_color' => 'required|max:255',
        'purchased_date' => 'required|date',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle file upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('plants', 'public');
        $validatedData['image'] = $imagePath;
    }

    // Insert data into the database
    Plant::create($validatedData);

    return redirect()->route('admin.plants.index')->with('success', 'Plant added successfully!');
    }

    // Edit a plant
    public function edit(Plant $plant) {
        return view('admin.plants.edit', compact('plant'));
    }

    // Update plant details
    public function update(Request $request, Plant $plant) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'size' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'is_available' => 'required|boolean',
            'quantity' => 'required|integer',
            'leave_color' => 'required|max:255',
            'purchased_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $plant->image); 
            $data['image'] = $request->file('image')->store('plants', 'public');
        }

        $plant->update($data);

        return redirect()->route('admin.plants.index')->with('success', 'Plant updated successfully!');
    }

    // Delete a plant
    public function destroy(Plant $plant) {
        if ($plant->image) {
            Storage::delete('public/' . $plant->image); 
        }

        $plant->delete();
        return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully!');
    }

    //for users page
    public function showPlants() {
        $indoorPlants = Plant::where('category', 'indoor')->get();
        $outdoorPlants = Plant::where('category', 'outdoor')->get();
        
        return view('plants', compact('indoorPlants', 'outdoorPlants'));
    }
    
    public function showDetail($id){
    $plant = Plant::find($id);

    if (!$plant) {
        return redirect()->route('plants')->with('error', 'Plant not found.');
    }

    return view('productDetail', compact('plant'));
}

}
