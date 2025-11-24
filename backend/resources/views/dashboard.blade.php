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

                <div class="h-64 bg-gradient-to-r from-blue-100 via-indigo-100 to-purple-100 rounded-xl flex items-center justify-center text-gray-500 border border-indigo-50">
                    <p>📊 Real-time traffic analysis chart coming soon...</p>
                </div>
            </div>

            <!-- Real-time Prediction Test -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">Real-Time Anomaly Detection</h3>
                <p class="text-gray-600 mb-4">Enter a feature vector below to test the Isolation Forest model and detect potential threats.</p>

                <form id="predictForm">
                    <input type="text" id="featuresInput" 
                        class="w-full border border-indigo-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none" 
                        placeholder="e.g. 0.1,0.3,0.5,0.2,0.4,0.7,0.1,0.9,0.3,0.5">

                    <button type="submit" 
                        class="mt-4 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Predict using Isolation Forest Algorithm
                    </button>
                </form>

                <div id="predictionResult" class="mt-6 text-lg font-semibold text-gray-800"></div>

                <!-- Recent Predictions -->
                <div id="recentPredictions" class="mt-8">
                    <h4 class="text-md font-semibold text-indigo-700 mb-3">Recent Predictions</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-indigo-50 text-indigo-700 text-sm uppercase tracking-wider">
                                <tr>
                                    <th class="px-4 py-2 text-left">Timestamp</th>
                                    <th class="px-4 py-2 text-left">Prediction</th>
                                </tr>
                            </thead>
                            <tbody id="predictionTableBody" class="bg-white divide-y divide-gray-100 text-gray-700">
                                <tr><td colspan="2" class="px-4 py-3 text-center text-gray-400">No predictions yet.</td></tr>
                            </tbody>
                        </table>
                    </div>
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

    <script>
    const recentPredictions = [];

    document.getElementById('predictForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const input = document.getElementById('featuresInput').value.split(',').map(Number);
        const resultDiv = document.getElementById('predictionResult');
        const tableBody = document.getElementById('predictionTableBody');
        
        resultDiv.innerText = "🔍 Running prediction...";

        try {
            const response = await fetch('/predict', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ features: input })
            });

            const data = await response.json();
            const timestamp = new Date().toLocaleTimeString();
            const prediction = data.prediction || "Error";

            resultDiv.innerText = `🧩 Prediction Result: ${prediction}`;
            
            // Add to recent predictions
            recentPredictions.unshift({ time: timestamp, result: prediction });
            if (recentPredictions.length > 5) recentPredictions.pop();

            // Update the table dynamically
            tableBody.innerHTML = recentPredictions.map(p => `
                <tr>
                    <td class="px-4 py-2">${p.time}</td>
                    <td class="px-4 py-2 font-semibold ${p.result.includes('Anomaly') ? 'text-red-600' : 'text-green-600'}">
                        ${p.result}
                    </td>
                </tr>
            `).join('');

        } catch (err) {
            console.error(err);
            resultDiv.innerText = "⚠️ Error connecting to prediction service.";
        }
    });
    </script>
</x-app-layout>