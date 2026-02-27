<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_user'=>fake()->numberBetween(1,8),
            'to_user'=>fake()->numberBetween(1,8),
            'status'=>fake()->randomElement( ['accepted', 'refused', 'waiting']),
            'colocation_id'=>fake()->numberBetween(1,7),
        ];
    }
}
