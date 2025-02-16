<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 md:flex" wire:ignore.self>
                    <x-nav-link href="{{ route('dashboard') }}" :active="$activePage === 'dashboard'">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (helpers()->isAdmin())
                        <x-nav-link href="{{ route('users') }}" :active="$activePage === 'users'">
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('investments') }}" :active="$activePage === 'investments'">
                            {{ __('Investments') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('transaction') }}" :active="$activePage === 'transaction'">
                            Transactions @if ($pendingTransactions)
                                <span
                                    class="w-4 h-4 p-0 text-xs text-white rounded-full badge badge-error ms-1">{{ $pendingTransactions }}</span>
                            @endif
                        </x-nav-link>
                        <x-nav-link href="{{ route('settings') }}" :active="$activePage === 'settings'">
                            {{ __('Settings') }}
                        </x-nav-link>
                    @elseif (helpers()->isUser())
                        <x-nav-link href="{{ route('checkins') }}" :active="$activePage === 'checkins'">
                            {{ __('Checkins') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('transactions') }}" :active="$activePage === 'transactions'">
                            {{ __('Transactions') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden md:flex sm:items-center sm:ms-6">

                @if (helpers()->isUser())
                    <div class="hidden sm:-my-px sm:ms-10 md:flex">
                        <!-- Button -->
                        <div class="relative">
                            <a href="{{ route('wallet') }}"
                                class="flex items-center gap-2 px-4 py-2 text-white bg-orange-500 rounded-lg shadow-lg hover:bg-orange-400">
                                <i class='text-xl bx bx-wallet'></i>
                                <span class="font-semibold" wire:poll.visable.5s>
                                    {{ settings()->getValue('app_currency_logo', '$') . $balance }}
                                </span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Theme Changer -->
                <x-theme-changer />

                <!-- Settings Dropdown -->
                <div class="relative ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->user_name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                        {{ Auth::user()->user_name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center mx-2 -me-2 md:hidden">
                @if (helpers()->isUser())
                    <div class="flex">
                        <!-- Button -->
                        <div class="relative">
                            <a href="{{ route('wallet') }}"
                                class="flex items-center gap-2 px-4 py-2 text-white bg-orange-500 rounded-lg shadow-lg hover:bg-orange-400">
                                <i class='text-xl bx bx-wallet'></i>
                                <span class="font-semibold" wire:poll.visable.5s>
                                    {{ settings()->getValue('app_currency_logo', '$') . $balance }}
                                </span>
                            </a>
                        </div>
                    </div>
                @endif
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="$activePage === 'dashboard'">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (helpers()->isAdmin())
                <x-responsive-nav-link href="{{ route('users') }}" :active="$activePage === 'users'">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('investments') }}" :active="$activePage === 'investments'">
                    {{ __('Investments') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('transaction') }}" :active="$activePage === 'transaction'">
                    {{ __('Transactions') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('settings') }}" :active="$activePage === 'settings'">
                    {{ __('Settings') }}
                </x-responsive-nav-link>
            @elseif (helpers()->isUser())
                <x-responsive-nav-link href="{{ route('checkins') }}" :active="$activePage === 'checkins'">
                    {{ __('Checkins') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('transactions') }}" :active="$activePage === 'transactions'">
                    {{ __('Transactions') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <div class="border-t border-gray-200 dark:border-gray-600"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->user_name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </div>
</nav>
