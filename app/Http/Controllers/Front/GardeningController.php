<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Gardening;
use Illuminate\Support\Facades\Auth;
class GardeningController extends Controller
{
    public function showForm()
    {
        return view('garden'); 
    }

    public function apply(Request $request)
    {
        
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gardening_date' => 'required|date',
        ]);

        
        $userId = Auth::id();

        // Create a new Gardening record
        $gardening = Gardening::create([
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gardening_date' => $request->gardening_date,
        ]);

        
        return redirect()->back()->with('success', 'Gardening request has been submitted successfully!');
    }

    //for admin
    public function view() {
        $gardens = Gardening::all();
        return view('admin.gardenings.index', compact('gardens'));
    }

     // Delete a plant
     public function destroy(Gardening $garden) {

        $garden->delete();
        return redirect()->route('admin.gardenings.index')->with('success', 'gardening service deleted successfully!');
    }
}
