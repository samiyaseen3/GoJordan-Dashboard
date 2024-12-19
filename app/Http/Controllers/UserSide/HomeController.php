<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }
    
       
        $popularTours = Tour::with('category') 
            ->withCount('bookings') 
            ->orderBy('bookings_count', 'desc') 
            ->take(6) 
            ->get();
    
        
        return view('userside.index', compact('popularTours'));
    }
    
}
