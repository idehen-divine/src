<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ucwords(settings()->getValue('app_name', config('app.name'))) }}{{ ' || ' . ($title ?? '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="w-[100vw] h-[100vh] items-center justify-center flex font-sans text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-900 antialiased">
        {{-- <select data-choose-theme class="select select-bordered">
            <option value="light">Light</option>
            <option value="dark">Dark</option>
            <option value="system" selected>System</option>
        </select> --}}

        {{ $slot }}

    @livewireScripts
</body>

</html>
