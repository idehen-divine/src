<div>
    <section class="">
        <h2 class="text-lg font-bold text-center">Investments Plans</h2>
        <div class="w-32 h-1 bg-orange-500 mx-auto my-2"></div>
        <h3 class="text-gray-500 text-center mb-8">What Plan Is Suitable For You</h3>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-14 py-6">
            <!-- Tier 1 Plan -->
            <div class="border border-zinc-300 rounded-lg p-6 text-center flex flex-col h-full md:h-[450px]">
                <h2 class="text-xl font-semibold">Tier 1</h2>
                <p class="text-2xl font-bold my-2">{{ settings()->getValue('app_currency_logo', '₦') }}500</p>
                <ul class="text-left space-y-2 flex-grow">
                    <li class="flex items-center">Invest ₦500 Daily</li>
                    <li class="flex items-center">Qualify for the weekly deep to win ₦100,000</li>
                </ul>
                <button class="btn bg-orange-500 hover:bg-orange-400 border-none text-white mt-4"
                    wire:click="subscribe(1)">SUBSCRIBE</button>
            </div>

            <!-- Tier 2 Plan -->
            <div class="bg-orange-500 rounded-lg p-6 text-white text-center flex flex-col h-full md:h-[450px] relative">
                <span
                    class="absolute top-0 right-0 text-yellow-500 bg-white px-2 py-1 text-xs font-bold rounded-bl-lg">MOST
                    POPULAR</span>
                <h2 class="text-xl font-semibold">Tier 2</h2>
                <p class="text-2xl font-bold my-2">{{ settings()->getValue('app_currency_logo', '₦') }}1000</p>
                <ul class="text-left space-y-2 flex-grow">
                    <li class="flex items-center">Invest ₦1000 Daily</li>
                    <li class="flex items-center">Qualify for the weekly deep to win ₦200,000</li>
                </ul>
                <button class="btn bg-white hover:bg-gray-100 border-none text-orange-500 mt-4"
                    wire:click="subscribe(2)">SUBSCRIBE</button>
            </div>
        </div>
    </section>

    <x-livewire-extras />
</div>
