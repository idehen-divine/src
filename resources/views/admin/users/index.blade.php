<x-app-layout title="Users">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>Users</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:admin.users.user-table />

</x-app-layout>
