<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {

        $tours = Tour::with(['images', 'category'])->withTrashed()->get();
    

        return view('dashboard.tour', compact('tours'));
    }
    public function showItinerary($tourId)
    {

        $tour = Tour::findOrFail($tourId);


        $itineraries = $tour->itineraries;


        return view('dashboard.itinerary', compact('tour', 'itineraries'));
    }

    public function create()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return the create view with categories
        return view('tour.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'itinerary' => 'required|array',
            'itinerary.*.day_number' => 'required|integer|min:1',
            'itinerary.*.location' => 'required|string',
            'itinerary.*.activity' => 'required|string',
            'itinerary.*.meal_plan' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        // Store the tour information
        $tour = Tour::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'category_id' => $validated['category_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        // Store images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('tour_images', 'public');
            }
        }

        // Store images for the tour
        foreach ($imagePaths as $path) {
            $tour->images()->create(['file_name' => $path]);
        }

        // Store itinerary
        if ($request->has('itinerary')) {
            foreach ($validated['itinerary'] as $item) {
                $tour->itineraries()->create([
                    'day_number' => $item['day_number'],
                    'location' => $item['location'],
                    'activity' => $item['activity'],
                    'meal_plan' => $item['meal_plan'] ?? null,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Tour created successfully!',
            'redirect' => route('tour.index'),
        ]);
    }

    public function edit(Tour $tour)
    {
        $categories = Category::all(); // Get all categories for the select dropdown
        return view('tour.edit', compact('tour', 'categories'));
    }

    public function update(Request $request, Tour $tour)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Validate image files
            'itinerary.*.day_number' => 'required|integer|min:1',
            'itinerary.*.location' => 'required|string',
            'itinerary.*.activity' => 'required|string',
            'itinerary.*.meal_plan' => 'nullable|string',
        ]);
    
        // Update the tour information
        $tour->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'category_id' => $validated['category_id'],
        ]);
    
        // Handle image upload and creation
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Prepend 'tour_images/' to the filename
                $filename = 'tour_images/' . time() . '_' . $image->getClientOriginalName();
        
                // Store the file using the modified $filename
                $imagePath = $image->storeAs('', $filename, 'public');
        
                // Save the image record in the `tour_images` table
                $tour->images()->create([
                    'file_name' => $filename, // Save full path in the database
                    'path' => $imagePath,     // The stored file path
                ]);
        
                // Debugging: Output the filename
                
            }
        }
      
    
        // Handle itinerary updates or new itineraries
        if ($request->has('itinerary')) {
            foreach ($request->itinerary as $itineraryData) {
                if (isset($itineraryData['id'])) {
                    // Update existing itinerary
                    $itinerary = $tour->itineraries()->find($itineraryData['id']);
                    if ($itinerary) {
                        $itinerary->update([
                            'day_number' => $itineraryData['day_number'],
                            'location' => $itineraryData['location'],
                            'activity' => $itineraryData['activity'],
                            'meal_plan' => $itineraryData['meal_plan'] ?? null,
                        ]);
                    }
                } else {
                    // Create a new itinerary
                    $tour->itineraries()->create([
                        'day_number' => $itineraryData['day_number'],
                        'location' => $itineraryData['location'],
                        'activity' => $itineraryData['activity'],
                        'meal_plan' => $itineraryData['meal_plan'] ?? null,
                    ]);
                }
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Tour created successfully!',
            'redirect' => route('tour.index'),
        ]);
    }
    
    public function deleteImage($tourId, $imageId)
{
    $tour = Tour::findOrFail($tourId);
    $image = $tour->images()->findOrFail($imageId);

    // Delete the image file from storage
    Storage::delete('public/' . $image->file_name);

    // Delete the image record from the database
    $image->delete();

    return redirect()->route('tour.edit', $tourId)->with('success', 'Image deleted successfully!');
}
    
    public function destroy($id)
{
 
    $tour = Tour::findOrFail($id);


    $tour->delete();


    return redirect()->route('tour.index')->with('success', 'Tour deleted successfully!');
}
    public function restore($id)
    {
        $tour = Tour::withTrashed()->findOrFail($id);
        $tour->restore();
    
        return redirect()->route('tour.index')->with('success', 'Tour restored successfully!');
    }
    
}
