<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

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
    


}
