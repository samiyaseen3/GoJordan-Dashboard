<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{


    public function about()
    {
           
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('userside.index')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }        
        return view('userside.about');
    }

    public function contact()
    {
           
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('userside.index')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }
    
      
        
        return view('userside.contact');
    }
}

