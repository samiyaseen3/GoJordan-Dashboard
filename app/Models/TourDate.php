<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;

    public function tour()
    {
        return $this->belongsTo(Tour::class); 
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
