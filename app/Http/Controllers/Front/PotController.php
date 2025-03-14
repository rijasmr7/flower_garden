<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Pot;
use Illuminate\Support\Facades\Storage;

class PotController extends Controller
{
    public function show(){
        return view('admin.products');
    }

    // View all pots
    public function index() {
        $pots = Pot::all();
        return view('admin.pots.index', compact('pots'));
    }

    // Show form to add a pot
    public function create() {
        return view('admin.pots.create');
    }

    // Store new pot
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'size' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'is_available' => 'required|boolean',
            'quantity' => 'required|integer',
            'pot_color' => 'required|max:255',
            'purchased_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pots', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Insert data into the database
        Pot::create($validatedData);

        return redirect()->route('admin.pots.index')->with('success', 'Pot added successfully!');
    }

    // Edit a pot
    public function edit(Pot $pot) {
        return view('admin.pots.edit', compact('pot'));
    }

    // Update pot details
    public function update(Request $request, Pot $pot) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'size' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'is_available' => 'required|boolean',
            'quantity' => 'required|integer',
            'pot_color' => 'required|max:255',
            'purchased_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $pot->image); 
            $data['image'] = $request->file('image')->store('pots', 'public');
        }

        $pot->update($data);

        return redirect()->route('admin.pots.index')->with('success', 'Pot updated successfully!');
    }

    // Delete a pot
    public function destroy(Pot $pot) {
        if ($pot->image) {
            Storage::delete('public/' . $pot->image); 
        }

        $pot->delete();
        return redirect()->route('admin.pots.index')->with('success', 'Pot deleted successfully!');
    }

    // For users page
    public function showPots() {
        $pots = Pot::all();
        return view('pots', compact('pots'));
    }
    
    public function showDetail($id) {
        $pot = Pot::findOrFail($id);

        return view('potDetail', compact('pot'));
    }
}
