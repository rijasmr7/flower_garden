<?php
namespace App\Http\Controllers\Front;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'review_for' => 'required|in:company,products,website,user_experience',
            'review' => 'required|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Add the user_id and save the review
        $review = new Review();
        $review->user_id = Auth::id(); // Assuming the user is authenticated
        $review->review_for = $validated['review_for'];
        $review->review = $validated['review'];
        $review->rating = $validated['rating'];

        // Save to database
        $review->save();

        // Redirect back with a success message
        return redirect()->route('home')->with('success', 'Thank you for your review!');
    }
}
