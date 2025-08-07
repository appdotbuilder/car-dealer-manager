import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface Service {
    id: number;
    service_number: string;
    service_date: string;
    service_type: string;
    description: string;
    total_cost: number;
    status: string;
    completion_date?: string;
    customer_vehicle: {
        make: string;
        model: string;
        year: number;
        vin: string;
        customer: {
            first_name: string;
            last_name: string;
        };
    };
    technician: {
        name: string;
    };
}

interface ServiceStats {
    total_services: number;
    scheduled: number;
    in_progress: number;
    completed: number;
    total_revenue: number;
}

interface Props {
    services: {
        data: Service[];
        total: number;
        per_page: number;
        current_page: number;
    };
    stats: ServiceStats;
    [key: string]: unknown;
}

export default function Services({ services, stats }: Props) {
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
            cancelled: 'bg-red-100 text-red-800',
        };
        return colors[status] || 'bg-gray-100 text-gray-800';
    };

    const getServiceTypeColor = (type: string) => {
        const colors: Record<string, string> = {
            maintenance: 'bg-blue-100 text-blue-800',
            repair: 'bg-orange-100 text-orange-800',
            inspection: 'bg-purple-100 text-purple-800',
            warranty: 'bg-green-100 text-green-800',
        };
        return colors[type] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Services - AutoPro" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            🔧 Service Center
                        </h1>
                        <p className="text-gray-600 mt-1">Manage vehicle maintenance and repairs</p>
                    </div>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.total_services}</div>
                        <div className="text-sm text-gray-600">Total Services</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.scheduled}</div>
                        <div className="text-sm text-gray-600">Scheduled</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-yellow-600">{stats.in_progress}</div>
                        <div className="text-sm text-gray-600">In Progress</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{stats.completed}</div>
                        <div className="text-sm text-gray-600">Completed</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{formatCurrency(stats.total_revenue)}</div>
                        <div className="text-sm text-gray-600">Revenue</div>
                    </div>
                </div>

                {/* Services Table */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h2 className="text-lg font-semibold text-gray-900">Service Records</h2>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Service #
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicle
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Service Type
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Technician
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cost
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
                                {services.data.map((service) => (
                                    <tr key={service.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                            {service.service_number}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {service.customer_vehicle.year} {service.customer_vehicle.make} {service.customer_vehicle.model}
                                            </div>
                                            <div className="text-sm text-gray-500">
                                                VIN: {service.customer_vehicle.vin.substring(0, 10)}...
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {service.customer_vehicle.customer.first_name} {service.customer_vehicle.customer.last_name}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getServiceTypeColor(service.service_type)}`}>
                                                {service.service_type}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {service.technician.name}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {formatCurrency(service.total_cost)}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(service.status)}`}>
                                                {service.status.replace('_', ' ')}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {formatDate(service.service_date)}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {services.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-gray-500 text-lg">No services found</div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}