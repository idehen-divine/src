<section class="max-w-xl mx-auto pb-10 mb-4">
    <h2 class="text-lg font-bold text-center">FAQ</h2>
    <div class="w-14 h-1 bg-orange-500 mx-auto my-2"></div>
    <p class="text-center text-gray-500 mb-8">Curae hendrerit donec commodo hendrerit egestas tempus, turpis
        facilisis nostra nunc. Vestibulum dui eget ultrices.</p>
    <div x-data="{ open: false }" class="mb-4">
        <button @click="open = !open" class="flex justify-between w-full p-4 text-left rounded-lg">
            <span class="font-semibold">Are you a registered company?</span>
            <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div x-show="open" class="p-4">
            <p class="text-gray-500">
                Yes, We are Registered With Cooperate Afairs Commission (CAC) and also the Economic and
                Financial Crime Commission (EFCC).
            </p>
        </div>
    </div>
    <div x-data="{ open: false }" class="mb-4">
        <button @click="open = !open" class="flex justify-between w-full p-4 text-left rounded-lg">
            <span class="font-semibold">How are we sure you won't run away with our money?</span>
            <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                </path>
            </svg>
        </button>
        <div x-show="open" class="p-4">
            <p class="text-gray-500">
                Due to the course of our over 9 years in business, we have secured major investments
                especially in real estate and Agriculture, so it would be a loss to us to run away,
                and just like everyother person in business, our aim is to ensure that we expand and
                our business stand the test of time.
            </p>
        </div>
    </div>
    <div x-data="{ open: false }" class="mb-4">
        <button @click="open = !open" class="flex justify-between w-full p-4 text-left rounded-lg">
            <span class="font-semibold">What will happen to my money if I don't win?</span>
            <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                </path>
            </svg>
        </button>
        <div x-show="open" class="p-4">
            <p class="text-gray-500">
                Consistent contributions for 3 months and 6 months without winning you'll get all you money
                back plus 2.5% interest and 5% interest respectively.
            </p>
        </div>
    </div>
</section>
