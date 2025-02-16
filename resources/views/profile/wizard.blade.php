<div
    class="w-full px-6 py-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md sm:max-w-md drop-shadow-md dark:bg-gray-800">

    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <div x-data="{ step: 1, steps: 4 }">
        <!-- Progress Bar -->
        <div class="relative z-10 w-full h-2 mb-5 bg-gray-200 rounded-full">
            <div class="h-2 bg-blue-500 rounded-full" :style="{ width: ((step - 1) / (steps - 1)) * 100 + '%' }">
            </div>
        </div>
        <!-- Welcome Text -->
        <div class="relative z-10 flex flex-col items-start mb-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Hi Welcome!</h1>
            <p class="text-sm font-bold text-gray-800 dark:text-gray-200">Update your profile!</p>
        </div>

        <form wire.ignore.self>
            <!-- Step 1 -->
            <div class="relative z-10" x-show="step === 1">
                <label class="z-10 flex items-center gap-1 mb-3 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bx-at dark:text-gray-300" style="font-size: 1rem"></i>
                    <input class="border-none grow focus:border-none focus:outline-none focus:ring-0" type="text"
                        wire:model="username" name="username" placeholder="Add a username" required autofocus
                        autocomplete="username" />
                </label>
            </div>

            <!-- Step 2 -->
            <div class="relative z-10" x-show="step === 2">
                <label class="z-10 flex items-center gap-2 mb-3 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bx-user-circle dark:text-gray-300"
                        style="font-size: 1.5rem"></i>
                    <input class="border-none grow focus:border-none focus:outline-none focus:ring-0" type="text"
                        name="first_name" placeholder="First Name" wire:model="first_name" required autofocus
                        autocomplete="first_name" />
                </label>

                <label class="z-10 flex items-center gap-2 mb-3 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bx-user-circle dark:text-gray-300"
                        style="font-size: 1.5rem"></i>
                    <input class="border-none grow focus:border-none focus:outline-none focus:ring-0" type="text"
                        name="last_name" placeholder="Last Name" wire:model="last_name" required
                        autocomplete="last_name" />
                </label>

                <label class="z-10 flex items-center gap-2 mb-3 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bx-user-circle dark:text-gray-300"
                        style="font-size: 1.5rem"></i>
                    <input class="border-none grow focus:border-none focus:outline-none focus:ring-0" type="text"
                        name="middle_name" placeholder="Middle Name (optional)" wire:model="middle_name"
                        autocomplete="middle_name" />
                </label>
            </div>

            <!-- Step 3 -->
            <div class="relative z-10" x-show="step === 3">
                <div class="flex justify-between gap-3 mb-3">
                    <input type="date"
                        class="text-black bg-white border-gray-300 input input-bordered grow dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:border-gray-400 focus:ring-0 focus:outline-none"
                        name="dob" required wire:model="dob" />
                    <div class="flex items-center justify-center gap-1">
                        <span class="text-gray-800 dark:text-gray-200">
                            Gender
                        </span>
                        <div class="flex flex-row items-center gap-1">
                            <label for="male" class="flex items-center gap-2">
                                <i class="text-gray-700 opacity-75 bx bx-male dark:text-gray-300"
                                    style="font-size: 1.5rem"></i>
                                <input type="radio" name="gender" id="male" class="radio" value="male"
                                    wire:model="gender" />
                            </label>
                            <label for="female" class="flex items-center gap-2">
                                <i class="text-gray-700 opacity-75 bx bx-female dark:text-gray-300"
                                    style="font-size: 1.5rem"></i>
                                <input type="radio" name="gender" id="female" value="female" class="radio"
                                    wire:model="gender" />
                            </label>
                        </div>
                    </div>
                </div>
                <label class="flex items-center gap-2 mb-3 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bx-phone-call dark:text-gray-300"
                        style="font-size: 1.5rem"></i>+234
                    <input type="tel" class="border-none grow focus:border-none focus:outline-none focus:ring-0"
                        placeholder="Phone Number" name="phone" minlength="10" id="phone" maxlength="10"
                        wire:model="phone_number" required />
                </label>
            </div>

            <!-- Step 4 -->
            <div class="relative z-10" x-show="step === 4">
                <p>Nationality</p>
                <select
                    class="w-full mb-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm select select-bordered dark:bg-gray-800 dark:border-gray-700"
                    name="nationality" wire:model="nationality">
                    <option value="">-- Nationalities --</option>
                    @unless ($nationalities === null || $nationalities->isEmpty())
                        @foreach ($nationalities as $nations)
                            <option value="{{ $nations->id }}">{{ strtoupper($nations->name) }}</option>
                        @endforeach
                    @endunless
                </select>

                <p>Residential Address</p>

                <select
                    class="w-full mb-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm select select-bordered dark:bg-gray-800 dark:border-gray-700"
                    name="state" wire:model.live="state">
                    <option value="">-- States --</option>
                    @unless ($states === null || $states->isEmpty())
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ strtoupper($state->name) }}</option>
                        @endforeach
                    @endunless
                </select>

                <select
                    class="w-full mb-3 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm select select-bordered dark:bg-gray-800 dark:border-gray-700"
                    name="lga" wire:model="lga">
                    <option value="">-- Lgas --</option>
                    @unless ($lgas === null || $lgas->isEmpty())
                        @foreach ($lgas as $lga)
                            <option value="{{ $lga->id }}">{{ strtoupper($lga->name) }}</option>
                        @endforeach
                    @endunless
                </select>

                <label class="flex items-center gap-2 input input-bordered">
                    <i class="text-gray-700 opacity-75 bx bxs-location-plus dark:text-gray-300"
                        style="font-size: 1.5rem"></i>
                    <input type="text" class="grow" placeholder="Address" name="address" id="address"
                        required wire:model="address" />
                </label>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex items-center justify-between w-full gap-4 mt-5">
                <button type="button" id="prevBtn" x-on:click="step--;" :disabled="step === 1"
                    wire:loading.attr="disabled"
                    class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 text-white hover:text-primary z-10">Previous</button>
                <button type="button" id="nextBtn"
                    class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 text-white hover:text-primary z-10"
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
                    wire:loading.attr="disabled" x-show="!(step === steps)">Next</button>
                <button type="button" id="submitBtn" x-show="(step === steps)"
                    class="btn btn-primary w-[120px] hover:bg-transparent hover:border-2 text-white hover:text-primary z-10"
                    wire:loading.attr="disabled" wire:click="update">Update</button>
            </div>

            <!-- Background Shapes -->
            <div class="w-48 h-48 rounded-full bg-primary absolute z-0 top-[-30px] left-[-30px] opacity-50"></div>
            <div class="w-48 h-48 rounded-full bg-accent absolute z-0 bottom-[-30px] right-[-30px] opacity-50">
            </div>
        </form>
    </div>

    <x-livewire-extras />
</div>
