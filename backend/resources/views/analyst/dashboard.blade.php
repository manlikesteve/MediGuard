<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-700 leading-tight">
            {{ __('MediGuard Analyst Console') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- 📊 Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="text-lg font-semibold text-gray-700">DoS Alerts</div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">12</div>
                    <div class="text-xs text-gray-500 mt-2">Detected in last 24 hours</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="text-lg font-semibold text-gray-700">Packets Analyzed</div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">48,392</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="text-lg font-semibold text-gray-700">False Positives</div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">2</div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition border border-indigo-100">
                    <div class="text-lg font-semibold text-gray-700">System Health</div>
                    <div class="text-3xl font-bold text-gray-900 mt-1">98%</div>
                </div>
            </div>

            <!-- 🧪 Model Testing Section -->
            <div class="bg-white p-8 rounded-2xl shadow-md border border-indigo-100">
                <h3 class="text-lg font-semibold text-indigo-700 mb-4">Real-Time Detection</h3>

                <!-- 🔹 Tabs -->
                <div class="border-b mb-4">
                    <nav class="flex space-x-4">
                        <button onclick="switchTab('iso', event)"
                            class="tab-btn active font-bold text-indigo-600">Isolation Forest</button>
                        <button onclick="switchTab('rf', event)"
                            class="tab-btn font-bold text-gray-500 hover:text-indigo-600">Random Forest</button>
                    </nav>
                </div>

                <!-- 🧬 Input for features -->
                <textarea id="featuresInput" rows="3" class="w-full border border-indigo-200 rounded-lg px-4 py-2"
                    placeholder="Enter 42 comma-separated values"></textarea>

                <!-- 🔘 Buttons per tab -->
                <div id="tab-iso" style="display:block;">
                    <button onclick="predict('/predict')" 
                        class="w-full bg-indigo-600 text-white px-5 py-2 rounded-lg mt-3 hover:bg-indigo-700 transition">
                        Predict Using Isolation Forest
                    </button>
                </div>

                <div id="tab-rf" class="hidden">
                    <button onclick="predict('/predict-rf')"
                        style="background-color:#16a34a !important; color:white !important;"
                        class="w-full bg-green-600 !important text-white px-5 py-2 rounded-lg mt-3 hover:bg-green-700 transition relative z-50">
                        Predict Using Random Forest
                    </button>
                </div>

                <div id="predictionResult" class="mt-6 text-lg font-semibold"></div>

                <!-- 📄 Recent Predictions Table -->
                <h4 class="mt-8 font-semibold text-indigo-700">Recent Predictions</h4>
                <table class="min-w-full divide-y divide-gray-200 mt-3">
                    <thead class="bg-indigo-50 text-indigo-700 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-2 text-left">Time</th>
                            <th class="px-4 py-2 text-left">Model</th>
                            <th class="px-4 py-2 text-left">Prediction</th>
                            <th class="px-4 py-2 text-left">Comment</th>
                        </tr>
                    </thead>
                    <tbody id="predictionTableBody" class="bg-white divide-y divide-gray-100 text-gray-700">
                        <tr><td colspan="4" class="px-4 py-3 text-center text-gray-400">No predictions yet.</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- 📝 Analyst Notes -->
            <div class="bg-white p-6 rounded-2xl shadow-md border border-indigo-100">
                <h3 class="text-lg font-semibold mb-4 text-indigo-700">Analyst Notes</h3>
                <textarea rows="4" class="w-full border border-indigo-200 rounded-lg px-4 py-2"
                    placeholder="Write your notes..."></textarea>
            </div>

        </div>
    </div>

    <!-- 🔧 JavaScript Logic -->
    <script>
        let recentPredictions = [];

        function switchTab(tab, event) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'text-indigo-600', 'font-bold', 'border-indigo-600', 'border-b-2');
                btn.classList.add('text-gray-500');
            });
            event.target.classList.add('active', 'text-indigo-600', 'font-bold', 'border-indigo-600', 'border-b-2');
            event.target.classList.remove('text-gray-500');

            document.getElementById('tab-iso').style.display = tab === 'iso' ? 'block' : 'none';
            document.getElementById('tab-rf').style.display = tab === 'rf' ? 'block' : 'none';
        }

        async function predict(endpoint) {
            const input = document.getElementById('featuresInput').value.split(',').map(Number);
            const resultDiv = document.getElementById('predictionResult');
            const tableBody = document.getElementById('predictionTableBody');

            if (input.length !== 42) {
                return resultDiv.innerHTML = "⚠️ Please enter exactly 42 comma-separated values.";
            }

            resultDiv.innerHTML = "⏳ Running prediction...";

            try {
                const response = await fetch('http://127.0.0.1:8005' + endpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ features: input })
                });

                const data = await response.json();
                const time = new Date().toLocaleTimeString();
                
                resultDiv.innerHTML = `🧠 <b>${data.model}</b> → ${data.prediction}<br>📝 ${data.comment}`;

                recentPredictions.unshift({ time, model: data.model, result: data.prediction, comment: data.comment });
                if (recentPredictions.length > 5) recentPredictions.pop();

                tableBody.innerHTML = recentPredictions.map(p => `
                    <tr>
                        <td class="px-4 py-2">${p.time}</td>
                        <td class="px-4 py-2">${p.model}</td>
                        <td class="px-4 py-2 font-semibold ${p.result.includes('Anomaly') || p.result.includes('Detected') ? 'text-red-600' : 'text-green-600'}">${p.result}</td>
                        <td class="px-4 py-2">${p.comment}</td>
                    </tr>`).join('');

            } catch (error) {
                resultDiv.innerHTML = "❌ Error communicating with model API.";
                console.error(error);
            }
        }
    </script>
</x-app-layout>