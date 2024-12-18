<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the most popular tours based on bookings
        $popularTours = Tour::with('category') // Assuming there's a category relationship
            ->withCount('bookings') 
            ->orderBy('bookings_count', 'desc') 
            ->take(6) 
            ->get();

        return view('userside.index', compact('popularTours'));
    }
}
