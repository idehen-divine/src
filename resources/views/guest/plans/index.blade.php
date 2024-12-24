<x-guest-layout title="Investments Plans">

    <!-- Investments Plans -->
    <section class="pb-10 mb-4" style="margin-top: 100px;">
        <h2 class="text-lg font-bold text-center">Investments Plans</h2>
        <div class="w-32 h-1 bg-orange-500 mx-auto my-2"></div>
        <h3 class="text-gray-500 text-center mb-8">What Plan Is Suitable For You</h3>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-14 py-6">
            <!-- Tier 1 Plan -->
            <div class="border border-zinc-300 rounded-lg p-6 text-center flex flex-col h-full md:h-[450px]">
                <h2 class="text-xl font-semibold">Tier 1</h2>
                <p class="text-2xl font-bold my-2">{{ settings()->getValue('app_currency_logo', '₦') }}500</p>
                <ul class="text-left space-y-2 flex-grow">
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Lectus ut nibh quam, felis
                        porttitor.</li>
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Ante nec venenatis etiam
                        lacinia.</li>
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Porta suscipit netus ad ac.
                    </li>
                </ul>
                <button class="btn bg-orange-500 hover:bg-orange-400 border-none text-white mt-4">INVEST</button>
            </div>

            <!-- Tier 2 Plan -->
            <div class="bg-orange-500 rounded-lg p-6 text-white text-center flex flex-col h-full md:h-[450px] relative">
                <span
                    class="absolute top-0 right-0 text-yellow-500 bg-white px-2 py-1 text-xs font-bold rounded-bl-lg">MOST
                    POPULAR</span>
                <h2 class="text-xl font-semibold">Tier 2</h2>
                <p class="text-2xl font-bold my-2">{{ settings()->getValue('app_currency_logo', '₦') }}1000</p>
                <ul class="text-left space-y-2 flex-grow">
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Lectus ut nibh quam, felis
                        porttitor.</li>
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Ante nec venenatis etiam
                        lacinia.</li>
                    <li class="flex items-center"><span class="text-green-500">✔️</span> Porta suscipit netus ad ac.
                    </li>
                </ul>
                <button class="btn bg-white hover:bg-gray-100 border-none text-orange-500 mt-4">INVEST</button>
            </div>
        </div>
    </section>

    <!-- Testimonial -->
    <section class="max-w-2xl mx-auto pb-10 mb-4">
        <div x-data="{
            currentIndex: 0,
            testimonials: [0, 1, 2],
            autoSwitch() {
                setInterval(() => {
                    this.currentIndex = (this.currentIndex < this.testimonials.length - 1) ?
                        this.currentIndex + 1 :
                        0;
                }, 3000);
            }
        }" x-init="autoSwitch()">
            <h2 class="text-lg font-bold text-center">Testimonials</h2>
            <div class="w-32 h-1 bg-orange-500 mx-auto my-2"></div>
            <h3 class="text-gray-500 text-center mb-8">What Clients Are Saying</h3>

            <div x-show="currentIndex === 0" class="flex flex-col justify-center items-center">
                <img src="https://placehold.co/100x100" alt="Client Photo"
                    class="rounded-full border-4 border-white mb-4" />
                <p class="text-center italic">
                    "We are so glad that we made the switch to use Honeypress this year and our results were fantastic."
                </p>
                <p class="font-semibold mt-2">Amanda Smith</p>
                <p class="text-sm">Team Leader</p>
            </div>

            <div x-show="currentIndex === 1" class="flex flex-col justify-center items-center">
                <img src="https://placehold.co/100x100" alt="Client Photo"
                    class="rounded-full border-4 border-white mb-4" />
                <p class="text-center italic">"Honeypress has completely transformed how we manage our
                    workflows.
                    Highly recommended!"</p>
                <p class="font-semibold mt-2">John Doe</p>
                <p class="text-sm">Project Manager</p>
            </div>

            <div x-show="currentIndex === 2" class="flex flex-col justify-center items-center">
                <img src="https://placehold.co/100x100" alt="Client Photo"
                    class="rounded-full border-4 border-white mb-4" />
                <p class="text-center italic">"Using Honeypress has been a game changer for our team’s
                    efficiency
                    and productivity."</p>
                <p class="font-semibold mt-2">Jane Brown</p>
                <p class="text-sm">CEO</p>
            </div>

            <div class="flex justify-between mt-6">
                <button @click="currentIndex = (currentIndex > 0) ? currentIndex - 1 : testimonials.length - 1"
                    class="btn bg-gray-100 hover:btn-ghost dark:bg-gray-800 py-2 px-4 text-2xl">
                    <i class="bx bx-chevron-left"></i>
                </button>
                <button @click="currentIndex = (currentIndex < testimonials.length - 1) ? currentIndex + 1 : 0"
                    class="btn bg-gray-100 hover:btn-ghost dark:bg-gray-800 py-2 px-4 text-2xl">
                    <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div
            class="bg-orange-500 p-7 md:p-14 rounded-lg flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="text-white">
                <h2 class="text-xl md:text-3xl font-bold">Not sure which plan suits you?</h2>
                <p class="text-md md:text-lg ">Imperdiet consectetur dolor, tristique himenaeos ultricies tristique
                    neque.</p>
            </div>
            <a class="btn bg-white py-3 hover:bg-gray-100 border-none text-orange-500 px-5 mt-2 rounded-lg">Contact
                us</a>
        </div>
    </section>

</x-guest-layout>
