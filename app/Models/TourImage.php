<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;
    protected $table = 'tour_images';

    protected $fillable = ['tour_id', 'file_name'];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
