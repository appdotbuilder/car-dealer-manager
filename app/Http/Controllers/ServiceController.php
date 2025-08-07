<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['customerVehicle.customer', 'technician'])
            ->latest('service_date')
            ->paginate(20);

        $service_stats = [
            'total_services' => Service::count(),
            'scheduled' => Service::where('status', 'scheduled')->count(),
            'in_progress' => Service::where('status', 'in_progress')->count(),
            'completed' => Service::where('status', 'completed')->count(),
            'total_revenue' => Service::where('status', 'completed')->sum('total_cost'),
        ];

        return Inertia::render('services', [
            'services' => $services,
            'stats' => $service_stats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('services/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store service logic here
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return Inertia::render('services/show', [
            'service' => $service->load(['customerVehicle.customer', 'technician']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return Inertia::render('services/edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Update service logic here
        return redirect()->route('services.show', $service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index');
    }
}