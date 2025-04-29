<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluation History') }}: {{ $document->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    View Document
                </a>
                <a href="{{ route('marks.summary') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                    Back to Summary
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Document Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
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
                </div>
            </div>

            <!-- Evaluation History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">All Evaluations</h3>
                    
                    <div class="space-y-8">
                        @foreach ($document->marks_by_lecturer as $userId => $lecturerMarks)
                            @php $lecturer = $lecturerMarks->first()->user; @endphp
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <!-- Lecturer Header -->
                                <div class="bg-blue-50 p-4 border-b border-gray-200">
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                                        <div>
                                            <h4 class="text-md font-semibold text-blue-800">
                                                {{ $lecturer->name }}'s Evaluation
                                                @if($lecturer->id === auth()->id())
                                                    <span class="text-sm font-normal text-blue-600 ml-2">(You)</span>
                                                @endif
                                            </h4>
                                            <p class="text-sm text-gray-500">Evaluated on: {{ $lecturerMarks->first()->created_at->format('M d, Y, h:i A') }}</p>
                                        </div>
                                        <div class="mt-2 md:mt-0">
                                            <div class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                                                <span class="font-medium">Total Score: {{ $lecturerMarks->total_score }} / {{ $lecturerMarks->max_possible_score }}</span>
                                                <span class="ml-1 text-blue-600">({{ $lecturerMarks->score_percentage }}%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Evaluation Details -->
                                <div class="p-4 space-y-4">
                                    @foreach ($lecturerMarks->marks_by_rubric as $rubricId => $marks)
                                        @php $mark = $marks->first(); @endphp
                                        <div class="border border-gray-200 p-4 rounded-md">
                                            <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                                <div class="flex-1">
                                                    <h5 class="text-sm font-medium text-gray-700">{{ $mark->rubric->title }}</h5>
                                                    <p class="text-xs text-gray-500 mt-1">{{ $mark->rubric->description }}</p>
                                                </div>
                                                <div class="mt-2 md:mt-0 md:ml-4 text-right">
                                                    <span class="text-sm font-medium text-blue-600">
                                                        {{ $mark->score }} / {{ $mark->rubric->max_score }}
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($mark->feedback)
                                                <div class="mt-3 pt-3 border-t border-gray-200">
                                                    <h6 class="text-xs font-medium text-gray-700">Feedback:</h6>
                                                    <p class="text-xs text-gray-600 mt-1">{{ $mark->feedback }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Score Visualization -->
                                <div class="px-4 pb-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $lecturerMarks->score_percentage }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>