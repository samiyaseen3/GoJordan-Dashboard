<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\TourDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
   
  public function index()
    {
        $bookings = Booking::with(['tour', 'user'])->get();
        $totalPrice = $bookings->reduce(function ($carry, $booking) {
            return $carry + (($booking->tour ? $booking->tour->price : 0) * $booking->number_of_guests);
        }, 0);
    
        return view('admin.dashboard.booking', compact('bookings', 'totalPrice'));
    }

    public function updateStatus(Request $request, $id)
    {
        
        $request->validate([
            'status' => 'required|string|in:Pending,Confirmed,Cancelled,Completed',
        ]);
    
        
        $booking = Booking::findOrFail($id);
        $booking->booking_status = $request->status;
        $booking->save();
    
        
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'new_status' => $booking->booking_status,
        ]);
    }


    public function showBookingForm($tourId, $tourDateId)
    {
        $tour = Tour::findOrFail($tourId);
        $tourDate = TourDate::findOrFail($tourDateId);

        return view('userside.booking', compact('tour', 'tourDate'));
    }

    public function createBooking(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_date_id' => 'required|exists:tour_dates,id',
            'guests' => 'required|integer|min:1|max:6',
        ]);

        $tour = Tour::findOrFail($request->tour_id);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'tour_id' => $request->tour_id,
            'tour_date_id' => $request->tour_date_id,
            'booking_price' => $tour->price * $request->guests,
            'number_of_guests' => $request->guests,
        ]);

        return redirect()->route('payment.show', ['bookingId' => $booking->id])
            ->with('success', 'Booking created successfully. Proceed to payment.');
    }
    


}
