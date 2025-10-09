<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('MediGuard Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Card: Active Threats -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Active Threats</h3>
                            <p class="text-2xl font-bold text-gray-800">3</p>
                        </div>
                    </div>
                </div>

                <!-- Card: Alerts Reviewed -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-bell text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">Alerts Reviewed</h3>
                            <p class="text-2xl font-bold text-gray-800">27</p>
                        </div>
                    </div>
                </div>

                <!-- Card: System Status -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold">System Status</h3>
                            <p class="text-2xl font-bold text-gray-800">Secure</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Overview -->
            <div class="bg-white p-8 rounded-2xl shadow-md mb-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Network Activity Overview</h3>
                <div class="w-full h-64 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 rounded-xl flex items-center justify-center text-gray-500">
                    <p>📈 Analytics Graph Placeholder</p>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Welcome, {{ Auth::user()->name }}</h3>
                <p class="text-gray-700 leading-relaxed">
                    You are logged in as <span class="font-semibold text-indigo-600">{{ Auth::user()->role }}</span>.
                    Monitor, analyze, and respond to potential network anomalies in real-time using MediGuard’s intuitive dashboard.
                </p>

                <div class="mt-6">
                    <a href="#" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                        View Detailed Reports
                    </a>
                    <a href="#" class="ml-3 bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 transition">
                        Manage Settings
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
