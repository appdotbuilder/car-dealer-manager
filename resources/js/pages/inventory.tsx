import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface Car {
    id: number;
    vin: string;
    make: string;
    model: string;
    year: number;
    color: string;
    condition: string;
    mileage: number;
    selling_price: number;
    status: string;
    purchase_date: string;
}

interface InventoryStats {
    new_cars: number;
    used_cars: number;
    available: number;
    sold: number;
    in_maintenance: number;
}

interface Props {
    cars: {
        data: Car[];
        total: number;
        per_page: number;
        current_page: number;
    };
    stats: InventoryStats;
    [key: string]: unknown;
}

export default function Inventory({ cars, stats }: Props) {
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
            available: 'bg-green-100 text-green-800',
            reserved: 'bg-yellow-100 text-yellow-800',
            sold: 'bg-blue-100 text-blue-800',
            maintenance: 'bg-red-100 text-red-800',
        };
        return colors[status] || 'bg-gray-100 text-gray-800';
    };

    const getConditionColor = (condition: string) => {
        return condition === 'new' 
            ? 'bg-blue-100 text-blue-800' 
            : 'bg-orange-100 text-orange-800';
    };

    return (
        <AppShell>
            <Head title="Car Inventory - AutoPro" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            🚗 Car Inventory
                        </h1>
                        <p className="text-gray-600 mt-1">Manage your vehicle inventory</p>
                    </div>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.new_cars}</div>
                        <div className="text-sm text-gray-600">New Cars</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-orange-600">{stats.used_cars}</div>
                        <div className="text-sm text-gray-600">Used Cars</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{stats.available}</div>
                        <div className="text-sm text-gray-600">Available</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.sold}</div>
                        <div className="text-sm text-gray-600">Sold</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-red-600">{stats.in_maintenance}</div>
                        <div className="text-sm text-gray-600">In Maintenance</div>
                    </div>
                </div>

                {/* Cars Table */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h2 className="text-lg font-semibold text-gray-900">Vehicle Inventory</h2>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicle
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        VIN
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Condition
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mileage
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Purchase Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {cars.data.map((car) => (
                                    <tr key={car.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {car.year} {car.make} {car.model}
                                            </div>
                                            <div className="text-sm text-gray-500">
                                                {car.color}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {car.vin}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getConditionColor(car.condition)}`}>
                                                {car.condition}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {car.mileage.toLocaleString()} mi
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {formatCurrency(car.selling_price)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(car.status)}`}>
                                                {car.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {formatDate(car.purchase_date)}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {cars.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-gray-500 text-lg">No cars found in inventory</div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}