<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
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
        $year = fake()->numberBetween(2015, 2024);
        $condition = fake()->randomElement(['new', 'used']);
        $purchasePrice = fake()->numberBetween(15000, 80000);
        
        return [
            'vin' => strtoupper(fake()->bothify('?#?######???????')),
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'color' => fake()->randomElement(['White', 'Black', 'Silver', 'Gray', 'Blue', 'Red', 'Green', 'Brown']),
            'condition' => $condition,
            'mileage' => $condition === 'new' ? 0 : fake()->numberBetween(5000, 150000),
            'fuel_type' => fake()->randomElement(['gasoline', 'diesel', 'electric', 'hybrid']),
            'transmission' => fake()->randomElement(['manual', 'automatic']),
            'doors' => fake()->randomElement([2, 4]),
            'engine_size' => fake()->randomElement(['1.8L', '2.0L', '2.4L', '3.0L', '3.5L', '4.0L', '5.0L']),
            'purchase_price' => $purchasePrice,
            'selling_price' => $purchasePrice * fake()->randomFloat(2, 1.1, 1.5),
            'purchase_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'sale_date' => null,
            'status' => fake()->randomElement(['available', 'reserved', 'sold', 'maintenance']),
            'description' => fake()->sentences(3, true),
            'features' => fake()->randomElements([
                'Air Conditioning', 'Power Windows', 'Power Locks', 'Cruise Control',
                'Bluetooth', 'Backup Camera', 'Navigation System', 'Leather Seats',
                'Sunroof', 'Heated Seats', 'Remote Start', 'Keyless Entry'
            ], fake()->numberBetween(3, 8)),
            'images' => null,
        ];
    }
}