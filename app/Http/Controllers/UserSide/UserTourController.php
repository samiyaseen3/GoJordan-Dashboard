<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTourController extends Controller
{
    public function showFullAdventureTours(Request $request)
    {

        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }
    
        $query = Tour::whereHas('category', function ($query) {
            $query->where('name', 'Full Adventure');
        });
    
        
        if ($request->has('title') && $request->get('title') !== '') {
            $query->where('title', 'like', '%' . $request->get('title') . '%');
        }
    
        $tours = $query->paginate(6);
    
        // Return the results as JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('userside.partials.tour-cards', compact('tours'))->render(),
                'links' => $tours->links('vendor.pagination.custom')->render()
            ]);
        }
    
        // For normal page loads
        return view('userside.full', compact('tours'));
    }
    

    
    

    public function showMiniAdventureTours(Request $request)
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }

        $tours = Tour::whereHas('category', function ($query) {
            $query->where('name', 'Mini Adventure');
        })->paginate(6);


       
    
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('userside.partials.tour-cards', compact('tours'))->render(),
                'links' => $tours->links('vendor.pagination.custom')->render()
            ]);
        }
    
        return view('userside.mini', compact('tours'));
    }

    public function showDayAdventureTours(Request $request)
    {

        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }

        $tours = Tour::whereHas('category', function ($query) {
            $query->where('name', 'Day Adventure');
        })->paginate(6);
    
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('userside.partials.tour-cards', compact('tours'))->render(),
                'links' => $tours->links('vendor.pagination.custom')->render()
            ]);
        }
    
        return view('userside.day', compact('tours'));
    }

    public function showAllAdventureTours(Request $request)
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }

        $tours = Tour::whereHas('category', function ($query) {
            
        })->paginate(6);
    
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('userside.partials.tour-cards', compact('tours'))->render(),
                'links' => $tours->links('vendor.pagination.custom')->render()
            ]);
        }
    
        return view('userside.all-tours', compact('tours'));
    }

    public function search(Request $request)
    {
        if (auth()->check() && auth()->user()->role == 'admin') {
           
            auth()->logout();
            
            return redirect()->route('admin.login')->with('message', 'You have been logged out because you tried to access the user homepage.');
        }
        
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        
        $query = $request->input('query');
        $tours = Tour::where('title', 'LIKE', "%{$query}%")->get();

        
        return view('userside.search-results', compact('tours', 'query'));
    }

    public function show($id)
    {
       
        $tour = Tour::with(['images', 'category', 'itineraries'])->findOrFail($id);
        return view('userside.tours-details', compact('tour'));
    }

 
}
