<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluate Document') }}: {{ $document->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    View Document
                </a>
                <a href="{{ route('marks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Document Information</h3>
                        <div class="mt-4 bg-gray-50 p-4 rounded-md">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Title</h4>
                                    <p class="mt-1">{{ $document->title }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Category</h4>
                                    <p class="mt-1">{{ $document->category->name }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Uploaded By</h4>
                                    <p class="mt-1">{{ $document->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('marks.store', $document) }}">
                        @csrf
                        
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900">Evaluation Rubrics</h3>
                            <p class="text-sm text-gray-500 mt-2">Please evaluate the document based on the rubrics below.</p>
                        </div>

                        @foreach ($rubrics as $rubric)
                            <div class="mb-8 p-4 border border-gray-200 rounded-lg">
                                <div class="mb-4">
                                    <h4 class="text-md font-medium text-gray-900">{{ $rubric->title }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">{{ $rubric->description }}</p>
                                    <p class="mt-1 text-xs text-gray-400">Maximum Score: {{ $rubric->max_score }}</p>
                                </div>
                                
                                <!-- Score Input -->
                                <div class="mb-4">
                                    <x-input-label for="score_{{ $rubric->id }}" :value="__('Score')" />
                                    <x-text-input 
                                        id="score_{{ $rubric->id }}" 
                                        class="block mt-1 w-full md:w-1/4" 
                                        type="number" 
                                        name="score_{{ $rubric->id }}" 
                                        :value="old('score_' . $rubric->id)" 
                                        min="0" 
                                        max="{{ $rubric->max_score }}"
                                        required 
                                    />
                                    <x-input-error :messages="$errors->get('score_' . $rubric->id)" class="mt-2" />
                                </div>
                                
                                <!-- Feedback Input -->
                                <div>
                                    <x-input-label for="feedback_{{ $rubric->id }}" :value="__('Feedback (Optional)')" />
                                    <textarea
                                        id="feedback_{{ $rubric->id }}"
                                        name="feedback_{{ $rubric->id }}"
                                        class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm block mt-1 w-full"
                                        rows="3"
                                    >{{ old('feedback_' . $rubric->id) }}</textarea>
                                    <x-input-error :messages="$errors->get('feedback_' . $rubric->id)" class="mt-2" />
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('marks.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                {{ __('Submit Evaluation') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>