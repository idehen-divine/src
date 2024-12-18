<div>
    <div x-data="{ activeTab: 'tab1' }" class="p-6">
        <!-- Tab Navigation -->
        <div class="flex">
            <button :class="activeTab === 'tab1' ? 'bg-white dark:bg-gray-800' : ''" @click="activeTab = 'tab1'"
                class="py-2 font-semibold w-2/4">
                All Transactions
            </button>
            <button :class="activeTab === 'tab2' ? 'bg-white dark:bg-gray-800' : ''" @click="activeTab = 'tab2'"
                class="py-2 font-semibold w-2/4">
                Pending Transactions
                @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                    <span class="badge bg-red-500">{{ $pendingTransactions->count() }}</span>
                @endunless

            </button>
        </div>

        <!-- Tab Content -->
        <div wire:poll>
            <div x-show="activeTab === 'tab1'" class="p-4 bg-white dark:bg-gray-800">
                <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
                    <div class="card-body">
                        <div class="overflow-x-auto w-full">
                            <table class="table table-xs w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Ref</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless ($transactions === null || $transactions->isEmpty())
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $transaction->type }}</td>
                                                <td class="whitespace-nowrap">{{ $transaction->reference }}</td>
                                                <td class="whitespace-nowrap">
                                                    {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $transaction->amount }}
                                                </td>
                                                <td class="whitespace-nowrap">{{ $transaction->description }}</td>
                                                <td class="whitespace-nowrap">
                                                    @if ($transaction->status === 'completed')
                                                        @php
                                                            $status = 'badge-success text-gray-100';
                                                        @endphp
                                                    @elseif ($transaction->status === 'failed')
                                                        @php
                                                            $status = 'bg-red-600 text-gray-100';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $status = 'bg-gray-600 text-gray-100';
                                                        @endphp
                                                    @endif
                                                    <span class="badge {{ $status }}">
                                                        {{ $transaction->status }}
                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    {{ $transaction->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">No Transaction Found</td>
                                        </tr>
                                    @endunless
                                </tbody>
                            </table>
                            @unless ($transactions === null || $transactions->isEmpty())
                                <div class="mt-3">
                                    <div class="flex gap-2 justify-between align-center">
                                        <div class="mb-3">
                                            <label class="flex align-center gap-3" for="paginate">
                                                <select wire:model.live="perPage" name="paginate" id="paginate"
                                                    class="select select-bordered select-sm w-full max-w-xs text-xs">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            {{ $transactions->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'tab2'" class="p-4 bg-white dark:bg-gray-800">
                <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
                    <div class="card-body">
                        <div class="overflow-x-auto w-full">
                            <table class="table table-xs w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Ref</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                                        @foreach ($pendingTransactions as $transaction)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $transaction->type }}</td>
                                                <td class="whitespace-nowrap">{{ $transaction->reference }}</td>
                                                <td class="whitespace-nowrap">
                                                    {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $transaction->amount }}
                                                </td>
                                                <td class="whitespace-nowrap">{{ $transaction->description }}</td>
                                                <td class="whitespace-nowrap">
                                                    @if ($transaction->status === 'completed')
                                                        @php
                                                            $status = 'badge-success text-gray-100';
                                                        @endphp
                                                    @elseif ($transaction->status === 'failed')
                                                        @php
                                                            $status = 'bg-red-600 text-gray-100';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $status = 'bg-gray-600 text-gray-100';
                                                        @endphp
                                                    @endif
                                                    <span class="badge {{ $status }}">
                                                        {{ $transaction->status }}
                                                    </span>
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    {{ $transaction->created_at->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <div class="flex gap-2 justify-end">
                                                        <div class="tooltip" data-tip="View" data-tip-offset="10">
                                                            <span class="btn btn-sm btn-ghost cursor-pointer"
                                                                wire:click="showTransaction('{{ $transaction->id }}')">
                                                                <i class="bx bx-show text-primary"
                                                                    style="font-size: 20px;"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11" class="text-center">No Pending Transaction Found</td>
                                        </tr>
                                    @endunless
                                </tbody>
                            </table>
                            @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                                <div class="mt-3">
                                    <div class="flex gap-2 justify-between align-center">
                                        <div class="mb-3">
                                            <label class="flex align-center gap-3" for="paginate">
                                                <select wire:model.live="perPage" name="paginate" id="paginate"
                                                    class="select select-bordered select-sm w-full max-w-xs text-xs">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            {{ $pendingTransactions->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($showDebitModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showDebitModal">

            <x-slot name="title">
                {{ __('Create Game') }}
            </x-slot>

            <x-slot name="content">
                <p>Ref: {{ $details->reference }}</p>
                <p>Amount: {{ $details->amount }}</p>
                <p>Details: {{ $details->description }}</p>
            </x-slot>

            <x-slot name="footer">
                <button
                    class="btn btn-ghost border-1 dark:border-gray-200 border-gray-800 btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="fail"wire:loading.attr="disabled">
                    {{ __('Failed') }}
                </button>
                <button class="btn btn-primary btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="accept" wire:loading.attr="disabled">
                    {{ __('Accept') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($showCreditModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showCreditModal">

            <x-slot name="title">
                {{ __('Create Game') }}
            </x-slot>

            <x-slot name="content">
                <div class="mt-2 flex justify-center">
                    <img wire:ignore.self src="{{ $details->photo_url }}" class="rounded-md h-40 w-40 object-cover">
                </div>
                <p>Ref: {{ $details->reference }}</p>
                <p>Amount: {{ $details->amount }}</p>
                <p>Details: {{ $details->description }}</p>
            </x-slot>

            <x-slot name="footer">
                <button
                    class="btn btn-ghost border-1 dark:border-gray-200 border-gray-800 btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="fail"wire:loading.attr="disabled">
                    {{ __('Failed') }}
                </button>
                <button class="btn btn-primary btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="accept" wire:loading.attr="disabled">
                    {{ __('Accept') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif

    <x-livewire-extras />
</div>
