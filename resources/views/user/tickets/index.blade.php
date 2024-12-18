<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>Tickets</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:user.tickets.tickets-lists lazy />

</x-app-layout>
