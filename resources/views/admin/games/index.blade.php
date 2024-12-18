<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>Games</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:admin.games.game-table />

</x-app-layout>
