<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourDate;
use Illuminate\Http\Request;

class TourDateController extends Controller
{
    public function index()
    {
        $tourDates = TourDate::with('tour')->get(); // Eager load tour relationship
        return view('admin.dashboard.tour_dates', compact('tourDates'));
    }

    public function create()
    {
        $tours = Tour::all(); // Fetch all tours for selection
        return view('admin.tour_dates.create', compact('tours'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'tour_id' => 'required|exists:tours,id',
        'start_date' => [
            'required',
            'date',
            'after_or_equal:' . now()->format('Y-m-d'), // Ensure start_date is today or later
        ],
        'end_date' => [
            'required',
            'date',
            'after:start_date', // Ensure end_date is after start_date
        ],
        'availability' => 'required|integer|min:1',
    ], [
        'start_date.after_or_equal' => 'The start date must be today or a future date.',
        'end_date.after' => 'The end date must be after the start date.',
    ]);

    try {
        TourDate::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tour date added successfully!',
            'redirect' => route('tour_dates.index'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to add tour date. Please try again.',
        ], 500);
    }
}

    
public function edit($id)
{
    $tourDate = TourDate::find($id);
    $tours = Tour::all(); // Get all tours to display in the dropdown

    if (!$tourDate) {
        return redirect()->route('tour_dates.index')->with('error', 'Tour Date not found');
    }

    return view('admin.tour_dates.edit', compact('tourDate', 'tours'));
}

public function update(Request $request, $id)
{
    try {
        // Validate the input data
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'availability' => 'required|integer|min:1',
        ]);

        // Find the tour date to update
        $tourDate = TourDate::find($id);

        if (!$tourDate) {
            return response()->json([
                'success' => false,
                'message' => 'Tour Date not found'
            ], 404);
        }

        // Update the tour date
        $tourDate->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tour Date updated successfully',
            'redirect' => route('tour_dates.index')
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An unexpected error occurred'
        ], 500);
    }
}



    public function destroy($id)
    {
        $tourDate = TourDate::findOrFail($id);
        $tourDate->delete();
        return redirect()->route('tour_dates.index')->with('success', 'Tour date deleted successfully!');
    }
}
