<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with(['sale'])
            ->latest()
            ->paginate(20);

        $inventory_stats = [
            'new_cars' => Car::where('condition', 'new')->count(),
            'used_cars' => Car::where('condition', 'used')->count(),
            'available' => Car::where('status', 'available')->count(),
            'sold' => Car::where('status', 'sold')->count(),
            'in_maintenance' => Car::where('status', 'maintenance')->count(),
        ];

        return Inertia::render('inventory', [
            'cars' => $cars,
            'stats' => $inventory_stats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('cars/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store car logic here
        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return Inertia::render('cars/show', [
            'car' => $car,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return Inertia::render('cars/edit', [
            'car' => $car,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        // Update car logic here
        return redirect()->route('cars.show', $car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}