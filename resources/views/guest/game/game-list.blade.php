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
                        <a href="{{ route('user.tickets') }}"
                            class="btn bg-orange-500 hover:bg-orange-400 border-none btn-sm md:btn-md rounded-full text-gray-200 font-bold md:text-xl px-4 py-2 mt-5">
                            Play {{ ucwords($game->name) }}
                        </a>
                    </div>
                    <!-- /Card -->
                @endforeach
            @endunless
        </div>
    </section>
    <x-livewire-extras />
</div>
