<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\SparePartSale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SparePartSale>
 */
class SparePartSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $unitPrice = fake()->numberBetween(10, 200);
        $totalAmount = $quantity * $unitPrice;
        
        return [
            'spare_part_id' => SparePart::factory(),
            'customer_id' => Customer::factory(),
            'sales_person_id' => User::factory(),
            'service_id' => fake()->optional()->randomElement([null, Service::factory()]),
            'invoice_number' => 'INV' . fake()->unique()->numberBetween(100000, 999999),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_amount' => $totalAmount,
            'sale_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'status' => fake()->randomElement(['pending', 'completed', 'returned']),
            'notes' => fake()->optional()->sentences(2, true),
        ];
    }
}