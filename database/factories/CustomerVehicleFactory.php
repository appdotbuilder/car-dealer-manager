<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerVehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerVehicle>
 */
class CustomerVehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $makes = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'BMW', 'Mercedes-Benz', 'Audi', 'Nissan', 'Hyundai', 'Volkswagen'];
        $models = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4', 'Highlander', 'Prius'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Insight'],
            'Ford' => ['F-150', 'Escape', 'Explorer', 'Mustang', 'Focus'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu', 'Traverse', 'Camaro'],
            'BMW' => ['3 Series', '5 Series', 'X3', 'X5', 'i3'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE', 'A-Class'],
            'Audi' => ['A4', 'A6', 'Q5', 'Q7', 'A3'],
            'Nissan' => ['Sentra', 'Altima', 'Rogue', 'Pathfinder', 'Leaf'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Ioniq'],
            'Volkswagen' => ['Jetta', 'Passat', 'Tiguan', 'Atlas', 'ID.4'],
        ];
        
        $make = fake()->randomElement($makes);
        $model = fake()->randomElement($models[$make]);
        
        return [
            'customer_id' => Customer::factory(),
            'vin' => strtoupper(fake()->bothify('?#?######???????')),
            'make' => $make,
            'model' => $model,
            'year' => fake()->numberBetween(2010, 2024),
            'color' => fake()->randomElement(['White', 'Black', 'Silver', 'Gray', 'Blue', 'Red', 'Green', 'Brown']),
            'mileage' => fake()->numberBetween(5000, 200000),
            'license_plate' => fake()->bothify('???-####'),
            'purchase_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'status' => fake()->randomElement(['active', 'sold', 'traded']),
            'notes' => fake()->optional()->sentences(2, true),
        ];
    }
}