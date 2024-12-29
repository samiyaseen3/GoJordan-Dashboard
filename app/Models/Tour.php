<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Category;
use App\Models\TourDate;
use App\Models\TourImage;
use App\Models\TourItinerary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory , SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title', 'description', 'price', 'duration', 'category_id', 'start_date', 'end_date', 'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function itineraries(){
        return $this->hasMany(TourItinerary::class , 'tour_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tour_id');
    }

    public function dates()
    {
        return $this->hasMany(TourDate::class); // One tour has many tour dates
    }

    public function reviews()
{
    return $this->hasMany(Review::class)->where('is_approved', true);
}
}
