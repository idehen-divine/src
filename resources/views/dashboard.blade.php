<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li>Dashboard</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    @if (helpers()->isAdmin())
        <livewire:admin.dashboard.dashboard />
    @elseif (helpers()->isUser())
        <livewire:user.dashboard.dashboard />
    @endif
</x-app-layout>
