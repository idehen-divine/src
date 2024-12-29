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
