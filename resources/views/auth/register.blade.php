<x-guest-layout>
    <div class="flex flex-col items-center w-full px-4 sm:px-6">
        <!-- Logo -->
        <div class="mb-6">
            <a href="/" class="flex items-center">
                <svg class="h-12 w-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.33l7 3.5v7.34l-7 3.5-7-3.5V7.83l7-3.5zm0 2.34L6.5 9 12 11.33 17.5 9 12 6.67zM6.5 11.67v3.66L11 17.5v-3.66l-4.5-2.17zm11 0L13 13.84v3.66l4.5-2.17v-3.66z"/>
                </svg>
                <span class="ml-2 text-xl font-semibold text-blue-800">FYP Evaluation System</span>
            </a>
        </div>

        <div class="w-full sm:w-[450px] md:w-[500px] px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Register</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700 text-base" />
                    <x-text-input id="name" class="block mt-1 w-full border-blue-200 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-base sm:text-base" 
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-base" />
                    <x-text-input id="email" class="block mt-1 w-full border-blue-200 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-base sm:text-base" 
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-base" />

                    <x-text-input id="password" class="block mt-1 w-full border-blue-200 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-base sm:text-base"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 text-base" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full border-blue-200 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm text-base sm:text-base"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="py-2.5 px-5 sm:py-3 sm:px-6 text-base bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
            
            <!-- Login Link -->
            <div class="mt-6 pt-4 text-center border-t border-gray-200">
                <p class="text-sm text-gray-600">
                    Already registered? 
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800">
                        Log in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>