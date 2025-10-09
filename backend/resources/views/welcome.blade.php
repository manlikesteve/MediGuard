<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediGuard | Cyber Threat Detection for Digital Health</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-blue-100 text-gray-800">

    <!-- Hero Section -->
    <section class="flex flex-col items-center justify-center h-screen text-center px-6">
        <h1 class="text-5xl font-bold text-indigo-700 mb-4">MediGuard</h1>
        <p class="text-xl text-gray-600 mb-6 max-w-2xl">
            AI-driven Cyber Threat Detection System protecting digital health infrastructure from network-level attacks.
        </p>

        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Login
            </a>
            <a href="{{ route('register') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                Register
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold mb-10 text-indigo-700">Why Choose MediGuard?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <i class="fas fa-shield-alt text-indigo-600 text-4xl mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">AI-Powered Detection</h3>
                    <p>Automatically detect and isolate DoS and other network anomalies using Isolation Forest.</p>
                </div>
                <div>
                    <i class="fas fa-heartbeat text-indigo-600 text-4xl mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Healthcare-Safe</h3>
                    <p>Engineered for hospital environments — lightweight, private, and compliant with data protection laws.</p>
                </div>
                <div>
                    <i class="fas fa-chart-line text-indigo-600 text-4xl mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Real-Time Insights</h3>
                    <p>Stay informed with live monitoring dashboards and automatic alerting systems.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-700 text-white py-6 text-center">
        <p>© 2025 MediGuard | Strathmore University Capstone Project</p>
    </footer>
</body>
</html>
