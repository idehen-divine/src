<div>
    <div class="card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl">
        <div class="card-body">
            <h2 class="card-title flex flex-row justify-between mb-2">
                Transactions
                <label class="input input-sm input-bordered bg-transparent flex items-center gap-2 p-2 sm:p-3 lg:p-4 w-full max-w-xs">
                    <input wire:model.live.debounce.300ms="search" type="search"
                        class="input-xs border-none focus:outline-none focus:ring-0 focus:border-none bg-transparent w-full text-xs"
                        placeholder="Search" />
                    <i class="bx bx-search text-base opacity-75"></i>
                </label>
            </h2>

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
                                            <div class="text-white badge badge-warning">{{ $transaction->status }}</div>
                                        @elseif ($transaction->status === 'successful')
                                            <div class="text-white badge badge-success">{{ $transaction->status }}</div>
                                        @else
                                            <div class="text-white badge badge-error">{{ $transaction->status }}</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap">{{ $transaction->processed_at }}</td>
                                    <td class="whitespace-nowrap">{{ $transaction->created_at }}</td>
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
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
        </div>
    </div>
    <x-livewire-extras />
</div>
