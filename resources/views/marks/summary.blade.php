<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluation Summary') }}
            </h2>
            <a href="{{ route('marks.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                Back to Evaluation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('marks.summary') }}">
                        <div class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
                            <!-- Category Filter -->
                            <div class="w-full md:w-1/3">
                                <x-input-label for="category_id" :value="__('Filter by Category')" />
                                <select 
                                    id="category_id" 
                                    name="category_id" 
                                    class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm block mt-1 w-full"
                                >
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Title Filter -->
                            <div class="w-full md:w-1/3">
                                <x-input-label for="title" :value="__('Filter by Title')" />
                                <x-text-input 
                                    id="title" 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    name="title" 
                                    :value="request('title')" 
                                    placeholder="Enter title keywords"
                                />
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="w-full md:w-auto">
                                <x-primary-button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700">
                                    {{ __('Filter Results') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Results Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Document Title
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Uploaded By
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Your Score
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Evaluations
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($documents as $document)
                                    @if ($document->marks->isNotEmpty())
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $document->title }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ $document->category->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ $document->user->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="text-sm font-medium text-blue-600">
                                                    {{ $document->total_score }} / {{ $document->max_possible_score }}
                                                    <span class="text-gray-500 ml-1">({{ $document->score_percentage }}%)</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $document->score_percentage }}%"></div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="text-sm text-gray-500">
                                                    {{ $document->marks_by_lecturer->count() }} lecturer(s)
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button 
                                                        type="button"
                                                        class="text-blue-600 hover:text-blue-900"
                                                        onclick="toggleDetails('details-{{ $document->id }}')"
                                                    >
                                                        View Details
                                                    </button>
                                                    <a 
                                                        href="{{ route('marks.history', $document) }}"
                                                        class="text-blue-600 hover:text-blue-900"
                                                    >
                                                        View Evaluation History
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="details-{{ $document->id }}" class="hidden bg-gray-50">
                                            <td colspan="6" class="px-6 py-4">
                                                <div class="mb-4">
                                                    <h4 class="text-sm font-medium text-gray-700">Your Evaluation Details</h4>
                                                </div>
                                                <div class="space-y-4">
                                                    @foreach ($document->marks_by_rubric as $rubricId => $marks)
                                                        @php $mark = $marks->first(); @endphp
                                                        <div class="border border-gray-200 p-4 rounded">
                                                            <div class="flex justify-between items-start">
                                                                <div>
                                                                    <h5 class="text-sm font-medium text-gray-700">{{ $mark->rubric->title }}</h5>
                                                                    <p class="text-xs text-gray-500 mt-1">{{ $mark->rubric->description }}</p>
                                                                </div>
                                                                <div class="text-right">
                                                                    <span class="text-sm font-medium text-blue-600">
                                                                        {{ $mark->score }} / {{ $mark->rubric->max_score }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @if ($mark->feedback)
                                                                <div class="mt-2 pt-2 border-t border-gray-200">
                                                                    <h6 class="text-xs font-medium text-gray-700">Feedback:</h6>
                                                                    <p class="text-xs text-gray-600 mt-1">{{ $mark->feedback }}</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-sm text-gray-500">No evaluation data found.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const element = document.getElementById(id);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>