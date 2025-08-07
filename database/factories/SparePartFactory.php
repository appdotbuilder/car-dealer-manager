<?php

namespace Database\Factories;

use App\Models\SparePart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SparePart>
 */
class SparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Engine', 'Transmission', 'Brakes', 'Suspension', 'Electrical', 'Body Parts', 'Interior', 'Filters', 'Fluids', 'Belts & Hoses'];
        $brands = ['OEM', 'Bosch', 'ACDelco', 'Denso', 'NGK', 'Mobil 1', 'Castrol', 'Monroe', 'KYB', 'Brembo'];
        
        $category = fake()->randomElement($categories);
        $brand = fake()->randomElement($brands);
        $costPrice = fake()->numberBetween(10, 500);
        
        $partNames = [
            'Engine' => ['Oil Filter', 'Air Filter', 'Spark Plugs', 'Timing Belt', 'Water Pump'],
            'Transmission' => ['Transmission Fluid', 'Filter Kit', 'Solenoid', 'Gasket Set', 'Torque Converter'],
            'Brakes' => ['Brake Pads', 'Brake Discs', 'Brake Fluid', 'Brake Lines', 'Caliper'],
            'Suspension' => ['Shock Absorber', 'Strut Assembly', 'Spring', 'Ball Joint', 'Tie Rod End'],
            'Electrical' => ['Battery', 'Alternator', 'Starter Motor', 'Fuse', 'Wiring Harness'],
            'Body Parts' => ['Bumper', 'Headlight', 'Mirror', 'Door Handle', 'Grille'],
            'Interior' => ['Seat Cover', 'Floor Mat', 'Dashboard', 'Steering Wheel', 'Gear Knob'],
            'Filters' => ['Oil Filter', 'Air Filter', 'Cabin Filter', 'Fuel Filter', 'Transmission Filter'],
            'Fluids' => ['Engine Oil', 'Coolant', 'Brake Fluid', 'Power Steering Fluid', 'Transmission Fluid'],
            'Belts & Hoses' => ['Timing Belt', 'Serpentine Belt', 'Radiator Hose', 'Vacuum Hose', 'Fuel Line'],
        ];
        
        $name = fake()->randomElement($partNames[$category]);
        
        return [
            'part_number' => strtoupper(fake()->bothify('??-####-???')),
            'name' => $name,
            'description' => fake()->sentences(2, true),
            'category' => $category,
            'brand' => $brand,
            'cost_price' => $costPrice,
            'selling_price' => $costPrice * fake()->randomFloat(2, 1.3, 2.5),
            'quantity_in_stock' => fake()->numberBetween(0, 100),
            'minimum_stock_level' => fake()->numberBetween(5, 20),
            'supplier' => fake()->company(),
            'location' => fake()->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'Warehouse']),
            'status' => fake()->randomElement(['active', 'discontinued']),
        ];
    }
}