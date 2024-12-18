<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    public function showFullAdventureTours()
{
    // Retrieve all tours where the category name is 'Full-Adventure'
    $tours = Tour::whereHas('category', function ($query) {
        $query->where('name', 'Full-Adventure');
    })->get();

    return view('userside.source.destination', compact('tours'));
}
}
