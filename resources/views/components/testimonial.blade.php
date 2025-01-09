{{-- <section class="max-w-2xl mx-auto pb-10 mb-4">
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
            <img src="https://placehold.co/100x100" alt="Client Photo" class="rounded-full border-4 border-white mb-4" />
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
</section> --}}
