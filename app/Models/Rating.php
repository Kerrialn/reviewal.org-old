<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected  $fillable = [
        'landlord',
        'premise',
        'area',
        'transport',
        'noise',
        'overall',
        'review_id'
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
