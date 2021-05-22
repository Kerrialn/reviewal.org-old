<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'premise' => $this->faker->buildingNumber(),
            'floor' => $this->faker->numberBetween(0, 8),
            'line_one' => $this->faker->streetAddress(),
            'line_two' => $this->faker->secondaryAddress(),
            'district' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'country_code' => $this->faker->countryCode(),
        ];
    }
}
