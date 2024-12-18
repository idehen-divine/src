{{-- @if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@if ($errors->any())
    <!-- Toast Notification Component -->
    <div x-data="{ show: {{ $errors->any() ? 'true' : 'false' }}, errors: {{ json_encode($errors->all()) }} }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" x-init="if (show) { setTimeout(() => show = false, 5000); }"
        class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded shadow-lg w-72 z-50">

        <strong>Whoops! Something went wrong:</strong>
        <ul class="mt-2 text-sm list-disc list-inside">
            <template x-for="error in errors" :key="error">
                <li x-text="error"></li>
            </template>
        </ul>
    </div>
@endif
