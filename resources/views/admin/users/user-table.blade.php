<div>
    <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
        <div class="card-body">
            <h2 class="card-title flex flex-row justify-between mb-2">
                Users

                <label class="input input-sm input-bordered flex items-center gap-2 p-2 sm:p-3 lg:p-4 w-full max-w-xs">
                    <input wire:model.live.debounce.300ms="search" type="search"
                        class="input-xs border-none focus:outline-none bg-transparent w-full text-xs"
                        placeholder="Search" />
                    <i class="bx bx-search text-base opacity-75"></i>
                </label>
            </h2>

            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>UID/Email</th>
                            <th>Wallet Balance</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($users === null || $users->isEmpty())
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle h-12 w-12">
                                                    <img src="{{ $user->profile_photo_url }}p"
                                                        alt="{{ ucwords($user->first_name . ' ' . $user->last_name . ' ' . $user->middle_name ?? '') }}" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">
                                                    {{ ucwords($user->first_name . ' ' . $user->last_name . ' ' . $user->middle_name ?? '') }}
                                                </div>
                                                <div class="text-sm opacity-50">{{ strtolower('@' . $user->user_name) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="font-bold">{{ $user->uid }}</div>
                                            <div class="text-sm opacity-50">{{ $user->email }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $user->balance }}</td>
                                    <td>
                                        @if (!$user->is_active)
                                            <div class="badge badge-error">Inactive</div>
                                        @else
                                            <div class="badge badge-success">Active</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex gap-2 justify-end">
                                            <div class="tooltip" data-tip="Top Up" data-tip-offset="10">
                                                <span class="btn btn-sm btn-ghost cursor-pointer"
                                                    wire:click="wallet('{{ $user->id }}')">
                                                    <i class="bx bx-wallet text-warning" style="font-size: 20px;"></i>
                                                </span>
                                            </div>
                                            <div class="tooltip" data-tip="View" data-tip-offset="10">
                                                <span class="btn btn-sm btn-ghost cursor-pointer"
                                                    wire:click="showUser('{{ $user->id }}')">
                                                    <i class="bx bx-show text-primary" style="font-size: 20px;"></i>
                                                </span>
                                            </div>
                                            @if (!$user->is_active)
                                                <div class="tooltip" data-tip="Activate" data-tip-offset="10">
                                                    <span class="btn btn-sm btn-ghost cursor-pointer"
                                                        wire:confirm="Are you sure you want to activate this user?"
                                                        wire:click="toggleStatus('{{ $user->id }}')">
                                                        <i class="bx bx-check text-success" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="tooltip" data-tip="Deactivate" data-tip-offset="10">
                                                    <span class="btn btn-sm btn-ghost cursor-pointer"
                                                        wire:confirm="Are you sure you want to deactivate this user?"
                                                        wire:click="toggleStatus('{{ $user->id }}')">
                                                        <i class="bx bx-x text-error" style="font-size: 20px;"></i>
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="tooltip" data-tip="Delete" data-tip-offset="10">
                                                <span class="btn btn-sm btn-ghost cursor-pointer"
                                                    wire:click="confirmUserDeletion('{{ $user->id }}')">
                                                    <i class="bx bx-trash text-error" style="font-size: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No users Found</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
                @unless ($users === null || $users->isEmpty())
                    <div class="mt-3">
                        <div class="flex gap-2 justify-between align-center">
                            <div class="mb-3">
                                <label class="flex align-center gap-3" for="paginate">
                                    <select wire:model.live="perPage" name="paginate" id="paginate"
                                        class="select select-bordered">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </label>
                            </div>
                            <div class="mb-3">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
        </div>
    </div>
    <x-livewire-extras />

    @if ($showModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showModal">

            <x-slot name="title">
                {{ __('User Record') }}
            </x-slot>

            <x-slot name="content">
                @if ($showPhoto)
                    <div class="flex justify-center mb-4">
                        <!-- Current Profile Photo -->
                        <div class="mt-2">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                class="block rounded-md h-24 w-24 object-cover">
                        </div>
                    </div>
                @endif
                <div class="flex flex-col">
                    <span class="mb-2">{{ 'UID: ' . $user->uid }}</span>
                    <span class="mb-2">{{ 'Email: ' . $user->email }}</span>
                    <span class="mb-2">{{ 'Username: @' . $user->user_name }}</span>
                    <span class="mb-2">{{ 'First Name: ' . $user->first_name }}</span>
                    <span class="mb-2">{{ 'Last Name: ' . $user->last_name }}</span>
                    <span class="mb-2">{{ 'Middle Name: ' . $user->middle_name ?? 'N/A' }}</span>
                    <span class="mb-2">{{ 'Wallet Ballance: ' . $user->balance }}</span>
                    <span class="mb-2">{{ 'Status: ' . ($user->is_active ? 'Active' : 'Inactive') }}</span>
                    <span class="mb-2">{{ 'Gender: ' . ($user->gender ?? 'N/A') }}</span>
                    <span class="mb-2">
                        {{ 'Date of Birth: ' . ($user->dob ? \Carbon\Carbon::parse($user->dob)->format('F j, Y') : 'N/A') }}
                    </span>
                    <span
                        class="mb-2">{{ 'Nationality: ' . ($user->nationalities_id ? helpers()->nation($user->nationalities_id) : 'N/A') }}</span>
                    <span
                        class="mb-2">{{ 'Country: ' . ($user->countries_id ? helpers()->country($user->countries_id) : 'N/A') }}</span>
                    <span
                        class="mb-2">{{ 'State: ' . ($user->states_id ? helpers()->state($user->states_id) : 'N/A') }}</span>
                    <span
                        class="mb-2">{{ 'LGA: ' . ($user->lgas_id ? helpers()->lga($user->lgas_id) : 'N/A') }}</span>
                    <span class="mb-2">{{ 'Created At: ' . $user->created_at->format('F j, Y') }}</span>
                </div>

            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </x-slot>
        </x-dialog-modal>
    @endif

    @if ($showWalletModal)
        <x-dialog-modal maxWidth="sm" wire:model.live="showWalletModal">

            <x-slot name="title">
                {{ __('TopUp User Wallet') }}
            </x-slot>

            <x-slot name="content">
                <x-label for="balance" value="{{ __('Balance') }}" />
                <x-input id="balance" class="block mt-1 w-full" type="number" name="balance" wire:model="balance"
                    required autofocus autocomplete="balance" />
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('showWalletModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <button class="btn btn-primary btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="updateWallet" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif

</div>
