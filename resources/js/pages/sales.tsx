import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface Sale {
    id: number;
    sale_number: string;
    sale_date: string;
    total_amount: number;
    status: string;
    payment_method: string;
    car: {
        make: string;
        model: string;
        year: number;
        vin: string;
    };
    customer: {
        first_name: string;
        last_name: string;
        email: string;
    };
    sales_person: {
        name: string;
    };
}

interface SalesStats {
    total_sales: number;
    completed_sales: number;
    pending_sales: number;
    total_revenue: number;
    average_sale: number;
}

interface Props {
    sales: {
        data: Sale[];
        total: number;
        per_page: number;
        current_page: number;
    };
    stats: SalesStats;
    [key: string]: unknown;
}

export default function Sales({ sales, stats }: Props) {
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
            pending: 'bg-yellow-100 text-yellow-800',
            completed: 'bg-green-100 text-green-800',
            cancelled: 'bg-red-100 text-red-800',
        };
        return colors[status] || 'bg-gray-100 text-gray-800';
    };

    const getPaymentMethodColor = (method: string) => {
        const colors: Record<string, string> = {
            cash: 'bg-green-100 text-green-800',
            financing: 'bg-blue-100 text-blue-800',
            lease: 'bg-purple-100 text-purple-800',
        };
        return colors[method] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Sales - AutoPro" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            💰 Sales Management
                        </h1>
                        <p className="text-gray-600 mt-1">Track and manage vehicle sales</p>
                    </div>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.total_sales}</div>
                        <div className="text-sm text-gray-600">Total Sales</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{stats.completed_sales}</div>
                        <div className="text-sm text-gray-600">Completed</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-yellow-600">{stats.pending_sales}</div>
                        <div className="text-sm text-gray-600">Pending</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{formatCurrency(stats.total_revenue)}</div>
                        <div className="text-sm text-gray-600">Total Revenue</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-purple-600">{formatCurrency(stats.average_sale)}</div>
                        <div className="text-sm text-gray-600">Avg Sale</div>
                    </div>
                </div>

                {/* Sales Table */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h2 className="text-lg font-semibold text-gray-900">Sales History</h2>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sale #
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicle
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sales Person
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {sales.data.map((sale) => (
                                    <tr key={sale.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                            {sale.sale_number}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {sale.car.year} {sale.car.make} {sale.car.model}
                                            </div>
                                            <div className="text-sm text-gray-500">
                                                VIN: {sale.car.vin.substring(0, 10)}...
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {sale.customer.first_name} {sale.customer.last_name}
                                            </div>
                                            <div className="text-sm text-gray-500">
                                                {sale.customer.email}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {sale.sales_person.name}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {formatCurrency(sale.total_amount)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getPaymentMethodColor(sale.payment_method)}`}>
                                                {sale.payment_method}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(sale.status)}`}>
                                                {sale.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {formatDate(sale.sale_date)}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {sales.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-gray-500 text-lg">No sales found</div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}