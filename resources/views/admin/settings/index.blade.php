<x-app-layout title="Settings">
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>Settings</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:admin.settings.settings />

</x-app-layout>
