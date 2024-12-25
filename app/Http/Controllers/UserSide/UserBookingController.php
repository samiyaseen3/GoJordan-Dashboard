<?php

namespace App\Http\Controllers\UserSide;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\TourDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {
        $tourId = $request->input('tour_id');
        $tourDateId = $request->input('tour_date_id');
        $tour = Tour::findOrFail($tourId);
        $tourDate = TourDate::findOrFail($tourDateId);
        $step = 1;
    
        return view('userside.booking', compact('tour', 'tourDate', 'step'));
    }

    public function storeGuests(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_date_id' => 'required|exists:tour_dates,id',
            'guests' => 'required|integer|min:1|max:6',
        ]);

        // Store booking data in session
        $request->session()->put('booking_data', [
            'user_id' => Auth::id(),
            'tour_id' => $request->tour_id,
            'tour_date_id' => $request->tour_date_id,
            'number_of_guests' => $request->guests
        ]);

        return redirect()->route('booking.payment.show');
    }

    public function showPayment(Request $request)
    {
        $bookingData = $request->session()->get('booking_data');
        if (!$bookingData) {
            return redirect()->route('booking.page');
        }

        $tour = Tour::findOrFail($bookingData['tour_id']);
        $tourDate = TourDate::findOrFail($bookingData['tour_date_id']);
        $step = 2;
        
        return view('userside.booking', compact('tour', 'tourDate', 'step', 'bookingData'));
    }
    public function processPayment(Request $request)
{
    try {
        $request->validate([
            'payment_method' => 'required|in:Credit Card,PayPal,Cash',
        ]);

        $bookingData = $request->session()->get('booking_data');
        if (!$bookingData) {
            return response()->json([
                'status' => 'error',
                'message' => 'Booking information not found. Please start over.'
            ], 400);
        }

        // Check for existing booking
        $existingBooking = Booking::where([
            'user_id' => $bookingData['user_id'],
            'tour_id' => $bookingData['tour_id'],
            'tour_date_id' => $bookingData['tour_date_id'],
        ])->first();

        if ($existingBooking) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already booked this tour.'
            ], 400);
        }

        \DB::beginTransaction();

        $tourDate = TourDate::lockForUpdate()->find($bookingData['tour_date_id']);
        
        if (!$tourDate) {
            \DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Tour date not found.'
            ], 400);
        }

        if ($tourDate->availability < 1) {
            \DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, this tour is fully booked.'
            ], 400);
        }

        $tourDate->decrement('availability', 1);

        $booking = Booking::create([
            'user_id' => $bookingData['user_id'],
            'tour_id' => $bookingData['tour_id'],
            'tour_date_id' => $bookingData['tour_date_id'],
            'number_of_guests' => $bookingData['number_of_guests'],
            'payment_method' => $request->payment_method,
            'payment_date' => now(),
            'booking_status' => 'Confirmed',
            'check_in_date' => null,
            'check_out_date' => null,
        ]);

        \DB::commit();
        $request->session()->forget('booking_data');

        return response()->json([
            'status' => 'success',
            'redirect' => route('booking.confirmation', ['booking_id' => $booking->id]),
            'message' => 'Your booking has been completed successfully!'
        ]);

    } catch (\Exception $e) {
        \DB::rollBack();
        \Log::error('Booking error: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while processing your booking. Please try again.'
        ], 500);
    }
}

    public function confirmation($booking_id)
    {
        $booking = Booking::with(['tour', 'tour_date'])->findOrFail($booking_id);
        return view('userside.booking-confirmation', compact('booking'));
    }
}