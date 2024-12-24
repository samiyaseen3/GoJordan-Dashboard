<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'start_date', 'end_date', 'availability'];

    public function tour()
    {
        return $this->belongsTo(Tour::class); 
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
