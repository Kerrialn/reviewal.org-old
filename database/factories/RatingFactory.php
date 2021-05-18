<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'landlord' => $this->faker->numberBetween(0, 5),
            'premise' => $this->faker->numberBetween(0, 5),
            'area' => $this->faker->numberBetween(0, 5),
            'transport' => $this->faker->numberBetween(0, 5),
            'noise' => $this->faker->numberBetween(0, 5),
            'overall' => $this->faker->numberBetween(0, 5),
            'review_id' => Review::factory(),
        ];
    }
}
