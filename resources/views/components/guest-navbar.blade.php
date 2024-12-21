<nav x-data="{ open: false }"
    class="fixed bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 z-10 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <h1 class="">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/GloryTower.png') }}" alt="Logo" class="block dark:hidden h-10">
                    <img src="{{ asset('assets/images/GloryTower_dark.png') }}" alt="Logo"
                        class="hidden dark:block h-10">
                </a>
            </h1>
            <ul class="flex gap-10 items-center max-md:hidden">
                <li class="{{ Route::is('faqs') ? 'active' : '' }}">
                    <a href="{{ route('faqs') }}">FAQs</a>
                </li>
                <li class="{{ Route::is('contact-us') ? 'active' : '' }}">
                    <a href="{{ route('contact-us') }}">Contact Us</a>
                </li>
            </ul>

            <div :class="{ 'block': open, 'hidden': !open }"
                class="w-3/4 flex-col right-0 fixed bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 p-10 text-lg z-10 font-bold ease-in-out top-16 gap-10 items-start">
                <ul>
                    <li class="{{ Route::is('faqs') ? 'active' : '' }}">
                        <a href="{{ route('faqs') }}">FAQs</a>
                    </li>
                    <li class="{{ Route::is('contact-us') ? 'active' : '' }}">
                        <a href="{{ route('contact-us') }}">Contact Us</a>
                    </li>
                </ul>

                <div class="button flex gap-4 mt-4">
                    @if (auth()->user())
                        <a href="{{ route('dashboard') }}">
                            <button
                                class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 border border-gray-800 dark:border-gray-100 hover:border-none bg-white dark:bg-transparent hover:dark:bg-gray-900 hover:bg-gray-100 rounded-md text-bold">
                                Dashboard
                            </button>
                        </a>
                    @else
                        <a href="{{ route('register') }}">
                            <button
                                class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 border border-gray-800 dark:border-gray-100 hover:border-none bg-white dark:bg-transparent hover:dark:bg-gray-900 hover:bg-gray-100 rounded-md text-bold">
                                Register
                            </button>
                        </a>
                        <a href="{{ route('login') }}">
                            <button
                                class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-900 hover:bg-transparent hover:border hover:border-gray-800 hover:dark:border-gray-100 rounded-md text-bold">
                                Login
                            </button>
                        </a>
                    @endif
                </div>
            </div>

            <div class="button flex items-center gap-4 max-md:hidden">
                <!-- Theme Changer -->
                <x-theme-changer />

                @if (auth()->user())
                    <a href="{{ route('dashboard') }}">
                        <button
                            class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 border border-gray-800 dark:border-gray-100 hover:border-none bg-white dark:bg-transparent hover:dark:bg-gray-900 hover:bg-gray-100 rounded-md text-bold">
                            Dashboard
                        </button>
                    </a>
                @else
                    <a href="{{ route('register') }}">
                        <button
                            class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 border border-gray-800 dark:border-gray-100 hover:border-none bg-white dark:bg-transparent hover:dark:bg-gray-900 hover:bg-gray-100 rounded-md text-bold">
                            Register
                        </button>
                    </a>
                    <a href="{{ route('login') }}">
                        <button
                            class="w-[90px] btn h-7 text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-900 hover:bg-transparent hover:border hover:border-gray-800 hover:dark:border-gray-100 rounded-md text-bold">
                            Login
                        </button>
                    </a>
                @endif
            </div>

            <div class="flex items-center md:hidden">
                <!-- Theme Changer -->
                <x-theme-changer />

                <div @click="open = ! open" @click.outside="open = false"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</nav>
