<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:500'
        ]);
    
        $review = Review::create([
            'user_id' => auth()->id(),
            'tour_id' => $validated['tour_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false
        ]);
    
        if($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Review submitted successfully'
            ]);
        }
    
        return redirect()->back()->with('success', 'Your review has been submitted and is pending approval.');
    }

    public function getApprovedReviews()
{
    return Review::where('is_approved', true)
                 ->with(['user', 'tour'])
                 ->latest()
                 ->take(5)  
                 ->get();
}
}
