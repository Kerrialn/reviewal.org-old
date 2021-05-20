<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title',
        'summary',
        'user_id',
        'address_id'
    ];

    protected $with = ['rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
