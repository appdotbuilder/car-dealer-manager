<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salePrice = fake()->numberBetween(20000, 90000);
        $downPayment = $salePrice * fake()->randomFloat(2, 0.1, 0.3);
        $tradeInValue = fake()->randomFloat(2, 0, $salePrice * 0.4);
        $financingAmount = max(0, $salePrice - $downPayment - $tradeInValue);
        $taxAmount = $salePrice * 0.08; // 8% tax
        $totalAmount = $salePrice + $taxAmount;
        
        return [
            'car_id' => Car::factory(),
            'customer_id' => Customer::factory(),
            'sales_person_id' => User::factory(),
            'sale_number' => 'S' . fake()->unique()->numberBetween(100000, 999999),
            'sale_price' => $salePrice,
            'down_payment' => $downPayment,
            'trade_in_value' => $tradeInValue,
            'financing_amount' => $financingAmount,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'payment_method' => fake()->randomElement(['cash', 'financing', 'lease']),
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled']),
            'sale_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'delivery_date' => fake()->optional()->dateTimeBetween('now', '+30 days'),
            'notes' => fake()->optional()->sentences(2, true),
        ];
    }
}