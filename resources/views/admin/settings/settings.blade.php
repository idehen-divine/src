<div>
    <x-validation-errors/>
    <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
        <div class="card-body">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="">
                    <h2 class="card-title">App Meta Data</h2>
                    <div class="mb-3">
                        <x-label for="app_name" :value="__('App Name')" />
                        <x-input id="app_name" class="block mt-1 w-full" type="text" wire:model="app_name" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_description" :value="__('App Description')" />
                        <x-input id="app_description" class="block mt-1 w-full" type="text"
                            wire:model="app_description" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_key_words" :value="__('Key Words')" />
                        <x-input id="app_key_words" class="block mt-1 w-full" type="text"
                            wire:model="app_key_words" />
                        <p class="text-xs">words seperated with a "," for seo optimization</p>
                    </div>
                </div>
                <div class="">
                    <h2 class="card-title">App Contact Info</h2>
                    <div class="mb-3">
                        <x-label for="app_email" :value="__('Email Address')" />
                        <x-input id="app_email" class="block mt-1 w-full" type="email" wire:model="app_email" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_phone" :value="__('Telephone Number')" />
                        <x-input id="app_phone" class="block mt-1 w-full" type="tel" wire:model="app_phone" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_address" :value="__('Address')" />
                        <x-input id="app_address" class="block mt-1 w-full" type="text" wire:model="app_address" />
                    </div>
                </div>
                <div class="">
                    <h2 class="card-title">App CUrrency Info</h2>
                    <div class="mb-3">
                        <x-label for="app_timezone" :value="__('App Timezone')" />
                        <select id="timezone"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm    "
                            wire:model="app_timezone">
                            <option value="Europe/London">UTC+00:00</option>
                            <option value="Africa/Lagos">UTC+01:00</option>
                            <option value="Africa/Cairo">UTC+02:00</option>
                            <option value="Asia/Riyadh">UTC+03:00</option>
                            <option value="Asia/Dubai">UTC+04:00</option>
                            <option value="Asia/Karachi">UTC+05:00</option>
                            <option value="Asia/Dhaka">UTC+06:00</option>
                            <option value="Asia/Bangkok">UTC+07:00</option>
                            <option value="Asia/Singapore">UTC+08:00</option>
                            <option value="Asia/Tokyo">UTC+09:00</option>
                            <option value="Australia/Sydney">UTC+10:00</option>
                            <option value="Pacific/Noumea">UTC+11:00</option>
                            <option value="Pacific/Auckland">UTC+12:00</option>
                            <option value="Atlantic/Azores">UTC-01:00</option>
                            <option value="Atlantic/Cape_Verde">UTC-02:00</option>
                            <option value="America/Argentina/Buenos_Aires">UTC-03:00</option>
                            <option value="America/Houston">UTC-04:00</option>
                            <option value="America/New_York">UTC-05:00</option>
                            <option value="America/Chicago">UTC-06:00</option>
                            <option value="America/Denver">UTC-07:00</option>
                            <option value="America/Los_Angeles">UTC-08:00</option>
                            <option value="Pacific/Honolulu">UTC-09:00</option>
                            <option value="Pacific/Honolulu">UTC-10:00</option>
                            <option value="Pacific/Midway">UTC-11:00</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <x-label for="app_currency" :value="__('App Currency')" />
                        <x-input id="app_currency" class="block mt-1 w-full" type="tel" wire:model="app_currency" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_currency_logo" :value="__('App Currency Symbol')" />
                        <x-input id="app_currency_logo" class="block mt-1 w-full" type="text"
                            wire:model="app_currency_logo" />
                    </div>
                </div>
                <div class="">
                    <h2 class="card-title">App Socials</h2>
                    <div class="mb-3">
                        <x-label for="app_instagram" :value="__('Instagram URL')" />
                        <x-input id="app_instagram" class="block mt-1 w-full" type="email"
                            wire:model="app_instagram" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_facebook" :value="__('Facebook URL')" />
                        <x-input id="app_facebook" class="block mt-1 w-full" type="tel"
                            wire:model="app_facebook" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_youtube" :value="__('Youtube URL')" />
                        <x-input id="app_youtube" class="block mt-1 w-full" type="text"
                            wire:model="app_youtube" />
                    </div>
                    <div class="mb-3">
                        <x-label for="app_twitter" :value="__('Twitter URL')" />
                        <x-input id="app_twitter" class="block mt-1 w-full" type="text"
                            wire:model="app_twitter" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="btn bg-orange-500 hover:bg-orange-400 border-none mt-4 text-white text-lg"
                    wire:loading.attr="disabled" wire:click="save">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </div>
    <x-livewire-extras />
</div>
