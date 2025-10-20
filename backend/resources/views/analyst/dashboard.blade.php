<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-700 leading-tight">
            {{ __('MediGuard Analyst Console') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Overview Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- DoS Alerts Detected -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-red-100 text-red-600">
                            <i class="fas fa-bolt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">DoS Alerts</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Detected over the last 24 hours.</p>
                </div>

                <!-- Packets Analyzed -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-network-wired text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">Packets Analyzed</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">48,392</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Through the MediGuard IDS engine.</p>
                </div>

                <!-- False Positives -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">False Positives</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">2</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Pending analyst confirmation.</p>
                </div>

                <!-- System Health -->
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-heartbeat text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-700 font-semibold">System Health</h3>
                            <p class="text-3xl font-bold text-gray-900 mt-1">98%</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Detection system uptime.</p>
                </div>

            </div>

            <!-- Real-Time Traffic Analytics -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Real-Time Traffic Monitoring</h3>
                    <button class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Refresh
                    </button>
                </div>
                <div class="h-72 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 rounded-xl flex items-center justify-center text-gray-500 border border-indigo-50">
                    <p>📊 Live packet flow visualization coming soon...</p>
                </div>
            </div>

            <!-- Alerts Queue -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-indigo-700">Active Alert Queue</h3>
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm">
                        Resolve Selected
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50 text-indigo-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">#</th>
                                <th class="px-4 py-3 text-left">Timestamp</th>
                                <th class="px-4 py-3 text-left">Alert Type</th>
                                <th class="px-4 py-3 text-left">Source IP</th>
                                <th class="px-4 py-3 text-left">Severity</th>
                                <th class="px-4 py-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100 text-gray-700">
                            <tr>
                                <td class="px-4 py-3">1</td>
                                <td class="px-4 py-3">2025-10-20 14:05:13</td>
                                <td class="px-4 py-3">DoS Attempt</td>
                                <td class="px-4 py-3">192.168.1.5</td>
                                <td class="px-4 py-3 text-red-600 font-semibold">High</td>
                                <td class="px-4 py-3">
                                    <button class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-xs hover:bg-yellow-200">
                                        Review
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">2</td>
                                <td class="px-4 py-3">2025-10-20 13:49:37</td>
                                <td class="px-4 py-3">Unusual Traffic Spike</td>
                                <td class="px-4 py-3">10.0.0.45</td>
                                <td class="px-4 py-3 text-yellow-600 font-semibold">Medium</td>
                                <td class="px-4 py-3">
                                    <button class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-xs hover:bg-yellow-200">
                                        Review
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3">3</td>
                                <td class="px-4 py-3">2025-10-20 13:20:05</td>
                                <td class="px-4 py-3">New Device Connection</td>
                                <td class="px-4 py-3">172.16.5.17</td>
                                <td class="px-4 py-3 text-green-600 font-semibold">Low</td>
                                <td class="px-4 py-3">
                                    <button class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg text-xs hover:bg-yellow-200">
                                        Review
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Export Reports -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">Generate and Export Reports</h3>
                <p class="text-gray-700 leading-relaxed">
                    As an analyst, you can generate detailed logs and summaries of detected anomalies, export them as CSV or PDF,
                    and share them with administrators for further review.
                </p>
                <div class="mt-6">
                    <a href="#" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Export CSV
                    </a>
                    <a href="#" class="ml-3 bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 transition">
                        Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>