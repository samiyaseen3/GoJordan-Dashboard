<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
{
    // Initialize the query for bookings
    $query = Booking::join('tours', 'bookings.tour_id', '=', 'tours.id')
                    ->where('bookings.is_deleted', false);

    // Handle different time filters (today, this month, this year)
    $filter = $request->input('filter', 'today'); // Default filter is 'today'

    // Get the current date, month, and year
    $startDate = Carbon::now();
    $endDate = Carbon::now();

    // Set the date range for the filter
    if ($filter == 'today') {
        // For today
        $startDate = $startDate->startOfDay();
        $endDate = $endDate->endOfDay();
    } elseif ($filter == 'month') {
        // For this month
        $startDate = $startDate->startOfMonth();
        $endDate = $endDate->endOfMonth();
    } elseif ($filter == 'year') {
        // For this year
        $startDate = $startDate->startOfYear();
        $endDate = $endDate->endOfYear();
    }

    // Apply the date range filter to the bookings query
    $query->whereBetween('bookings.booking_date', [$startDate, $endDate]);

    // Get all the bookings for the selected filter
    $bookings = $query->get();

    // Calculate total sales (total revenue)
    $totalSales = $bookings->reduce(function ($carry, $booking) {
        // If a booking has a related tour and a valid price, calculate total price
        return $carry + (($booking->tour ? $booking->tour->price : 0) * $booking->number_of_guests);
    }, 0);

    // Get the total number of users (excluding deleted users)
    $totalUsers = User::count(); 

    // Calculate total revenue (sum of all bookings' revenue)
    $totalRevenue = $bookings->sum(function ($booking) {
        return $booking->tour ? $booking->tour->price * $booking->number_of_guests : 0;
    });

    // Count unique customers (users who made bookings)
    $totalCustomers = $bookings->unique('user_id')->count();

    // Prepare the data to pass to the view
    $chartData = [
        'totalUsers' => $totalUsers,
        'totalSales' => $totalSales,
        'totalRevenue' => $totalRevenue,
        'totalCustomers' => $totalCustomers,
    ];

    return view('dashboard.index', compact('chartData', 'filter'));
}

    

}
