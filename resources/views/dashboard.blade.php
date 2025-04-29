<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->isAdmin())
                        <!-- Admin Dashboard -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-blue-800 mb-4">Admin Dashboard</h3>
                            <p class="mb-6 text-gray-600">Welcome to the FYP Evaluation System admin panel. Here you can manage users, categories, and rubrics.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Users Management Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Users Management</h4>
                                    <p class="text-blue-600 mb-4">Manage system users and their roles</p>
                                    <a href="{{ route('users.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Manage Users</a>
                                </div>
                                
                                <!-- Categories Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Categories</h4>
                                    <p class="text-blue-600 mb-4">Create and manage document categories</p>
                                    <a href="{{ route('categories.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Manage Categories</a>
                                </div>
                                
                                <!-- Rubrics Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Rubrics</h4>
                                    <p class="text-blue-600 mb-4">Create and manage evaluation rubrics</p>
                                    <a href="{{ route('rubrics.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Manage Rubrics</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if(auth()->user()->isLecturer())
                        <!-- Lecturer Dashboard -->
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-blue-800 mb-4">Lecturer Dashboard</h3>
                            <p class="mb-6 text-gray-600">Welcome to the FYP Evaluation System. Here you can upload documents, evaluate them based on rubrics, and view evaluation summaries.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Documents Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Documents</h4>
                                    <p class="text-blue-600 mb-4">Upload and manage FYP documents</p>
                                    <a href="{{ route('documents.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Manage Documents</a>
                                </div>
                                
                                <!-- Evaluation Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 2h1.5v3l1-1c.17-.18.42-.29.68-.29h.01c.41 0 .65.24.89.48l.51.57c.35.41.29 1.03-.12 1.39L14.9 10.5l1.4 1.4c.37.37.37.96 0 1.33l-.93.94c-.37.37-.96.37-1.33 0L12 12l-1.04 1.17c-.37.37-.96.37-1.33 0L9 12.5c-.37-.37-.37-.96 0-1.33l1.04-1.17-1.04-1.17c-.37-.37-.37-.96 0-1.33l.69-.7c.17-.17.38-.29.62-.31.28-.02.55.08.75.27L12 8V5z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Evaluation</h4>
                                    <p class="text-blue-600 mb-4">Evaluate uploaded documents using rubrics</p>
                                    <a href="{{ route('marks.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">Evaluate Documents</a>
                                </div>
                                
                                <!-- Summary Card -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 hover:shadow-md transition duration-300">
                                    <div class="mb-4">
                                        <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-semibold text-blue-800 mb-2">Summary</h4>
                                    <p class="text-blue-600 mb-4">View evaluation summary and reports</p>
                                    <a href="{{ route('marks.summary') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">View Summary</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>