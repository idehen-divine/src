<x-app-layout title="Plans">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li>Transactions</li>
                </ul>
            </div>
        </h2>
    </x-slot>

    <livewire:user.transaction.transaction />

</x-app-layout>
