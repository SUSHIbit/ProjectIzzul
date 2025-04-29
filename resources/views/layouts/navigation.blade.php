<nav x-data="{ open: false }" class="bg-blue-800 border-b border-blue-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg class="h-8 w-8 text-blue-200" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10l10 5 10-5V7L12 2zm0 2.33l7 3.5v7.34l-7 3.5-7-3.5V7.83l7-3.5zm0 2.34L6.5 9 12 11.33 17.5 9 12 6.67zM6.5 11.67v3.66L11 17.5v-3.66l-4.5-2.17zm11 0L13 13.84v3.66l4.5-2.17v-3.66z"/>
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="text-blue-200 hover:text-white">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    
                    @if (auth()->user()->isLecturer())
                        <x-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                            <span class="text-blue-200 hover:text-white">{{ __('Documents') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('marks.index')" :active="request()->routeIs('marks.*')">
                            <span class="text-blue-200 hover:text-white">{{ __('Evaluation') }}</span>
                        </x-nav-link>
                    @endif
                    
                    @if (auth()->user()->isAdmin())
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            <span class="text-blue-200 hover:text-white">{{ __('Users') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                            <span class="text-blue-200 hover:text-white">{{ __('Categories') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('rubrics.index')" :active="request()->routeIs('rubrics.*')">
                            <span class="text-blue-200 hover:text-white">{{ __('Rubrics') }}</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-200 hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-200 hover:text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="text-blue-200 hover:text-white">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            
            @if (auth()->user()->isLecturer())
                <x-responsive-nav-link :href="route('documents.index')" :active="request()->routeIs('documents.*')">
                    <span class="text-blue-200 hover:text-white">{{ __('Documents') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('marks.index')" :active="request()->routeIs('marks.*')">
                    <span class="text-blue-200 hover:text-white">{{ __('Evaluation') }}</span>
                </x-responsive-nav-link>
            @endif
            
            @if (auth()->user()->isAdmin())
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    <span class="text-blue-200 hover:text-white">{{ __('Users') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    <span class="text-blue-200 hover:text-white">{{ __('Categories') }}</span>
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rubrics.index')" :active="request()->routeIs('rubrics.*')">
                    <span class="text-blue-200 hover:text-white">{{ __('Rubrics') }}</span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-700">
            <div class="px-4">
                <div class="font-medium text-base text-blue-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <span class="text-blue-200 hover:text-white">{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="text-blue-200 hover:text-white">{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>