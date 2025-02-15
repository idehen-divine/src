<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}{{ ' | ' . ($title ?? '') }}</title>

    <meta name="keywords" content="{{ settings()->getValue('app_keywords', config('app.name')) }}" />
    <meta name="description" content="{{ settings()->getValue('app_description', config('app.name')) }}" />
    <meta name="twitter:image" content="brands/twitter.png" />
    <meta name="twitter:image:alt" content="{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}" />
    <meta name="twitter:description" content="{{ settings()->getValue('app_description', config('app.name')) }}" />
    <meta property="og:title" content="{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}" />
    <meta property="og:site_name" content="{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="{{ settings()->getValue('app_description', config('app.name')) }}" />
    <meta property="og:image" content="brands/twitter.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>

<body class="bg-white dark:bg-gray-900 max-w-[100vw] font-sans antialiased">
    <!-- Navbar-->
    <x-guest-navbar />

    <!-- Page Content -->
    <main class="py-2 px-4 sm:px-6 lg:px-8 max-w-7xl min-h-[70vh] mx-auto text-gray-800 dark:text-white">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="p-6 pb-2 mx-auto flex flex-col gap-2">
            <div class="flex flex-col-reverse md:flex-row">
                <div class="w-full md:w-1/3 px-6">
                    <div class="flex items-center justify-center md:justify-start">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/GloryTower.png') }}" alt="Logo"
                                class="block dark:hidden h-20">
                            <img src="{{ asset('assets/images/GloryTower_dark.png') }}" alt="Logo"
                                class="hidden dark:block h-20">
                        </a>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 md:w-1/3">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 whitespace-nowrap">
                        <div>
                            <h3 class="text-gray-700 uppercase dark:text-white">About</h3>
                            <a href="#"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                About Us
                            </a>
                            <a href="{{ route('contact-us') }}"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                Contact Us
                            </a>
                        </div>

                        <div>
                            <h3 class="text-gray-700 uppercase dark:text-white">
                                Help Center
                            </h3>
                            <a href="#"
                                class="block mt-2 text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                Support
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 md:w-1/3">
                    <h3 class="text-gray-700 uppercase dark:text-white">Get Updates</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block w-[100%]" type="email" name="email"
                                :value="old('email')" required autocomplete="email" placeholder="Enter Email" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn bg-orange-500 mt-3 text-white btn-sm whitespace-nowrap">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <hr class="h-px my-2 bg-gray-200 border-none dark:bg-gray-700" />
                <p class="text-start">
                    © Glory Tower Investment LuckyDrop 2024 - All rights reserved
                </p>
            </div>
        </div>
    </footer>

    @livewireScripts()
    @stack('scripts')
</body>

</html>
