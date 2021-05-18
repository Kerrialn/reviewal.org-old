<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $appends = ['average'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageAttribute()
    {
        return [
            'ratings' => [
                'overall' => round(($this->reviews->avg('rating.landlord') + $this->reviews->avg('rating.premise') + $this->reviews->avg('rating.area') + $this->reviews->avg('rating.transport') + $this->reviews->avg('rating.noise')) / 5, 2),
                'landlord' => $this->reviews->avg('rating.landlord'),
                'premise' => $this->reviews->avg('rating.premise'),
                'area' => $this->reviews->avg('rating.area'),
                'transport' => $this->reviews->avg('rating.transport'),
                'noise' => $this->reviews->avg('rating.noise'),
            ]
        ];
    }
}