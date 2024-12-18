<div>
    <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
        <div class="card-body">
            <div class="overflow-x-auto w-full">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 text-gray-800 dark:text-gray-200">
                    <div class="border border-gray-700 rounded-lg p-5 bg-ghost shadow-md">
                        <div class="text-start">
                            <h1 class="mb-4">Wallet</h1>
                            <p>Balance: {{ settings()->getValue('app_currency_logo', '$') . $balance }}</p>
                        </div>
                        <h1 class="mb-4">Deposit</h1>
                        <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-label for="amount" value="{{ __('Amount') }}" />
                                <x-input id="amount" class="block mt-1 w-full" type="number" wire:model="amount"
                                    required />

                                <x-input-error for="amount" class="mt-2" />
                            </div>

                            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                                <!-- Game Photo File Input -->
                                <input type="file" id="photo" class="hidden" wire:model="photo" x-ref="photo"
                                    x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                            " />

                                <label for="photo" class="block font-bold text-lg mb-2">Game Photo</label>

                                <!-- Current Game Photo -->
                                <div class="mt-2 flex justify-center" x-show="!photoPreview">
                                    <button class="btn btn-primary text-gray-100"
                                        x-on:click.prevent="$refs.photo.click()">Add Photo</button>
                                </div>

                                <!-- New Game Photo Preview -->
                                <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-md w-60 h-60 bg-cover bg-no-repeat bg-center"
                                        x-on:click.prevent="$refs.photo.click()"
                                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                <x-input-error for="photo" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="button"
                                    class="btn btn-primary uppercase text-xs text-gray-800 dark:text-gray-200"
                                    wire:click="deposit" wire:target="photo" wire:loading.attr="disabled">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="border border-gray-700 rounded-lg p-5 bg-ghost shadow-md">
                        <h1 class="mb-4">Withdraw</h1>
                        <form>
                            @csrf
                            <div>
                                <x-label for="bank" value="{{ __('Bank Name') }}" />
                                <x-input id="bank" class="block mt-1 w-full" type="text" wire:model="bank"
                                    required />
                                <x-input-error for="bank" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="account_name" value="{{ __('Account Name') }}" />
                                <x-input id="account_name" class="block mt-1 w-full" type="text" wire:model="account_name"
                                    required />
                                <x-input-error for="account_name" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="account_number" value="{{ __('Account Number') }}" />
                                <x-input id="account_number" class="block mt-1 w-full" type="text" wire:model="account_number"
                                    required />
                                <x-input-error for="account_number" class="mt-2" />
                            </div>
                            <div>
                                <x-label for="withdrawal_amount" value="{{ __('Amount') }}" />
                                <x-input id="withdrawal_amount" class="block mt-1 w-full" type="text" wire:model="withdrawal_amount"
                                    required />
                                <x-input-error for="withdrawal_amount" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="button"
                                    class="btn btn-primary uppercase text-xs text-gray-800 dark:text-gray-200"
                                    wire:click="withdraw" wire:loading.attr="disabled">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-livewire-extras />
</div>
