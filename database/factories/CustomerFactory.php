<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerType = fake()->randomElement(['individual', 'business']);
        
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->randomElement(['CA', 'NY', 'TX', 'FL', 'IL', 'PA', 'OH', 'MI', 'GA', 'NC']),
            'zip_code' => fake()->postcode(),
            'date_of_birth' => $customerType === 'individual' ? fake()->dateTimeBetween('-80 years', '-18 years') : null,
            'license_number' => $customerType === 'individual' ? fake()->bothify('##-###-####') : null,
            'customer_type' => $customerType,
            'company_name' => $customerType === 'business' ? fake()->company() : null,
            'notes' => fake()->optional()->sentences(2, true),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}