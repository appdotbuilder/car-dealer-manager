<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\SparePartSale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DealershipController extends Controller
{
    /**
     * Display the main dealership dashboard.
     */
    public function index()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'cars_sold_this_month' => Sale::whereRaw('strftime("%m", sale_date) = ?', [Carbon::now()->format('m')])->count(),
            'total_customers' => Customer::count(),
            'total_revenue' => Sale::where('status', 'completed')->sum('total_amount'),
            'monthly_revenue' => Sale::where('status', 'completed')
                ->whereRaw('strftime("%m", sale_date) = ?', [Carbon::now()->format('m')])
                ->sum('total_amount'),
            'pending_services' => Service::where('status', 'scheduled')->count(),
            'low_stock_parts' => SparePart::lowStock()->count(),
        ];

        $recent_sales = Sale::with(['car', 'customer', 'salesPerson'])
            ->latest('sale_date')
            ->take(5)
            ->get();

        $recent_services = Service::with(['customerVehicle.customer', 'technician'])
            ->latest('service_date')
            ->take(5)
            ->get();

        $monthly_sales_chart = Sale::selectRaw('strftime("%m", sale_date) as month, COUNT(*) as count, SUM(total_amount) as revenue')
            ->where('status', 'completed')
            ->whereRaw('strftime("%Y", sale_date) = ?', [Carbon::now()->year])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return Inertia::render('dealership-dashboard', [
            'stats' => $stats,
            'recent_sales' => $recent_sales,
            'recent_services' => $recent_services,
            'monthly_sales_chart' => $monthly_sales_chart,
        ]);
    }


}