<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Under Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-center justify-center py-8">
                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg text-blue-700 p-4 mb-6 md:w-3/4 w-full">
                            <div class="flex items-center mb-2">
                                <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Access Pending</span>
                            </div>
                            <p>Your registration has been received. Your role is currently under review by an administrator. You will be notified once your access is approved.</p>
                        </div>
                        
                        <div class="text-center md:w-3/4 w-full">
                            <svg class="mx-auto h-24 w-24 text-blue-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            
                            <h3 class="text-xl font-medium text-blue-800 mb-4">Account Review Process</h3>
                            
                            <div class="space-y-6 text-left">
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <h4 class="font-medium text-blue-700 mb-2">What happens next?</h4>
                                    <p class="text-gray-600">An administrator will review your account details and assign you the appropriate role based on your position.</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <h4 class="font-medium text-blue-700 mb-2">How long does it take?</h4>
                                    <p class="text-gray-600">The review process usually takes 1-2 business days. You'll gain access to the system as soon as your role is approved.</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <h4 class="font-medium text-blue-700 mb-2">Need immediate access?</h4>
                                    <p class="text-gray-600">If you require urgent access, please contact the system administrator directly.</p>
                                </div>
                            </div>
                            
                            <div class="mt-8">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-150 ease-in-out">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>