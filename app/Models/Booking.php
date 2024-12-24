<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id',
        'tour_date_id',
        'number_of_guests',
        'payment_method',
        'payment_date',
        'booking_status',
        'check_in_date',
        'check_out_date'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function tour_date()
    {
        return $this->belongsTo(TourDate::class);
    }
}