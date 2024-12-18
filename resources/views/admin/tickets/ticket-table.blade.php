<div wire:poll>
    @unless ($tickets === null || $tickets->isEmpty())
        <div class="p-4 bg-white dark:bg-gray-800">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 text-gray-800 dark:text-gray-200">
                @foreach ($tickets as $ticket)
                    <!-- Card -->
                    <div
                        class="flex flex-col justify-between items-center border border-gray-700 rounded-lg p-5 bg-ghost shadow-md">
                        <div class="w-full flex flex-row justify-between">
                            <img src="{{ $ticket->game->photo_url }}" alt="{{ ucwords($ticket->game->name) }}"
                                class="object-cover w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md">
                            <div class="text-end mt-2">
                                <h1 class="text-xs md:text-sm font-bold">{{ ucwords($ticket->game->name) }}</h1>
                                <h1 class="text-md md:text-2xl font-extrabold">
                                    {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $ticket->game->price }}</h1>
                                <p class="text-xs md:text-sm font-bold">{{ helpers()->getGameTime($ticket->game) }}</p>
                                <h1 class="text-md md:text-2xl font-extrabold">
                                    {{ implode(', ', json_decode($ticket->numbers, true)) }}</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /Card -->
                @endforeach
            </div>
            <div class="mt-5">
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
                        {{-- {{ $tickets->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    @endunless
</div>
