<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'day_number',
        'location',
        'activity',
        'meal_plan',
    ];

    // Define the inverse relationship with Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
