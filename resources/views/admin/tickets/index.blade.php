<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('games') }}">Games</a></li>
                    <li>{{ $game->name }}</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:admin.tickets.ticket-table :game="$game" />

</x-app-layout>
