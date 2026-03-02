<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depense>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    'titre'=>fake()->name(),
    'montant'=>fake()->numberBetween(1,20000),
    'payer'=>fake()->numberBetween(1,20),
    'date'=>fake()->date(),
    'user_id'=>fake()->numberBetween(1,6),
    'status'=>fake()->randomElement(['payed','notpayed']),
    'categorie_id'=>fake()->numberBetween(1,6),
    'colocation_id'=>fake()->numberBetween(1,9),
        ];
    }
}
