<x-auth-layout>

    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white drop-shadow-md dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div x-data="{ step: 1, steps: 4 }">
            <!-- Progress Bar -->
            <div class="w-full relative bg-gray-200 h-2 rounded-full mb-5 z-10">
                <div class="bg-blue-500 h-2 rounded-full" :style="{ width: ((step - 1) / (steps - 1)) * 100 + '%' }">
                </div>
            </div>
            <!-- Welcome Text -->
            <div class="flex flex-col relative items-start mb-4 z-10">
                <h1 class="font-bold text-3xl text-gray-800 dark:text-gray-200">Hi Welcome!</h1>
                <p class="font-bold text-sm text-gray-800 dark:text-gray-200">Update your profile!</p>
            </div>

            <form action="">
                <!-- Step 1 -->
                <div class="relative z-10" x-show="step === 1">
                    <label class="input input-bordered flex items-center gap-1 z-10 mb-3">
                        <span class="text-gray-700 dark:text-gray-300 opacity-75" style="font-size: 1rem">@</span>
                        <input class="grow border-none focus:border-none focus:outline-none" type="text"
                            name="username" placeholder="Add a username" :value="old('username')" required autofocus
                            autocomplete="username" />
                    </label>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10" x-show="step === 2">
                    <label class="input input-bordered flex items-center gap-2 z-10 mb-3">
                        <i class="bx bx-user-circle text-gray-700 dark:text-gray-300 opacity-75"
                            style="font-size: 1.5rem"></i>
                        <input class="grow border-none focus:border-none focus:outline-none" type="text"
                            name="first_name" placeholder="First Name" :value="old('first_name')" required autofocus
                            autocomplete="first_name" />
                    </label>

                    <label class="input input-bordered flex items-center gap-2 z-10 mb-3">
                        <i class="bx bx-user-circle text-gray-700 dark:text-gray-300 opacity-75"
                            style="font-size: 1.5rem"></i>
                        <input class="grow border-none focus:border-none focus:outline-none" type="text"
                            name="last_name" placeholder="Last Name" :value="old('last_name')" required
                            autocomplete="last_name" />
                    </label>

                    <label class="input input-bordered flex items-center gap-2 z-10 mb-3">
                        <i class="bx bx-user-circle text-gray-700 dark:text-gray-300 opacity-75"
                            style="font-size: 1.5rem"></i>
                        <input class="grow border-none focus:border-none focus:outline-none" type="text"
                            name="middle_name" placeholder="Middle Name (optional)" :value="old('middle_name')"
                            autocomplete="middle_name" />
                    </label>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10" x-show="step === 3">
                    <div class="flex gap-3 mb-3 justify-between">
                        <input type="date"
                            class="input input-bordered grow border-none focus:border-none focus:outline-none"
                            name="dob" required />
                        <div class="flex gap-1 justify-center items-center">
                            <span class="text-gray-800 dark:text-gray-200">
                                Gender
                            </span>
                            <div class="flex flex-row items-center gap-1">
                                <label for="male" class="flex items-center gap-2">
                                    <i class="bx bx-male text-gray-700 dark:text-gray-300 opacity-75"
                                        style="font-size: 1.5rem"></i>
                                    <input type="radio" name="gender" id="male" class="radio" value="male" />
                                </label>
                                <label for="female" class="flex items-center gap-2">
                                    <i class="bx bx-female text-gray-700 dark:text-gray-300 opacity-75"
                                        style="font-size: 1.5rem"></i>
                                    <input type="radio" name="gender" id="female" value="female" class="radio" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <label class="input input-bordered flex items-center gap-2 mb-3">
                        <i class="bx bx-phone-call text-gray-700 dark:text-gray-300 opacity-75"
                            style="font-size: 1.5rem"></i>+234
                        <input type="tel" class="grow border-none focus:border-none focus:outline-none"
                            placeholder="Phone Number" name="phone" minlength="10" id="phone" maxlength="10"
                            required />
                    </label>

                    <label class="input input-bordered flex items-center gap-2">
                        <i class="bx bxs-location-plus text-gray-700 dark:text-gray-300 opacity-75"
                            style="font-size: 1.5rem"></i>
                        <input type="text" class="grow" placeholder="Address" name="address" id="address"
                            required />
                    </label>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10" x-show="step === 4">
                    <select class="select select-bordered w-full mb-3" name="nationality">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>

                    <select class="select select-bordered w-full mb-3" name="country">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>

                    <select class="select select-bordered w-full mb-3" name="state">
                        <option disabled selected>Who shot first?</option>
                        <option>Han Solo</option>
                        <option>Greedo</option>
                    </select>


                    <input type="text" class="input input-bordered w-full" placeholder="Zip Code" name="zip"
                        id="zip" required />
                </div>

                <!-- Navigation Buttons -->
                <div class="flex gap-4 mt-5 w-full justify-between items-center">
                    <button type="button" id="prevBtn" x-on:click="step--;" :disabled="step === 1"
                        class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 hover:text-primary z-10">Previous</button>
                    <button type="button" id="nextBtn"
                        class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 hover:text-primary z-10"
                        x-on:click="
                                let inputs = document.querySelectorAll(`[x-show='step === ${step}'] input`);
                                let valid = true;
                                inputs.forEach(input => {
                                    if (!input.checkValidity()) {
                                        input.reportValidity();
                                        valid = false;
                                    }
                                });
                                if (valid) step++;
                            "
                        x-show="!(step === steps)">Next</button>
                    <button type="button" id="submitBtn" x-show="(step === steps)"
                        class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 hover:text-primary z-10">Update</button>
                </div>

                <!-- Background Shapes -->
                <div class="w-48 h-48 rounded-full bg-primary absolute z-0 top-[-30px] left-[-30px] opacity-50"></div>
                <div class="w-48 h-48 rounded-full bg-accent absolute z-0 bottom-[-30px] right-[-30px] opacity-50">
                </div>
            </form>
        </div>
    </div>

</x-auth-layout>
