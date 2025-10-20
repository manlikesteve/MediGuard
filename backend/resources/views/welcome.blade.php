<x-app-layout>
    <div class="text-center py-20">
        <h1 class="text-5xl font-bold text-indigo-700 mb-4">Welcome to MediGuard</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
            MediGuard is an AI-powered cyber threat detection system designed to protect digital health infrastructure
            against network-level attacks such as Denial-of-Service (DoS). Experience real-time visibility,
            secure data integrity, and reliable healthcare operations.
        </p>

        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="bg-white border border-indigo-600 text-indigo-700 px-6 py-3 rounded-lg hover:bg-indigo-50 transition">
                Login
            </a>
        </div>

        <div class="mt-12">
            <img src="{{ asset('images/security_dashboard.avif') }}" alt="Cybersecurity Illustration" class="mx-auto w-2/3 rounded-2xl shadow-lg border border-indigo-100">
        </div>
    </div>
</x-app-layout>