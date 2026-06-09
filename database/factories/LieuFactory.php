<?php

namespace Database\Factories;

use App\Models\Lieuxmodel;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type;

/**
 * @extends Factory<Lieuxmodel>
 */
class LieuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
              'nom' => fake()->city(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'type_id'   => Type::inRandomOrder()->first()->id,
             'image'   => fake()->imageUrl(200, 200, 'abstract'),
            
            //
        ];
    }
}
