<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin users with different roles
        $admin = User::factory()->create([
            'name' => 'John Manager',
            'email' => 'admin@autopro.com',
            'password' => Hash::make('password'),
            'role' => 'sales_admin',
            'phone' => '+1-555-0101',
            'address' => '123 Business Ave, City, ST 12345',
        ]);

        $salesStaff = User::factory()->create([
            'name' => 'Jane Sales',
            'email' => 'sales@autopro.com',
            'password' => Hash::make('password'),
            'role' => 'sales_staff',
            'phone' => '+1-555-0102',
            'address' => '456 Sales St, City, ST 12345',
        ]);

        $workshopHead = User::factory()->create([
            'name' => 'Mike Mechanic',
            'email' => 'workshop@autopro.com',
            'password' => Hash::make('password'),
            'role' => 'workshop_head',
            'phone' => '+1-555-0103',
            'address' => '789 Workshop Rd, City, ST 12345',
        ]);

        $branchManager = User::factory()->create([
            'name' => 'Sarah Branch',
            'email' => 'manager@autopro.com',
            'password' => Hash::make('password'),
            'role' => 'branch_manager',
            'phone' => '+1-555-0104',
            'address' => '321 Manager Blvd, City, ST 12345',
        ]);

        // Create additional users
        User::factory(10)->create();

        // Create customers
        Customer::factory(50)->create();

        // Create cars
        Car::factory(30)->create();

        // Create spare parts
        SparePart::factory(100)->create();

        // Create some sales
        Sale::factory(15)->create([
            'sales_person_id' => $salesStaff->id,
            'status' => 'completed',
        ]);

        Sale::factory(5)->create([
            'sales_person_id' => $admin->id,
            'status' => 'pending',
        ]);
    }
}
