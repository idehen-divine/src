<div x-data="{ activeTab: 'tab1' }" class="p-6">
    <!-- Tab Navigation -->
    <div class="flex">
        <button :class="activeTab === 'tab1' ? 'bg-white dark:bg-gray-800' : ''" @click="activeTab = 'tab1'"
            class="py-2 font-semibold w-2/4">
            Open Tickets
        </button>
        <button :class="activeTab === 'tab2' ? 'bg-white dark:bg-gray-800' : ''" @click="activeTab = 'tab2'"
            class="py-2 font-semibold w-2/4">
            Closed Tickets
        </button>
    </div>

    <!-- Tab Content -->
    <div wire:poll>
        @unless ($openTickets === null || $openTickets->isEmpty())
            <div x-show="activeTab === 'tab1'" class="p-4 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 text-gray-800 dark:text-gray-200">
                    @foreach ($openTickets as $tickets)
                        <!-- Card -->
                        <div
                            class="flex flex-col justify-between items-center border border-gray-700 rounded-lg p-5 bg-ghost shadow-md">
                            <div class="w-full flex flex-row justify-between">
                                <img src="{{ $tickets->game->photo_url }}" alt="{{ ucwords($tickets->game->name) }}"
                                    class="object-cover w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md">
                                <div class="text-end mt-2">
                                    <h1 class="text-xs md:text-sm font-bold">{{ ucwords($tickets->game->name) }}</h1>
                                    <h1 class="text-md md:text-2xl font-extrabold">
                                        {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $tickets->game->price }}</h1>
                                    <p class="text-xs md:text-sm font-bold">{{ helpers()->getGameTime($tickets->game) }}</p>
                                    <h1 class="text-md md:text-2xl font-extrabold">
                                        {{ implode(', ', json_decode($tickets->numbers, true)) }}</h1>
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
                            {{ $openTickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endunless
        @unless ($closedTickets === null || $closedTickets->isEmpty())
            <div x-show="activeTab === 'tab2'" class="p-4 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    @foreach ($closedTickets as $tickets)
                        <!-- Card -->
                        <div
                            class="flex flex-col justify-between items-center border rounded-lg p-5 bg-ghost shadow-md {{ $tickets->status == 'lost' ? 'text-red-500 border-red-500' : 'text-green-500 border-green-500' }}">
                            <div class="w-full flex flex-row justify-between">
                                <img src="{{ $tickets->game->photo_url }}" alt="{{ ucwords($tickets->game->name) }}"
                                    class="object-cover w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md">
                                <div class="text-end mt-2">
                                    <h1 class="text-xs md:text-sm font-bold">{{ ucwords($tickets->game->name) }}</h1>
                                    <h1 class="text-md md:text-2xl font-extrabold">
                                        {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $tickets->game->price }}</h1>
                                    <p class="text-xs md:text-sm font-bold">{{ helpers()->getGameTime($tickets->game) }}
                                    </p>
                                    <h1 class="text-md md:text-2xl font-extrabold">
                                        {{ implode(', ', json_decode($tickets->numbers, true)) }}</h1>
                                </div>
                            </div>
                            <!-- Button -->
                            <button
                                class="btn btn-primary btn-sm md:btn-md rounded-full text-gray-200 font-bold md:text-xl px-4  mt-4">
                                View Result
                            </button>
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
                            {{ $closedTickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endunless
    </div>
</div>
