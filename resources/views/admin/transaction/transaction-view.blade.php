<div>
    <div x-data="{ activeTab: 'tab1' }">
        <!-- Tab Navigation -->
        <div class="flex">
            <div class="w-2/4 bg-white dark:bg-gray-800 rounded-tr-lg rounded-tl-lg">
                <button :class="activeTab === 'tab1' ? '' : 'bg-gray-100 dark:bg-gray-900 rounded-br-lg'"
                    @click="activeTab = 'tab1'" class="py-2 font-semibold w-full">
                    All Transactions
                </button>
            </div>
            <div class="w-2/4 bg-white dark:bg-gray-800 rounded-tr-lg rounded-tl-lg">
                <button :class="activeTab === 'tab2' ? '' : 'bg-gray-100 dark:bg-gray-900 rounded-bl-lg'"
                    @click="activeTab = 'tab2'" class="py-2 font-semibold w-full">
                    Pending Transactions
                    @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                        <span class="badge bg-red-500">{{ $pendingTransactions->count() }}</span>
                    @endunless
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div wire:poll>
            <div x-show="activeTab === 'tab1'"
                class="p-4 bg-white dark:bg-gray-800 shadow-sm rounded-lg rounded-tl-none">
                <div class="card bg-white dark:bg-gray-800 overflow-hidden">
                    <div class="card-body">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Ref</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Processed At</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless ($transactions === null || $transactions->isEmpty())
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="whitespace-nowrap">{{ $transaction->transaction_reference }}</td>
                                                <td class="whitespace-nowrap">{{ $transaction->transaction_type }}</td>
                                                <td class="whitespace-nowrap">{{ $transaction->amount }}</td>
                                                <td class="whitespace-nowrap">{{ $transaction->description }}</td>
                                                <td>
                                                    @if ($transaction->status === 'pending')
                                                        <div class="text-white badge badge-warning">
                                                            {{ $transaction->status }}</div>
                                                    @elseif ($transaction->status === 'successful')
                                                        <div class="text-white badge badge-success">
                                                            {{ $transaction->status }}</div>
                                                    @else
                                                        <div class="text-white badge badge-error">{{ $transaction->status }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    {{ $transaction->processed_at ? \Carbon\Carbon::parse($transaction->processed_at)->format('l, F j, Y g:i A') : '' }}
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    {{ $transaction->created_at ? \Carbon\Carbon::parse($transaction->created_at)->format('l, F j, Y g:i A') : '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No transaction history Found</td>
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
                                                    class="select select-bordered bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
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

            <div x-show="activeTab === 'tab2'"
                class="p-4 bg-white dark:bg-gray-800 shadow-sm rounded-lg rounded-tr-none">
                <div class="card bg-white dark:bg-gray-800 overflow-hidden">
                    <div class="card-body">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Ref</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Processed At</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                                        @foreach ($pendingTransactions as $pendingTransaction)
                                            <tr>
                                                <td class="whitespace-nowrap">
                                                    {{ $pendingTransaction->transaction_reference }}
                                                </td>
                                                <td class="whitespace-nowrap">{{ $pendingTransaction->transaction_type }}
                                                </td>
                                                <td class="whitespace-nowrap">{{ $pendingTransaction->amount }}</td>
                                                <td class="whitespace-nowrap">{{ $pendingTransaction->description }}</td>
                                                <td>
                                                    @if ($pendingTransaction->status === 'pending')
                                                        <div class="text-white badge badge-warning">
                                                            {{ $pendingTransaction->status }}</div>
                                                    @elseif ($pendingTransaction->status === 'successful')
                                                        <div class="text-white badge badge-success">
                                                            {{ $pendingTransaction->status }}</div>
                                                    @else
                                                        <div class="text-white badge badge-error">
                                                            {{ $pendingTransaction->status }}</div>
                                                    @endif
                                                </td>
                                                <td class="whitespace-nowrap">
                                                    {{ $pendingTransaction->created_at ? \Carbon\Carbon::parse($pendingTransaction->created_at)->format('l, F j, Y g:i A') : '' }}
                                                </td>
                                                <td>
                                                    <div class="flex gap-2 items-center">
                                                        <button class="btn btn-success btn-xs text-white"
                                                            wire:click="accept('{{ $pendingTransaction->id }}')">
                                                            Accept
                                                        </button>
                                                        <button class="btn btn-error btn-xs text-white"
                                                            wire:click="decline('{{ $pendingTransaction->id }}')">
                                                            Decline
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No pending transaction history Found</td>
                                        </tr>
                                    @endunless
                                </tbody>
                            </table>
                            @unless ($pendingTransactions === null || $pendingTransactions->isEmpty())
                                <div class="mt-3">
                                    <div class="flex gap-2 justify-between align-center">
                                        <div class="mb-3">
                                            <label class="flex align-center bg-transparent gap-3" for="paginate">
                                                <select wire:model.live="perPage" name="paginate" id="paginate"
                                                    class="select select-bordered bg-transparent">
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

    <x-livewire-extras />
</div>
