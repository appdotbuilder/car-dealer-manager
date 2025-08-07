import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="AutoPro - Car Dealership Management">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col bg-gradient-to-br from-blue-50 to-indigo-100 text-gray-900">
                {/* Header */}
                <header className="w-full bg-white shadow-sm border-b border-gray-200">
                    <div className="max-w-7xl mx-auto px-6 py-4">
                        <nav className="flex items-center justify-between">
                            <div className="flex items-center gap-2">
                                <div className="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white text-xl font-bold">🚗</span>
                                </div>
                                <h1 className="text-2xl font-bold text-gray-900">AutoPro</h1>
                            </div>
                            
                            <div className="flex items-center gap-4">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="inline-flex items-center px-4 py-2 text-gray-700 hover:text-blue-600 transition-colors"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="inline-flex items-center px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium"
                                        >
                                            Register
                                        </Link>
                                    </>
                                )}
                            </div>
                        </nav>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="flex-1 flex flex-col">
                    <section className="flex-1 flex items-center justify-center px-6 py-12">
                        <div className="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
                            <div className="space-y-8">
                                <div className="space-y-4">
                                    <h1 className="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                                        🚗 Complete Car Dealership
                                        <span className="text-blue-600"> Management</span>
                                    </h1>
                                    <p className="text-xl text-gray-600 leading-relaxed">
                                        Streamline your automotive business with our comprehensive dealership management system. 
                                        Handle inventory, sales, services, and customers all in one place.
                                    </p>
                                </div>

                                <div className="flex flex-wrap gap-4">
                                    {auth.user ? (
                                        <Link
                                            href={route('dashboard')}
                                            className="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors text-lg font-semibold shadow-lg"
                                        >
                                            Go to Dashboard →
                                        </Link>
                                    ) : (
                                        <Link
                                            href={route('register')}
                                            className="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors text-lg font-semibold shadow-lg"
                                        >
                                            Get Started →
                                        </Link>
                                    )}
                                </div>
                            </div>

                            {/* Feature Preview */}
                            <div className="space-y-6">
                                <div className="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                                    <h3 className="text-lg font-semibold text-gray-900 mb-4">📊 Dashboard Overview</h3>
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="bg-blue-50 rounded-lg p-4 text-center">
                                            <div className="text-2xl font-bold text-blue-600">127</div>
                                            <div className="text-sm text-gray-600">Cars in Stock</div>
                                        </div>
                                        <div className="bg-green-50 rounded-lg p-4 text-center">
                                            <div className="text-2xl font-bold text-green-600">$2.4M</div>
                                            <div className="text-sm text-gray-600">Monthly Sales</div>
                                        </div>
                                        <div className="bg-purple-50 rounded-lg p-4 text-center">
                                            <div className="text-2xl font-bold text-purple-600">43</div>
                                            <div className="text-sm text-gray-600">Services Today</div>
                                        </div>
                                        <div className="bg-orange-50 rounded-lg p-4 text-center">
                                            <div className="text-2xl font-bold text-orange-600">856</div>
                                            <div className="text-sm text-gray-600">Happy Customers</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {/* Features Section */}
                    <section className="bg-white py-16">
                        <div className="max-w-7xl mx-auto px-6">
                            <div className="text-center mb-12">
                                <h2 className="text-3xl font-bold text-gray-900 mb-4">Everything You Need to Run Your Dealership</h2>
                                <p className="text-xl text-gray-600">Powerful features designed for modern car dealerships</p>
                            </div>

                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                                <div className="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                                    <div className="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">🚙</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Car Inventory Management</h3>
                                    <p className="text-gray-600">Track new and used vehicles, manage stock levels, and monitor vehicle history with detailed records.</p>
                                </div>

                                <div className="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                                    <div className="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">💰</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Sales Management</h3>
                                    <p className="text-gray-600">Handle car sales, financing, trade-ins, and track sales performance with comprehensive reporting.</p>
                                </div>

                                <div className="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                                    <div className="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">👥</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Customer Management</h3>
                                    <p className="text-gray-600">Maintain detailed customer profiles, vehicle history, and build lasting relationships.</p>
                                </div>

                                <div className="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                                    <div className="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">🔧</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Service Center</h3>
                                    <p className="text-gray-600">Schedule maintenance, track repairs, manage technicians, and maintain service records.</p>
                                </div>

                                <div className="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
                                    <div className="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">⚙️</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Spare Parts Inventory</h3>
                                    <p className="text-gray-600">Manage parts inventory, track stock levels, handle suppliers, and process parts sales.</p>
                                </div>

                                <div className="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 border border-indigo-200">
                                    <div className="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-white text-2xl">📊</span>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-2">Financial Reports</h3>
                                    <p className="text-gray-600">Generate balance sheets, profit & loss statements, and comprehensive financial analytics.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    {/* User Roles Section */}
                    <section className="bg-gray-50 py-16">
                        <div className="max-w-7xl mx-auto px-6">
                            <div className="text-center mb-12">
                                <h2 className="text-3xl font-bold text-gray-900 mb-4">Role-Based Access Control</h2>
                                <p className="text-xl text-gray-600">Tailored permissions for every team member</p>
                            </div>

                            <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center">
                                    <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">👨‍💼</span>
                                    </div>
                                    <h3 className="font-semibold text-gray-900 mb-2">Sales & Service Admin</h3>
                                    <p className="text-sm text-gray-600">Full system access and management capabilities</p>
                                </div>

                                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center">
                                    <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">💼</span>
                                    </div>
                                    <h3 className="font-semibold text-gray-900 mb-2">Sales Staff</h3>
                                    <p className="text-sm text-gray-600">Sales management and customer interaction</p>
                                </div>

                                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center">
                                    <div className="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">🔧</span>
                                    </div>
                                    <h3 className="font-semibold text-gray-900 mb-2">Workshop Head</h3>
                                    <p className="text-sm text-gray-600">Service center and maintenance operations</p>
                                </div>

                                <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-200 text-center">
                                    <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">📈</span>
                                    </div>
                                    <h3 className="font-semibold text-gray-900 mb-2">Branch Manager</h3>
                                    <p className="text-sm text-gray-600">Reports, analytics, and branch oversight</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-8">
                    <div className="max-w-7xl mx-auto px-6 text-center">
                        <p className="text-gray-400">
                            © 2024 AutoPro - Complete Car Dealership Management System
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}