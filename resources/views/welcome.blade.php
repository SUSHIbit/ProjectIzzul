<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FYP Evaluation System') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-blue-100">
        <header class="container mx-auto px-4 py-6 flex justify-between items-center">
            <!-- App Logo -->
            <div class="flex items-center">
                <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.33l7 3.5v7.34l-7 3.5-7-3.5V7.83l7-3.5zm0 2.34L6.5 9 12 11.33 17.5 9 12 6.67zM6.5 11.67v3.66L11 17.5v-3.66l-4.5-2.17zm11 0L13 13.84v3.66l4.5-2.17v-3.66z"/>
                </svg>
                <span class="ml-2 text-xl font-semibold text-blue-800">FYP Evaluation System</span>
            </div>
            
            <!-- Login Button -->
            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Log in</a>
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <div class="container mx-auto px-4 py-16 flex flex-col items-center">
            <div class="text-center max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-900 mb-6">Final Year Project Evaluation System</h1>
                <p class="text-lg md:text-xl text-blue-700 mb-8">A streamlined platform for educators to upload, evaluate, and manage final year project submissions using standardized rubrics.</p>
                <div class="mt-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md text-lg transition duration-150 ease-in-out">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md text-lg transition duration-150 ease-in-out">Get Started</a>
                        @endauth
                    @endif
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="mt-12">
                <svg class="w-full max-w-2xl mx-auto text-blue-600 opacity-80" viewBox="0 0 900 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M450 0C201.472 0 0 201.472 0 450H900C900 201.472 698.528 0 450 0Z" fill="currentColor" fill-opacity="0.2"/>
                    <rect x="250" y="150" width="400" height="250" rx="20" fill="currentColor" fill-opacity="0.4"/>
                    <rect x="300" y="200" width="300" height="30" rx="5" fill="white"/>
                    <rect x="300" y="250" width="200" height="30" rx="5" fill="white"/>
                    <rect x="300" y="300" width="250" height="30" rx="5" fill="white"/>
                    <rect x="300" y="350" width="150" height="30" rx="5" fill="white"/>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>