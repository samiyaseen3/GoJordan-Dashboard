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
        $query = Booking::join('tours', 'bookings.tour_id', '=', 'tours.id')
                        ->where('bookings.is_deleted', false);
    
        // Get the filter option from the request (default is 'today')
        $filter = $request->input('filter', 'today'); 
    
        $startDate = Carbon::now();
        $endDate = Carbon::now();
    
        // Set the date range based on the selected filter
        if ($filter == 'today') {
            $startDate = $startDate->startOfDay();
            $endDate = $endDate->endOfDay();
        } elseif ($filter == 'month') {
            $startDate = $startDate->startOfMonth();
            $endDate = $endDate->endOfMonth();
        } elseif ($filter == 'year') {
            $startDate = $startDate->startOfYear();
            $endDate = $endDate->endOfYear();
        }
    
        // Apply the date range filter
        $query->whereBetween('bookings.booking_date', [$startDate, $endDate]);
    
        // Get the bookings within the filtered range
        $bookings = $query->get();
    
        // Calculate the total sales for confirmed bookings only
        $totalSales = $bookings->reduce(function ($carry, $booking) {
            // Only consider bookings where the status is 'Confirmed'
            if ($booking->booking_status == 'Confirmed') {
                return $carry + (($booking->tour ? $booking->tour->price : 0) * $booking->number_of_guests);
            }
            return $carry;
        }, 0); // Starting carry value is 0
    
        // Get the total number of users
        $totalUsers = User::count();
    
        // Calculate total revenue from all bookings
        $totalRevenue = $bookings->sum(function ($booking) {
            return $booking->tour ? $booking->tour->price * $booking->number_of_guests : 0;
        });
    
        // Get the total number of unique customers (distinct users)
        $totalCustomers = $bookings->unique('user_id')->count();
    
        // Prepare data for the chart
        $chartData = [
            'totalUsers' => $totalUsers,
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
        ];
    
        // Return the view with the chart data and filter
        return view('dashboard.index', compact('chartData', 'filter'));
    }
    

    

}
