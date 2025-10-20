<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-700 leading-tight">
            {{ __('MediGuard Security Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-indigo-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Overview Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Active Threats -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">Active Threats</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">3</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Monitored in real time from network logs.</p>
                </div>

                <!-- Alerts Reviewed -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-bell text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">Alerts Reviewed</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">27</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Analyst-verified alerts for the current week.</p>
                </div>

                <!-- System Status -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">System Status</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">Secure</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">All monitored systems are operational.</p>
                </div>
            </div>

            <!-- Live Network Activity -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Network Activity Overview</h3>
                    <span class="text-sm text-gray-500">Last updated: {{ now()->format('H:i A') }}</span>
                </div>

                <!-- Placeholder for real-time chart -->
                <div class="h-64 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 rounded-xl flex items-center justify-center text-gray-500 border border-indigo-50">
                    <p>📊 Real-time traffic analysis chart coming soon...</p>
                </div>
            </div>

            <!-- Recent Alerts -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Recent Security Alerts</h3>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm">
                        View All
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50 text-indigo-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Timestamp</th>
                                <th class="px-4 py-3 text-left">Alert Type</th>
                                <th class="px-4 py-3 text-left">Severity</th>
                                <th class="px-4 py-3 text-left">Source IP</th>
                                <th class="px-4 py-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                            <tr>
                                <td class="px-4 py-3">2025-10-20 11:32:45</td>
                                <td class="px-4 py-3">DoS Attempt</td>
                                <td class="px-4 py-3 text-red-600 font-semibold">High</td>
                                <td class="px-4 py-3">192.168.0.24</td>
                                <td class="px-4 py-3"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending Review</span></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">2025-10-20 10:55:10</td>
                                <td class="px-4 py-3">Port Scan</td>
                                <td class="px-4 py-3 text-yellow-600 font-semibold">Medium</td>
                                <td class="px-4 py-3">10.0.0.7</td>
                                <td class="px-4 py-3"><span class="px-3 py-1 bg-green-100 text-green-800 text-xs rounded-full">Resolved</span></td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">2025-10-20 09:47:22</td>
                                <td class="px-4 py-3">Abnormal Traffic Spike</td>
                                <td class="px-4 py-3 text-orange-600 font-semibold">Low</td>
                                <td class="px-4 py-3">172.16.5.33</td>
                                <td class="px-4 py-3"><span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Under Observation</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">
                    Welcome, {{ Auth::user()->name }}
                </h3>
                <p class="text-gray-700 leading-relaxed">
                    You are logged in as 
                    <span class="font-semibold text-indigo-600">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>. Use the dashboard to monitor threats, analyze reports, and ensure secure healthcare operations.
                </p>

                <div class="mt-6 flex space-x-4">
                    <a href="#" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Generate Security Report
                    </a>
                    <a href="#" class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 transition">
                        Manage Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
