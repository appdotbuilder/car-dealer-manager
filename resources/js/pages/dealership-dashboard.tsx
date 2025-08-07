import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head, Link } from '@inertiajs/react';

interface DashboardStats {
    total_cars: number;
    available_cars: number;
    cars_sold_this_month: number;
    total_customers: number;
    total_revenue: number;
    monthly_revenue: number;
    pending_services: number;
    low_stock_parts: number;
}

interface RecentSale {
    id: number;
    sale_number: string;
    sale_date: string;
    total_amount: number;
    car: {
        make: string;
        model: string;
        year: number;
    };
    customer: {
        first_name: string;
        last_name: string;
    };
    sales_person: {
        name: string;
    };
}

interface RecentService {
    id: number;
    service_number: string;
    service_date: string;
    service_type: string;
    status: string;
    total_cost: number;
    customer_vehicle: {
        make: string;
        model: string;
        customer: {
            first_name: string;
            last_name: string;
        };
    };
    technician: {
        name: string;
    };
}

interface Props {
    stats: DashboardStats;
    recent_sales: RecentSale[];
    recent_services: RecentService[];
    monthly_sales_chart: Array<{
        month: number;
        count: number;
        revenue: number;
    }>;
    [key: string]: unknown;
}

export default function DealershipDashboard({ stats, recent_sales, recent_services }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(amount);
    };

    const formatDate = (date: string) => {
        return new Date(date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
        });
    };

    const getStatusColor = (status: string) => {
        const colors: Record<string, string> = {
            scheduled: 'bg-blue-100 text-blue-800',
            in_progress: 'bg-yellow-100 text-yellow-800',
            completed: 'bg-green-100 text-green-800',
            pending: 'bg-orange-100 text-orange-800',
        };
        return colors[status] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="AutoPro Dashboard" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            🚗 AutoPro Dashboard
                        </h1>
                        <p className="text-gray-600 mt-1">Welcome to your car dealership management system</p>
                    </div>
                </div>

                {/* Stats Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-blue-100 text-sm font-medium">Available Cars</p>
                                <p className="text-3xl font-bold">{stats.available_cars}</p>
                                <p className="text-blue-100 text-sm">of {stats.total_cars} total</p>
                            </div>
                            <div className="text-4xl opacity-80">🚙</div>
                        </div>
                    </div>

                    <div className="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-green-100 text-sm font-medium">Monthly Revenue</p>
                                <p className="text-3xl font-bold">{formatCurrency(stats.monthly_revenue)}</p>
                                <p className="text-green-100 text-sm">{stats.cars_sold_this_month} cars sold</p>
                            </div>
                            <div className="text-4xl opacity-80">💰</div>
                        </div>
                    </div>

                    <div className="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-purple-100 text-sm font-medium">Pending Services</p>
                                <p className="text-3xl font-bold">{stats.pending_services}</p>
                                <p className="text-purple-100 text-sm">scheduled</p>
                            </div>
                            <div className="text-4xl opacity-80">🔧</div>
                        </div>
                    </div>

                    <div className="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-orange-100 text-sm font-medium">Total Customers</p>
                                <p className="text-3xl font-bold">{stats.total_customers}</p>
                                {stats.low_stock_parts > 0 && (
                                    <p className="text-orange-100 text-sm">{stats.low_stock_parts} parts low stock</p>
                                )}
                            </div>
                            <div className="text-4xl opacity-80">👥</div>
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 className="text-xl font-semibold text-gray-900 mb-6">Quick Actions</h2>
                    <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <Link
                            href={route('inventory')}
                            className="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors"
                        >
                            <div className="text-2xl mb-2">🚗</div>
                            <span className="text-sm font-medium text-gray-900">Inventory</span>
                        </Link>
                        <Link
                            href={route('sales.index')}
                            className="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors"
                        >
                            <div className="text-2xl mb-2">💰</div>
                            <span className="text-sm font-medium text-gray-900">Sales</span>
                        </Link>
                        <Link
                            href={route('customers.index')}
                            className="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors"
                        >
                            <div className="text-2xl mb-2">👥</div>
                            <span className="text-sm font-medium text-gray-900">Customers</span>
                        </Link>
                        <Link
                            href={route('services.index')}
                            className="flex flex-col items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors"
                        >
                            <div className="text-2xl mb-2">🔧</div>
                            <span className="text-sm font-medium text-gray-900">Services</span>
                        </Link>
                        <Link
                            href={route('spare-parts.index')}
                            className="flex flex-col items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors"
                        >
                            <div className="text-2xl mb-2">⚙️</div>
                            <span className="text-sm font-medium text-gray-900">Parts</span>
                        </Link>
                        <div className="flex flex-col items-center p-4 bg-indigo-50 rounded-lg cursor-pointer hover:bg-indigo-100 transition-colors">
                            <div className="text-2xl mb-2">📊</div>
                            <span className="text-sm font-medium text-gray-900">Reports</span>
                        </div>
                    </div>
                </div>

                <div className="grid lg:grid-cols-2 gap-8">
                    {/* Recent Sales */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div className="flex items-center justify-between mb-6">
                            <h2 className="text-xl font-semibold text-gray-900">Recent Sales</h2>
                            <Link href={route('sales.index')} className="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View all →
                            </Link>
                        </div>
                        <div className="space-y-4">
                            {recent_sales.map((sale) => (
                                <div key={sale.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div className="flex-1">
                                        <div className="font-medium text-gray-900">
                                            {sale.car.year} {sale.car.make} {sale.car.model}
                                        </div>
                                        <div className="text-sm text-gray-600">
                                            {sale.customer.first_name} {sale.customer.last_name} • {formatDate(sale.sale_date)}
                                        </div>
                                        <div className="text-sm text-gray-500">
                                            Sales: {sale.sales_person.name}
                                        </div>
                                    </div>
                                    <div className="text-right">
                                        <div className="font-semibold text-green-600">
                                            {formatCurrency(sale.total_amount)}
                                        </div>
                                        <div className="text-xs text-gray-500">
                                            #{sale.sale_number}
                                        </div>
                                    </div>
                                </div>
                            ))}
                            {recent_sales.length === 0 && (
                                <div className="text-center py-8 text-gray-500">
                                    No recent sales found
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Recent Services */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div className="flex items-center justify-between mb-6">
                            <h2 className="text-xl font-semibold text-gray-900">Recent Services</h2>
                            <Link href={route('services.index')} className="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                View all →
                            </Link>
                        </div>
                        <div className="space-y-4">
                            {recent_services.map((service) => (
                                <div key={service.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div className="flex-1">
                                        <div className="font-medium text-gray-900">
                                            {service.customer_vehicle.make} {service.customer_vehicle.model}
                                        </div>
                                        <div className="text-sm text-gray-600">
                                            {service.customer_vehicle.customer.first_name} {service.customer_vehicle.customer.last_name} • {formatDate(service.service_date)}
                                        </div>
                                        <div className="text-sm text-gray-500">
                                            {service.technician.name}
                                        </div>
                                    </div>
                                    <div className="text-right">
                                        <div className="mb-1">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(service.status)}`}>
                                                {service.status.replace('_', ' ')}
                                            </span>
                                        </div>
                                        <div className="font-semibold text-gray-900">
                                            {formatCurrency(service.total_cost)}
                                        </div>
                                        <div className="text-xs text-gray-500">
                                            #{service.service_number}
                                        </div>
                                    </div>
                                </div>
                            ))}
                            {recent_services.length === 0 && (
                                <div className="text-center py-8 text-gray-500">
                                    No recent services found
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Financial Summary */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 className="text-xl font-semibold text-gray-900 mb-6">Financial Summary</h2>
                    <div className="grid md:grid-cols-3 gap-6">
                        <div className="text-center p-6 bg-green-50 rounded-lg">
                            <div className="text-3xl font-bold text-green-600">{formatCurrency(stats.total_revenue)}</div>
                            <div className="text-sm text-gray-600 mt-1">Total Revenue (All Time)</div>
                        </div>
                        <div className="text-center p-6 bg-blue-50 rounded-lg">
                            <div className="text-3xl font-bold text-blue-600">{formatCurrency(stats.monthly_revenue)}</div>
                            <div className="text-sm text-gray-600 mt-1">This Month's Revenue</div>
                        </div>
                        <div className="text-center p-6 bg-purple-50 rounded-lg">
                            <div className="text-3xl font-bold text-purple-600">{stats.cars_sold_this_month}</div>
                            <div className="text-sm text-gray-600 mt-1">Cars Sold This Month</div>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}