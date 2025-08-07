import React from 'react';
import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';

interface Customer {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    customer_type: string;
    company_name?: string;
    status: string;
    created_at: string;
    vehicles?: Array<{
        make: string;
        model: string;
        year: number;
    }>;
    sales?: Array<{
        total_amount: number;
    }>;
}

interface CustomerStats {
    total_customers: number;
    active_customers: number;
    individual_customers: number;
    business_customers: number;
}

interface Props {
    customers: {
        data: Customer[];
        total: number;
        per_page: number;
        current_page: number;
    };
    stats: CustomerStats;
    [key: string]: unknown;
}

export default function Customers({ customers, stats }: Props) {
    const formatDate = (date: string) => {
        return new Date(date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
        });
    };

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

    const getTypeColor = (type: string) => {
        return type === 'individual' 
            ? 'bg-blue-100 text-blue-800' 
            : 'bg-purple-100 text-purple-800';
    };

    const getTotalSpent = (customer: Customer) => {
        return customer.sales?.reduce((total, sale) => total + sale.total_amount, 0) || 0;
    };

    return (
        <AppShell>
            <Head title="Customers - AutoPro" />
            
            <div className="space-y-8">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 flex items-center gap-3">
                            👥 Customers
                        </h1>
                        <p className="text-gray-600 mt-1">Manage your customer relationships</p>
                    </div>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-blue-600">{stats.total_customers}</div>
                        <div className="text-sm text-gray-600">Total Customers</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-green-600">{stats.active_customers}</div>
                        <div className="text-sm text-gray-600">Active Customers</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-purple-600">{stats.individual_customers}</div>
                        <div className="text-sm text-gray-600">Individual</div>
                    </div>
                    <div className="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                        <div className="text-2xl font-bold text-orange-600">{stats.business_customers}</div>
                        <div className="text-sm text-gray-600">Business</div>
                    </div>
                </div>

                {/* Customers Table */}
                <div className="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div className="px-6 py-4 border-b border-gray-200">
                        <h2 className="text-lg font-semibold text-gray-900">Customer Directory</h2>
                    </div>
                    
                    <div className="overflow-x-auto">
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vehicles
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Spent
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member Since
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {customers.data.map((customer) => (
                                    <tr key={customer.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm font-medium text-gray-900">
                                                {customer.first_name} {customer.last_name}
                                            </div>
                                            {customer.company_name && (
                                                <div className="text-sm text-gray-500">
                                                    {customer.company_name}
                                                </div>
                                            )}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900">{customer.email}</div>
                                            <div className="text-sm text-gray-500">{customer.phone}</div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getTypeColor(customer.customer_type)}`}>
                                                {customer.customer_type}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {customer.vehicles?.length || 0} vehicles
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {formatCurrency(getTotalSpent(customer))}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(customer.status)}`}>
                                                {customer.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {formatDate(customer.created_at)}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>

                    {customers.data.length === 0 && (
                        <div className="text-center py-12">
                            <div className="text-gray-500 text-lg">No customers found</div>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}