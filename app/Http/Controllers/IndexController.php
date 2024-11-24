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
    
       
        $filter = $request->input('filter', 'today'); 
    
        $startDate = Carbon::now();
        $endDate = Carbon::now();
    
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
    
       
        $query->whereBetween('bookings.booking_date', [$startDate, $endDate]);
    
        
        $bookings = $query->get();
    
        
        $totalSales = $bookings->reduce(function ($carry, $booking) {
            
            if ($booking->booking_status == 'Confirmed' && 'Completed') {
                return $carry + (($booking->tour ? $booking->tour->price : 0) * $booking->number_of_guests);
            }
            return $carry;
        }, 0); 
    
        
        $totalUsers = User::count();
    
        
        $totalRevenue = $bookings->sum(function ($booking) {
            return $booking->tour ? $booking->tour->price * $booking->number_of_guests : 0;
        });
    
       
        $totalCustomers = $bookings->unique('user_id')->count();
    
        
        $chartData = [
            'totalUsers' => $totalUsers,
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
        ];
    
        
        return view('dashboard.index', compact('chartData', 'filter'));
    }
    

    

}
