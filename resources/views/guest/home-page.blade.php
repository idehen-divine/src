<x-guest-layout>
    <!-- Hero -->
    <section
        class="hero bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-lg w-[90%] rounded-lg max-md:w-[100%] z-0 max-md:rounded-none mx-auto h-[470px] mt-5 px-8 py-4 items-center flex max-md:flex-col justify-between relative"
        style="
            background-image: url('{{ asset('assets/images/GloryTowerLanding.png') }}');
            background-size: cover;
            margin-top: 100px;
            ">
        <div class="flex text-gray-900 flex-col gap-5 items-start justify-center flex-auto">
            <h1 class="text-4xl font-bold">Dream Big, Win Bigger</h1>
            <p class="text-xl">
                Buy  lucky deep online and change <br />
                your life forever
            </p>
            <a href="{{ route('user.tickets') }}"
                class="btn bg-orange-500 hover:bg-orange-400 border-none rounded-full text-xl font-bold text-gray-100">
                Play Now
            </a>
        </div>
        @if (helpers()->showJackpot())
            <!-----Jackpot Box-->
            <div
                class="absolute right-5 max-md:right-0 bottom-[-50px] text-gray-800 shadow-lg max-md:bottom-[-140px] h-[200px] bg-white flex flex-col rounded-lg px-10 py-5 items-center justify-center">
                <h1 class="font-bold text-sm">MEGA JACKPOT</h1>
                <h1 class="font-bold text-3xl mt-5">N500, 670, 390</h1>
                <div class="mt-4 flex flex-col justify-center items-center">
                    <div class="flex">
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-1">
                            0
                        </h1>
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-4">
                            8
                        </h1>
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-1">
                            0
                        </h1>
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-4">
                            7
                        </h1>
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-1">
                            2
                        </h1>
                        <h1 class="bg-gray-300 px-2 rounded-sm py-1 font-bold text-2xl mr-1">
                            9
                        </h1>
                    </div>

                    <div class="flex w-[226px] justify-between mt-2 font-bold text-sm">
                        <p class="ml-4">Days</p>
                        <p class="ml-4">Hours</p>
                        <p class="mr-2">Minutes</p>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <!----Pick Card-->
    <section
        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 max-md:flex-col shadow-lg w-[99%] gap-5 py-4 px-4 max-md:px-0 rounded-lg max-md:w-[100%] z-0 max-md:rounded-none mx-auto mt-20 max-md:mt-40 flex items-center justify-between">
        <div class="flex gap-5 items-center h-full px-3 w-[50%] max-md:w-full max-md:mt-7">
            <div class="w-[100px] h-[100px] bg-gray-100 dark:bg-gray-900 rounded-md"></div>
            <div class="flex flex-col items-start justify-center">
                <h1 class="font-extrabold text-lg">Play Pick 3 Game</h1>
                <p class="text-sm font-sans">Draw every 4 hours</p>
            </div>
        </div>
        <div
            class="flex items-center justify-end max-md:justify-center pr-10 h-full w-[50%] gap-5 max-md:mb-5 max-md:w-full max-md:mt-5">
            <button class="bg-gray-100 dark:bg-gray-900 rounded-md w-[80px] h-[40px] font-bold text-lg">
                2:30
            </button>
            <button class="btn bg-orange-500 text-gray-100 w-[140px] h-[40px] whitespace-nowrap">
                Play Pick 3 Game
            </button>
        </div>
    </section>

    <!-- Cards -->
    <livewire:guests.game.game-list lazy />

    <!--------trio card------>
    <section
        class="gap-10 w-full rounded-lg z-0 max-md:rounded-none mx-auto text-black mt-10 py-4 items-center flex max-md:flex-col justify-center">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-20 text-gray-800 dark:text-gray-200">
            <div
                class="flex flex-col shadow-md w-[240px] h-[300px] rounded-md relative border-b border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-white dark:bg-gray-800 w-full h-[60%]">
                    <img src="{{ asset('assets/images/invest.jpg') }}" alt="" class="w-full h-full">
                </div>

                <div class="w-full h-[50%] flex flex-col items-center justify-center">
                    <h1 class="text-black dark:text-white font-bold text-center mt-7">
                        Invest Your Way to <br />
                        Millions Effortlessly
                    </h1>
                </div>
            </div>
            <div
                class="flex flex-col shadow-md w-[240px] h-[300px] rounded-md relative border-b border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-white dark:bg-gray-800 w-full h-[60%]">
                    <img src="{{ asset('assets/images/payment.jpg') }}" alt="" class="w-full h-full">
                </div>

                <div class="w-full h-[50%] flex flex-col items-center justify-center">
                    <h1 class="text-black dark:text-white font-bold text-center mt-7">
                        Hassle-Free Payments <br />
                        and Withdrawals!
                    </h1>
                </div>
            </div>
            <div
                class="flex flex-col shadow-md w-[240px] h-[300px] rounded-md relative border-b border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="bg-white dark:bg-gray-800 w-full h-[60%]">
                    <img src="{{ asset('assets/images/security.jpg') }}" alt="" class="w-full h-full">
                </div>

                <div class="w-full h-[50%] flex flex-col items-center justify-center">
                    <h1 class="text-black dark:text-white font-bold text-center mt-7">
                        Your Security, Our <br />
                        Priority.
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!------Testimonial------->
    {{-- <section class="bg-white dark:bg-gray-900 mt-10 mb-3">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-800 capitalize lg:text-3xl dark:text-white">
                What clients are saying
            </h1>
            <div class="flex justify-center mx-auto mt-6">
                <span class="inline-block w-40 h-1 bg-blue-500 rounded-full"></span>
                <span class="inline-block w-3 h-1 mx-1 bg-blue-500 rounded-full"></span>
                <span class="inline-block w-1 h-1 bg-blue-500 rounded-full"></span>
            </div>

            <div class="relative max-w-6xl mx-auto mt-16">
                <!-- Wizard Navigation -->
                <div class="flex justify-center space-x-4 mb-6">
                    <button class="wizard-step w-4 h-4 bg-blue-500 rounded-full" data-step="0"></button>
                    <button class="wizard-step w-4 h-4 bg-gray-300 rounded-full" data-step="1"></button>
                </div>

                <!-- Wizard Steps -->
                <div id="wizard" class="flex w-full">
                    <!-- Step 1 -->
                    <div class="flex-none w-full transition-transform duration-500 ease-in-out">
                        <p class="text-center text-gray-500 lg:mx-8">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, quam. Odio voluptatem
                            officiis eos illo!
                            Pariatur, totam alias. Beatae accusamus earum quos obcaecati minima molestias. Possimus
                            minima dolores itaque!
                        </p>
                        <div class="flex flex-col items-center justify-center mt-8">
                            <img class="object-cover rounded-full w-14 h-14"
                                src="https://images.unsplash.com/photo-1595675024853-0f3ec9098ac7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8Y29kaW5nfGVufDB8fDB8fHww"
                                alt="">
                            <div class="mt-4 text-center">
                                <h1 class="font-semibold text-gray-800 dark:text-white">Lonely Dev</h1>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Developer</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex-none w-full transition-transform duration-500 ease-in-out">
                        <p class="text-center text-gray-500 lg:mx-8">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam maiores laborum nisi
                            eaque quaerat veniam pariatur dolorem dolores magni earum.
                        </p>
                        <div class="flex flex-col items-center justify-center mt-8">
                            <img class="object-cover rounded-full w-14 h-14"
                                src="https://images.unsplash.com/photo-1595675024853-0f3ec9098ac7?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8Y29kaW5nfGVufDB8fDB8fHww"
                                alt="">
                            <div class="mt-4 text-center">
                                <h1 class="font-semibold text-gray-800 dark:text-white">Lonely Dev2</h1>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Developer</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button id="prev"
                        class="px-4 py-2 text-gray-800 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-200"
                        disabled>Previous</button>
                    <button id="next"
                        class="px-4 py-2 text-white bg-blue-500 rounded disabled:opacity-50">Next</button>
                </div>
            </div>
        </div>
    </section> --}}
</x-guest-layout>
