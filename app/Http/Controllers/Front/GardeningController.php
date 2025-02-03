<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Gardening;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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

        
        $user = Auth::user();

        $customer = Customer::firstOrCreate(
            ['user_id' => $user->id], 
            [
                'first_name' => $user->name,
                'last_name' => $user->name,
                'email' => $user->email, 
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $user->city?? '',
                'province' => $user->province?? '',
                'district' => $user->district?? '',
                'postal_code' => $user->postal_code?? '',
            ]
        );
        // Create a new Gardening record
        Gardening::create([
            'customer_id' => $customer->id,
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
