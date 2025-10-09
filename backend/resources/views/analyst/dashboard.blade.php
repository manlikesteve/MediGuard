<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analyst Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Metrics Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <x-dashboard-card title="Processed Packets" icon="fa-network-wired" color="blue" value="1.2M" />
                <x-dashboard-card title="Anomalies Detected" icon="fa-bug" color="red" value="37" />
                <x-dashboard-card title="Anomaly Ratio" icon="fa-percentage" color="yellow" value="3.1%" />
            </div>

            <!-- Threat Log Section -->
            <div class="bg-white rounded-2xl shadow p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Recent Threat Alerts
                </h3>

                <table class="min-w-full text-sm text-left">
                    <thead>
                        <tr class="text-gray-600 border-b">
                            <th class="py-3">Timestamp</th>
                            <th class="py-3">Source IP</th>
                            <th class="py-3">Destination IP</th>
                            <th class="py-3">Threat Type</th>
                            <th class="py-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">2025-10-09 13:24</td>
                            <td>192.168.1.5</td>
                            <td>10.0.0.8</td>
                            <td><span class="text-red-600 font-semibold">DoS</span></td>
                            <td class="text-right">
                                <a href="#" class="text-indigo-600 hover:underline">Investigate</a>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">2025-10-09 12:58</td>
                            <td>192.168.1.22</td>
                            <td>10.0.0.2</td>
                            <td><span class="text-yellow-600 font-semibold">Suspicious</span></td>
                            <td class="text-right">
                                <a href="#" class="text-indigo-600 hover:underline">Investigate</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end">
                <a href="#" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Export Report
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
