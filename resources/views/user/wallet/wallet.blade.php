<div class="mb-4">
    <x-validation-errors class="mb-4" />

    <div class="grid gap-5 grid-col-1 md:grid-cols-2">
        <div
            class="px-6 py-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div>
                <div class="flex justify-between">
                    <h3>Virtual Account</h3>
                    <button class="float-right px-4 py-2 text-white bg-orange-500 btn hover:bg-orange-400 btn-sm"
                        {{ $wallet->account_number ? '' : 'disabled' }}  wire:loading.attr="disabled" wire:target="showingWithdrawalModal" wire:click="showingWithdrawalModal"> Withdraw
                        <i class="bx bx-wallet"></i>
                    </button>
                </div>
                @if ($wallet->account_number)
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                            {{ settings()->getValue('app_currency_logo') }} {{ $wallet->balance }}
                        </h3>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Account Number: {{ $wallet->account_number }}
                        </p>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Account Name: {{ $wallet->account_name }}
                        </p>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Bank: {{ $wallet->bank_name }}
                        </p>
                    </div>
                @else
                    <div class="flex justify-center py-4">
                        <button class="float-right px-4 py-2 text-white bg-orange-500 btn hover:bg-orange-400"
                             wire:loading.attr="disabled" wire:target="getVirtualAccount" wire:click="getVirtualAccount">
                            Get Virtual Account
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div
            class="px-6 py-4 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div>
                <div class="flex justify-between">
                    <h3>Local Account</h3>
                    <button class="float-right px-4 py-2 text-white bg-orange-500 btn hover:bg-orange-400 btn-sm"
                         wire:loading.attr="disabled" wire:target="showingModal" wire:click="showingModal">
                        Add <i class="bx bx-plus"></i>
                    </button>
                </div>
                @if ($bank)
                    <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Account Number: {{ $bank->account_number }}
                    </p>
                    <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Account Name: {{ $bank->account_name }}
                    </p>
                    <p class="max-w-2xl mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Bank: {{ $bank->bank_name }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    @if ($showModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showModal">

            <x-slot name="title">
                {{ __('Add/Update bannk details') }}
            </x-slot>

            <x-slot name="content">
                <select
                    class="w-full overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm select select-bordered dark:bg-gray-800 dark:border-gray-700"
                    wire:model.live="bank_code">
                    <option value="text-center">-- Bank --</option>
                    @unless ($banks === null)
                        @foreach ($banks as $bank)
                            <option value="{{ $bank['code'] }}">{{ strtoupper($bank['name']) }}</option>
                        @endforeach
                    @endunless
                </select>

                <input
                    class="w-full mt-1 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm input input-bordered dark:bg-gray-800 dark:border-gray-700"
                    type="number" placeholder="Account Number" wire:model.live.debounce.300ms="account_number" />

                <input
                    class="w-full mt-1 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm input input-bordered dark:bg-gray-800 dark:border-gray-700"
                    type="text" placeholder="Account Name" disabled wire:model="account_name" />
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <button class="text-xs text-gray-800 uppercase btn btn-primary btn-sm dark:text-gray-200"
                    wire:click="updateBank" wire:loading.attr="disabled" wire:target="updateBank"
                    {{ !$account_name ? 'disabled' : '' }}>
                    {{ __('Update') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($showWithdrawalModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showWithdrawalModal">

            <x-slot name="title">
                {{ __('Withdraw to Bank') }}
            </x-slot>

            <x-slot name="content">

                <x-label for="amount" :value="__('Amount')" />
                <input id="amount" class="w-full mt-1 bg-transparent input input-bordered" type="number"
                    placeholder="0.00" wire:model="amount" />
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showWithdrawalModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <button class="text-xs text-gray-800 uppercase btn btn-primary btn-sm dark:text-gray-200"
                    wire:click="withdraw" wire:loading.attr="disabled" wire:target="withdraw">
                    {{ __('Withdraw') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif

    <x-livewire-extras />
</div>
