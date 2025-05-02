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
    <div class="min-h-screen bg-gradient-to-b from-blue-50 to-blue-100 flex flex-col">
        <!-- Header Section -->
        <header class="w-full py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
            <div class="container mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0">
                <!-- App Logo -->
                <div class="flex items-center">
                    <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.33l7 3.5v7.34l-7 3.5-7-3.5V7.83l7-3.5zm0 2.34L6.5 9 12 11.33 17.5 9 12 6.67zM6.5 11.67v3.66L11 17.5v-3.66l-4.5-2.17zm11 0L13 13.84v3.66l4.5-2.17v-3.66z"/>
                    </svg>
                    <span class="ml-2 text-xl font-semibold text-blue-800">FYP Evaluation System</span>
                </div>
                
                <!-- Auth Buttons -->
                @if (Route::has('login'))
                    <div class="flex gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Log in</a>
                            <a href="{{ route('register') }}" class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Register</a>
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center px-4 py-8 sm:py-12 md:py-16">
            <div class="container mx-auto max-w-7xl">
                <div class="flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-16">
                    <!-- Text Content -->
                    <div class="w-full md:w-1/2 text-center md:text-left">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-blue-900 mb-4 sm:mb-6">
                            Final Year Project Evaluation System
                        </h1>
                        <p class="text-md sm:text-lg lg:text-xl text-blue-700 mb-6 sm:mb-8 max-w-2xl mx-auto md:mx-0">
                            A streamlined platform for educators to upload, evaluate, and manage final year project submissions using standardized rubrics.
                        </p>
                        <div class="mt-8">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md text-lg transition duration-150 ease-in-out inline-block">
                                        Go to Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-md text-lg transition duration-150 ease-in-out inline-block shadow-lg hover:shadow-xl">
                                        Get Started
                                    </a>
                                    <p class="mt-4 text-blue-600 text-sm">
                                        Streamline your project evaluation process today
                                    </p>
                                @endauth
                            @endif
                        </div>
                    </div>
                    
                    <!-- Hero Illustration -->
                    <div class="w-full md:w-1/2">
                        <div class="relative">
                            <!-- Background Circle -->
                            <div class="absolute inset-0 bg-blue-600 bg-opacity-10 rounded-full transform -translate-x-4 translate-y-4"></div>
                            
                            <!-- Main Illustration -->
                            <svg class="w-full max-w-lg mx-auto relative z-10" viewBox="0 0 900 600" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M450 0C201.472 0 0 201.472 0 450H900C900 201.472 698.528 0 450 0Z" fill="currentColor" fill-opacity="0.2" class="text-blue-600"/>
                                <rect x="250" y="150" width="400" height="250" rx="20" fill="currentColor" fill-opacity="0.3" class="text-blue-600"/>
                                <rect x="300" y="200" width="300" height="30" rx="5" fill="white"/>
                                <rect x="300" y="250" width="200" height="30" rx="5" fill="white"/>
                                <rect x="300" y="300" width="250" height="30" rx="5" fill="white"/>
                                <rect x="300" y="350" width="150" height="30" rx="5" fill="white"/>
                                <!-- Additional visual elements for depth -->
                                <circle cx="250" cy="450" r="40" fill="currentColor" fill-opacity="0.2" class="text-blue-600"/>
                                <circle cx="650" cy="150" r="30" fill="currentColor" fill-opacity="0.2" class="text-blue-600"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer Section -->
        <footer class="w-full py-6 px-4">
            <div class="container mx-auto text-center">
                <p class="text-blue-600 text-sm">
                    Simplify your evaluation process with standardized rubrics
                </p>
            </div>
        </footer>
    </div>
</body>
</html>