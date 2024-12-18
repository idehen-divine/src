<div>
    <section class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 text-gray-800 dark:text-gray-200">
            @unless ($games === null || $games->isEmpty())
                @foreach ($games as $game)
                    <!-- Card -->
                    <div
                        class="flex flex-col justify-between items-center border border-gray-700 rounded-lg p-5 bg-ghost shadow-md">
                        <div class="w-full flex flex-row justify-between">
                            <img src="{{ $game->photo_url }}" alt="{{ ucwords($game->name) }}"
                                class="object-cover w-[70px] h-[70px] md:w-[140px] md:h-[140px] rounded-md">
                            <div class="text-end mt-2">
                                <h1 class="text-xs md:text-sm font-bold">{{ ucwords($game->name) }}</h1>
                                <h1 class="text-md md:text-2xl font-extrabold">
                                    {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $game->price }}</h1>
                                <p class="text-xs md:text-sm font-bold">{{ helpers()->getGameTime($game) }}</p>
                            </div>
                        </div>
                        <!-- Button -->
                        <button
                            class="btn btn-primary btn-sm md:btn-md rounded-full text-gray-200 font-bold md:text-xl px-4 py-2 mt-5"
                            wire:click="toggleBuyTicketModal('{{ $game->id }}'); buyTicket.showModal();">
                            Play {{ ucwords($game->name) }}
                        </button>
                    </div>
                    <!-- /Card -->
                @endforeach
            @endunless
        </div>
        @unless ($games === null || $games->isEmpty())
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
                        {{ $games->links() }}
                    </div>
                </div>
            </div>
        @endunless
    </section>
    <dialog wire:ignore.self id="buyTicket" class="modal bg-ghost text-gray-800 dark:text-gray-200" x-data
        x-on:keydown.escape.window="$wire.toggleBuyTicketModalClose()">
        <div class="modal-box bg-gray-100 dark:bg-gray-800 sm:max-w-sm">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                    wire:click="toggleBuyTicketModalClose">✕</button>
                @if ($showBuyTicketModal)
                    <div class="flex justify-center">
                        <img src="{{ $buyTicket->photo_url }}" wire:ignore.self alt="Current Game Photo"
                            class="rounded-md h-32 w-32 object-cover">
                    </div>
                    <p class="text-center text-md md:text-2xl font-extrabold mt-1">{{ ucwords($buyTicket->name) }}</p>
                    <p class="text-xs md:text-sm font-bold">GAME ID: {{ strtoupper($buyTicket->game_id) }}</p>
                    <h1 class="text-xs md:text-sm font-bold">
                        PRICE: {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $buyTicket->price }}</h1>
                    <h1 class="text-xs md:text-sm font-bold">
                        TO WIN: {{ settings()->getValue('APP_CURRENCY_LOGO', '$') . $buyTicket->reward }}</h1>
                    <p class="text-xs md:text-sm font-bold">{{ helpers()->getGameTime($buyTicket) }}</p>
                    <div class="flex flex-row justify-around mt-3">
                        <button
                            class="btn btn-primary btn-sm md:btn-md rounded-full text-gray-200 font-bold md:text-xl px-4 py-2"
                            wire:click="purchaseTicket" @disabled($quantity <= 0)>
                            Purchase Ticket
                        </button>
                        <div class="join border border-gray-300 dark:border-gray-600">
                            <button type="button" class="join-item bg-gray-200 dark:bg-gray-900 btn btn-sm md:btn-md md:text-xl"
                                wire:click="decreaseTicket" @disabled($quantity <= 0)>
                                -
                            </button>
                            <button type="button"
                                class="join-item bg-gray-200 dark:bg-gray-900 btn btn-sm md:btn-md md:text-xl btn-disabled">{{ $quantity }}</button>
                            <button type="button" class="join-item bg-gray-200 dark:bg-gray-900 btn btn-sm md:btn-md md:text-xl"
                                wire:click="addTicket">
                                +
                            </button>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col justify-between items-center rounded-lg p-5">
                        <div class="w-full flex justify-center">
                            <div class="skeleton w-32 h-32 rounded-md dark:bg-gray-700 bg-gray-300">
                            </div>
                        </div>
                        <div class="flex flex-col gap-4 mt-2">
                            <div class="skeleton h-4 w-40 md:w-[240px] dark:bg-gray-700 bg-gray-300"></div>
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-700 bg-gray-300"></div>
                            <div class="skeleton h-2 w-40 md:w-[240px] dark:bg-gray-700 bg-gray-300"></div>
                        </div>
                        <div class="flex flex-row justify-around gap-5 mt-3">
                            <div
                                class="skeleton h-10 w-[120px] rounded-full dark:bg-gray-700 bg-gray-300 px-4 py-2 mt-5">
                            </div>
                            <div
                                class="skeleton h-10 w-[120px] rounded-full dark:bg-gray-700 bg-gray-300 px-4 py-2 mt-5">
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </dialog>


    <x-livewire-extras />
</div>
