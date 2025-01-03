<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
            auth()->logout();
            return redirect()->route('userside.index')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }
    
        // Get popular tours
        $popularTours = Tour::with('category') 
            ->withCount('bookings') 
            ->orderBy('bookings_count', 'desc') 
            ->take(6) 
            ->get();
        
        // Get approved testimonials with user and tour information
        $testimonials = Review::with(['user', 'tour'])
            ->where('is_approved', true)
            ->where('rating', '>=', 4) // Only show reviews with 4 or 5 stars
            ->orderBy('created_at', 'desc')
            ->take(5) // Show latest 5 testimonials
            ->get();
    
        return view('userside.index', compact('popularTours', 'testimonials'));
    }
}