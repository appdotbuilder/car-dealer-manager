import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface SparePart {
    id: number;
    part_number: string;
    name: string;
    category: string;
    brand: string;
    cost_price: number;
    selling_price: number;
    quantity_in_stock: number;
    minimum_stock_level: number;
    status: string;
    location?: string;
    supplier?: string;
}

interface PartsStats {
    total_parts: number;
    active_parts: number;
    low_stock: number;
    total_value: number;
}

interface Props {
    parts: {
        data: SparePart[];
        total: number;
        per_page: number;
        current_page: number;
    };
    stats: PartsStats;
    [key: string]: unknown;
}

export default function SpareParts({ parts, stats }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        }).format(amount);
    };

    const getStatusColor = (status: string) => {
        return status === 'active' 
            ? 'bg-green-100 text-green-800' 
            : 'bg-red-100 text-red-800';
    };

    const getStockLevelColor = (quantity: number, minimum: number) => {
        if (quantity === 0) return 'bg-red-100 text-red-800';
        if (quantity <= minimum) return 'bg-yellow-100 text-yellow-800';
        return 'bg-green-100 text-green-800';
    };

    const getStockLevelText = (quantity: number, minimum: number) => {
        if (quantity === 0) return 'Out of Stock';
        if (quantity <= minimum) return 'Low Stock';
        return 'In Stock';
    };

    const getCategoryColor = (category: string) => {
        const colors: Record<string, string> = {
            'Engine': 'bg-blue-100 text-blue-800',
            'Transmission': 'bg-purple-100 text-purple-800',
            'Brakes': 'bg-red-100 text-red-800',
            'Suspension': 'bg-orange-100 text-orange-800',
            'Electrical': 'bg-yellow-100 text-yellow-800',
            'Body Parts': 'bg-gray-100 text-gray-800',
            'Interior': 'bg-indigo-100 text-indigo-800',
            'Filters': 'bg-green-100 text-green-800',
            'Fluids': 'bg-cyan-100 text-cyan-800',
            'Belts & Hoses': 'bg-pink-100 text-pink-800',
        };
        return colors[category] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Spare Parts - AutoPro" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            ⚙️ Spare Parts Inventory
                        </h1>
                        <p className="text-gray-600 mt-1">Manage parts inventory and stock levels</p>
                    </div>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.total_parts}</div>
                        <div className="text-sm text-gray-600">Total Parts</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{stats.active_parts}</div>
                        <div className="text-sm text-gray-600">Active Parts</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-red-600">{stats.low_stock}</div>
                        <div className="text-sm text-gray-600">Low Stock</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{formatCurrency(stats.total_value)}</div>
                        <div className="text-sm text-gray-600">Inventory Value</div>
                    </div>
                </div>

                {/* Low Stock Alert */}
                {stats.low_stock > 0 && (
                    <div className="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div className="flex items-center gap-2">
                            <div className="text-yellow-600">⚠️</div>
                            <div className="text-yellow-800">
                                <strong>{stats.low_stock}</strong> parts are running low on stock. Consider reordering soon.
                            </div>
                        </div>
                    </div>
                )}

                {/* Parts Table */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h2 className="text-lg font-semibold text-gray-900">Parts Inventory</h2>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Part Details
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Brand
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cost Price
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Selling Price
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stock Level
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {parts.data.map((part) => (
                                    <tr key={part.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {part.name}
                                            </div>
                                            <div className="text-sm text-gray-500">
                                                #{part.part_number}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getCategoryColor(part.category)}`}>
                                                {part.category}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {part.brand}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {formatCurrency(part.cost_price)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {formatCurrency(part.selling_price)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="flex items-center gap-2">
                                                <span className="text-sm font-medium text-gray-900">
                                                    {part.quantity_in_stock}
                                                </span>
                                                <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStockLevelColor(part.quantity_in_stock, part.minimum_stock_level)}`}>
                                                    {getStockLevelText(part.quantity_in_stock, part.minimum_stock_level)}
                                                </span>
                                            </div>
                                            <div className="text-xs text-gray-500">
                                                Min: {part.minimum_stock_level}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {part.location || 'N/A'}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(part.status)}`}>
                                                {part.status}
                                            </span>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {parts.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-gray-500 text-lg">No spare parts found</div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}