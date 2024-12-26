<div x-data="{ show: false, message: '', type: '' }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2" x-init="$wire.on('notification', data => {
        message = data[0].message;
        type = data[0].type;
        show = true;
        setTimeout(() => show = false, 5000);
    });"
    :class="type === 'success' ? 'bg-green-500' : 'bg-red-500'"
    class="fixed top-5 right-5 text-white px-4 py-3 rounded shadow-lg" role="alert">
    <span x-text="message"></span>
</div>


@if (isset($confirmingUserDeletion))
<!-- Delete Confirmation Modal -->
<x-dialog-modal maxWidth="md" wire:model.live="confirmingUserDeletion">
    <x-slot name="title">
        {{ __('Delete Record') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Enter password to confirm delete.') }}

        <div class="mt-4" x-data="{}"
            x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
            <x-input type="password" class="mt-1 block w-full" autocomplete="current-password"
                placeholder="{{ __('Password') }}" x-ref="password" wire:model="password"
                wire:keydown.enter="confirm()" />

            <x-input-error for="password" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="confirm()" wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
@endif

@script
<script>
    $wire.on('redirect', (event) => {
        window.location.href = event.url;
    });
</script>
@endscript
