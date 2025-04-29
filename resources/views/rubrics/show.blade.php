<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rubric Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('rubrics.edit', $rubric) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    Edit
                </a>
                <a href="{{ route('rubrics.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900">Rubric Information</h3>
                        <div class="mt-4 bg-gray-50 p-4 rounded-md">
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Category</h4>
                                <p class="mt-1 text-lg">{{ $rubric->category->name }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Title</h4>
                                <p class="mt-1 text-lg">{{ $rubric->title }}</p>
                            </div>
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                <p class="mt-1">{{ $rubric->description }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Maximum Score</h4>
                                <p class="mt-1 text-lg font-semibold">{{ $rubric->max_score }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>