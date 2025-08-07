<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['car', 'customer', 'salesPerson'])
            ->latest('sale_date')
            ->paginate(20);

        $sales_stats = [
            'total_sales' => Sale::count(),
            'completed_sales' => Sale::where('status', 'completed')->count(),
            'pending_sales' => Sale::where('status', 'pending')->count(),
            'total_revenue' => Sale::where('status', 'completed')->sum('total_amount'),
            'average_sale' => Sale::where('status', 'completed')->avg('total_amount'),
        ];

        return Inertia::render('sales', [
            'sales' => $sales,
            'stats' => $sales_stats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('sales/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store sale logic here
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return Inertia::render('sales/show', [
            'sale' => $sale->load(['car', 'customer', 'salesPerson']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return Inertia::render('sales/edit', [
            'sale' => $sale,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        // Update sale logic here
        return redirect()->route('sales.show', $sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index');
    }
}