<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTourController extends Controller
{
    public function showCategoryTours(Request $request, $categoryName)
    {
        // Get the category first
        $category = Category::where('name', $categoryName)->firstOrFail();
        
        $tours = Tour::whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->paginate(6);
    
        if ($request->ajax()) {
            return response()->json([
                'tours' => view('userside.partials.tour-cards', compact('tours'))->render(),
                'links' => $tours->links('vendor.pagination.custom')->render()
            ]);
        }
    
        return view('userside.category-tours', compact('tours', 'category'));
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


    public function showTourDetails($id) 
    {
        $tour = Tour::with(['images', 'dates' => function($query) {
            $query->where('availability', '>', 0);
        }])->findOrFail($id);
        return view('userside.tour-details', compact('tour'));
    }
    

 
}
