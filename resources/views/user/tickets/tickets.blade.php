<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>My Tickets</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:user.tickets.my-tickets />

</x-app-layout>
