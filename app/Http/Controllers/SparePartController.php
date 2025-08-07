<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parts = SparePart::latest()->paginate(20);

        $parts_stats = [
            'total_parts' => SparePart::count(),
            'active_parts' => SparePart::where('status', 'active')->count(),
            'low_stock' => SparePart::lowStock()->count(),
            'total_value' => SparePart::selectRaw('SUM(cost_price * quantity_in_stock) as total')->value('total'),
        ];

        return Inertia::render('spare-parts', [
            'parts' => $parts,
            'stats' => $parts_stats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('spare-parts/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store spare part logic here
        return redirect()->route('spare-parts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        return Inertia::render('spare-parts/show', [
            'spare_part' => $sparePart,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        return Inertia::render('spare-parts/edit', [
            'spare_part' => $sparePart,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        // Update spare part logic here
        return redirect()->route('spare-parts.show', $sparePart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();
        return redirect()->route('spare-parts.index');
    }
}