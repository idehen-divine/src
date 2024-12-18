<div>
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
                        @unless ($histories === null || $histories->isEmpty())
                            @foreach ($histories as $history)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $history->type }}</td>
                                    <td class="whitespace-nowrap">{{ $history->ref }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $history->amount }}</td>
                                    <td class="whitespace-nowrap">{{ $history->description }}</td>
                                    <td class="whitespace-nowrap">
                                        @if ($history->status === 'completed')
                                            @php
                                                $status = 'badge-success text-gray-100';
                                            @endphp
                                        @elseif ($history->status === 'failed')
                                            @php
                                                $status = 'bg-red-600 text-gray-100';
                                            @endphp
                                        @else
                                            @php
                                                $status = 'bg-gray-600 text-gray-100';
                                            @endphp
                                        @endif
                                        <span class="badge {{ $status }}">
                                            {{ $history->status }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap">{{ $history->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">No History Found</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
                @unless ($histories === null || $histories->isEmpty())
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
                                {{ $histories->links() }}
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
        </div>
    </div>

    <x-livewire-extras />
</div>
