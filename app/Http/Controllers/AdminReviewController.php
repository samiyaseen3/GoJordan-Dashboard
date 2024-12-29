<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'tour'])->latest()->get();
        return view('admin.dashboard.review', compact('reviews'));
    }

    public function updateApprovalStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->is_approved = $request->status;
        $review->save();

        return response()->json([
            'success' => true,
            'message' => 'Review status updated successfully'
        ]);
    }
    

    public function destroy($id)
{
    $review = Review::findOrFail($id);
    $review->delete();

    return response()->json([
        'success' => true,
        'message' => 'Review deleted successfully'
    ]);
}
}
