<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipments>
 */
class ShipmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'      => $this->faker->sentence(3),           // Naslov pošiljke
            'from_city'  => $this->faker->city,                  // Grad pošiljatelja
            'from_state' => $this->faker->state,                 // Država pošiljatelja
            'to_city'    => $this->faker->city,                  // Grad primaoca
            'to_state'   => $this->faker->state,                 // Država primaoca
            'price'      => $this->faker->numberBetween(10,500), // Cena
            'status'     => $this->faker->randomElement(['pending','shipped','delivered','canceled']), // Status
            'user_id' => \App\Models\User::factory(),
            'details'    => $this->faker->paragraph,            // Dodatni detalji
        ];
    }
}
