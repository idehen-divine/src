<x-guest-layout title="FAQs">

    <!-- faqs -->
    <section class="max-w-xl mx-auto pb-10 mb-4" style="margin-top: 100px;">
        <h2 class="text-lg font-bold text-center">FAQ</h2>
        <div class="w-14 h-1 bg-orange-500 mx-auto my-2"></div>
        <p class="text-center text-gray-500 mb-8">Curae hendrerit donec commodo hendrerit egestas tempus, turpis
            facilisis nostra nunc. Vestibulum dui eget ultrices.</p>
        <div x-data="{ open: false }" class="mb-4">
            <button @click="open = !open" class="flex justify-between w-full p-4 text-left rounded-lg">
                <span class="font-semibold">Aenean arcu euismod aliquam, volutpat consequat?</span>
                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" class="p-4">
                <p class="text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                    incididunt ut
                    labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div x-data="{ open: false }" class="mb-4">
            <button @click="open = !open" class="flex justify-between w-full p-4 text-left rounded-lg">
                <span class="font-semibold">Lorem quam erat placerat mollis, rhoncus senectus?</span>
                <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg>
            </button>
            <div x-show="open" class="p-4">
                <p class="text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                    incididunt ut
                    labore et dolore magna aliqua.</p>
            </div>
        </div>
    </section>

</x-guest-layout>
