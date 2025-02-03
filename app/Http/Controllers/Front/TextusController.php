<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class TextusController extends Controller
{
    public function show()
    {
        return view('textus');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        
        $user = Auth::user();

        // Create a new inquiry entry in the database
        Inquiry::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'message' => $request->input('message'),
            'replies' => null, 
        ]);

       
        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully!');
    }

    //for admin
    public function view() {
        $inquiries = Inquiry::all();
        return view('admin.inquiries.index', compact('inquiries'));
    }

     // Delete a plant
     public function destroy(Inquiry $inquiry) {

        $inquiry->delete();
        return redirect()->route('admin.inquiries.index')->with('success', 'inquiry deleted successfully!');
    }
}
