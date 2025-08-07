<?php

namespace Database\Factories;

use App\Models\CustomerVehicle;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $laborCost = fake()->numberBetween(50, 500);
        $partsCost = fake()->numberBetween(20, 800);
        $totalCost = $laborCost + $partsCost;
        
        return [
            'customer_vehicle_id' => CustomerVehicle::factory(),
            'technician_id' => User::factory(),
            'service_number' => 'SV' . fake()->unique()->numberBetween(100000, 999999),
            'service_type' => fake()->randomElement(['maintenance', 'repair', 'inspection', 'warranty']),
            'description' => fake()->sentences(2, true),
            'labor_cost' => $laborCost,
            'parts_cost' => $partsCost,
            'total_cost' => $totalCost,
            'service_date' => fake()->dateTimeBetween('-6 months', '+30 days'),
            'completion_date' => fake()->optional()->dateTimeBetween('now', '+60 days'),
            'status' => fake()->randomElement(['scheduled', 'in_progress', 'completed', 'cancelled']),
            'mileage_at_service' => fake()->numberBetween(10000, 200000),
            'next_service_date' => fake()->optional()->dateTimeBetween('+30 days', '+1 year'),
            'notes' => fake()->optional()->sentences(2, true),
        ];
    }
}