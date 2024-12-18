<div>
    <div class="card bg-base-100 w-80vw h-50vh shadow-xl">
        <div class="card-body">
            <h2 class="card-title flex flex-row justify-between mb-2">
                <span class="hidden sm:block">
                    Games
                </span>

                <div class="flex justify-between gap-3">
                    <label class="input input-sm input-bordered flex items-center gap-2 p-2 sm:p-3 lg:p-4 w-full max-w-xs">
                        <input wire:model.live.debounce.300ms="search" type="search"
                            class="input-xs border-none focus:outline-none bg-transparent w-full text-xs"
                            placeholder="Search" />
                        <i class="bx bx-search text-base opacity-75"></i>
                    </label>
                    <button type="button" class="btn btn-sm btn-primary text-gray-800 dark:text-gray-200"
                        wire:click="toggleCreateModal">
                        <span class="hidden sm:block">
                            Create
                        </span>
                        <i class="bx bx-plus text-xl p-0 m-0 opacity-75"></i>
                    </button>
                </div>

            </h2>

            <div class="overflow-x-auto w-full">
                <table class="table table-xs w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Game ID</th>
                            <th>Price Per Ticket</th>
                            <th>Reward</th>
                            <th>Recurrence</th>
                            <th>Start Date</th>
                            <th>Draw Time</th>
                            <th>Created At</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @unless ($games === null || $games->isEmpty())
                            @foreach ($games as $game)
                                <tr>
                                    <td>
                                        <div class="avatar">
                                            <div class="rounded-md h-10 w-10 2">
                                                <img src="{{ $game->photo_url }}" alt="{{ ucwords($game->name) }}"
                                                    class="object-cover">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap">{{ ucwords($game->name) }}</td>
                                    <td class="whitespace-nowrap">{{ strtoupper($game->game_id) }}</td>
                                    <td class="whitespace-nowrap">{{ $game->price }}</td>
                                    <td class="whitespace-nowrap">{{ $game->reward }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ ucwords(str_replace('_', ' ', ucwords($game->recurrence))) }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($game->start_date)->format('F j, Y') }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($game->draw_time)->format('g:i A') }}</td>
                                    <td class="whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($game->created_at)->format('F j, Y, g:i A') }}</td>
                                    <td>{{ $game->description ?? '' }}</td>
                                    <td class="whitespace-nowrap">
                                        @if (!$game->is_active)
                                            <div class="badge badge-error">Inactive</div>
                                        @else
                                            <div class="badge badge-success">Active</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="flex gap-2 justify-end">
                                            <div class="tooltip" data-tip="View" data-tip-offset="10">
                                                <a class="btn btn-sm btn-ghost cursor-pointer"
                                                    href="{{ route('game', $game->id) }}">
                                                    <i class="bx bx-show text-primary" style="font-size: 20px;"></i>
                                                </a>
                                            </div>
                                            <div class="tooltip" data-tip="Update" data-tip-offset="10">
                                                <span class="btn btn-sm btn-ghost cursor-pointer"
                                                    wire:click="update('{{ $game->id }}')">
                                                    <i class="bx bx-edit text-warning" style="font-size: 20px;"></i>
                                                </span>
                                            </div>
                                            @if (!$game->is_active)
                                                <div class="tooltip" data-tip="Play" data-tip-offset="10">
                                                    <span class="btn btn-sm btn-ghost cursor-pointer"
                                                        wire:confirm="Are you sure you want to activate this game?"
                                                        wire:click="toggleStatus('{{ $game->id }}')">
                                                        <i class="bx bx-play text-success" style="font-size: 25px;"></i>
                                                    </span>
                                                </div>
                                            @else
                                                <div class="tooltip" data-tip="Stop" data-tip-offset="10">
                                                    <span class="btn btn-sm btn-ghost cursor-pointer"
                                                        wire:confirm="Are you sure you want to deactivate this game?"
                                                        wire:click="toggleStatus('{{ $game->id }}')">
                                                        <i class="bx bx-stop text-error" style="font-size: 25px;"></i>
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="tooltip" data-tip="Delete" data-tip-offset="10">
                                                <span class="btn btn-sm btn-ghost cursor-pointer"
                                                    wire:click="confirmUserDeletion('{{ $game->id }}')">
                                                    <i class="bx bx-trash text-error" style="font-size: 20px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">No games Found</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
                @unless ($games === null || $games->isEmpty())
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
                                {{ $games->links() }}
                            </div>
                        </div>
                    </div>
                @endunless
            </div>
        </div>
    </div>

    <x-livewire-extras />

    @if ($showCreateModal)
        <x-dialog-modal maxWidth="md" wire:model.live="showCreateModal">

            <x-slot name="title">
                {{ __('Create Game') }}
            </x-slot>

            <x-slot name="content">
                <form>
                    @csrf
                    <div class="mb-2">
                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                            <!-- Game Photo File Input -->
                            <input type="file" id="game_photo" class="hidden" wire:model="gamePhoto"
                                x-ref="game_photo"
                                x-on:change="
                                photoName = $refs.game_photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.game_photo.files[0]);
                            " />

                            <label for="game_photo" class="block font-bold text-lg mb-2">Game Photo</label>

                            <!-- Current Game Photo -->
                            <div class="mt-2 flex justify-center" x-show="!photoPreview">
                                <img src="{{ $photo_url }}" x-on:click.prevent="$refs.game_photo.click()"
                                    alt="Current Game Photo" class="rounded-md h-40 w-40 object-cover">
                            </div>

                            <!-- New Game Photo Preview -->
                            <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-md w-40 h-40 bg-cover bg-no-repeat bg-center"
                                    x-on:click.prevent="$refs.game_photo.click()"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            @if ($photo_path)
                                <button type="button" class="mt-3 ms-3 px-4 py-2 bg-red-600 text-white rounded-lg"
                                    wire:click="deleteGamePhoto">
                                    Remove Photo
                                </button>
                            @endif

                            <x-input-error for="gamePhoto" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-2">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model="name" wire:model="name" required autofocus autocomplete="name"
                            placeholder="Enter Game Name" />
                        @error('name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                            wire:model="description" autocomplete="description"
                            placeholder="Enter Game Description" />
                        @error('description')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="price" value="{{ __('Price') }}" />
                        <x-input id="price" class="block mt-1 w-full" type="text" name="price"
                            wire:model="price" autocomplete="price" placeholder="0.00" />
                        @error('price')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="reward" value="{{ __('Reward') }}" />
                        <x-input id="reward" class="block mt-1 w-full" type="text" name="reward"
                            wire:model="reward" placeholder="0.00" autocomplete="reward" />
                        @error('reward')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="draw_time" value="{{ __('Draw Time') }}" />
                        <x-input id="draw_time" class="block mt-1 w-full" type="time" name="draw_time"
                            wire:model="draw_time" autocomplete="draw_time" />
                        @error('draw_time')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="start_date" value="{{ __('Start Date') }}" />
                        <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date"
                            wire:model="start_date" autocomplete="start_date" />
                        @error('start_date')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <x-label for="recurrence" value="{{ __('Recurrence') }}" />
                        <x-select id="recurrence" class="block mt-1 w-full" wire:model="recurrence"
                            name="recurrence" required>
                            <option value="">Select Recurrence</option>
                            <option value="daily">Daily</option>
                            <option value="twice_a_week">Twice a Week</option>
                            <option value="weekly">Weekly</option>
                            <option value="bi_weekly">Bi-Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="every_2_months">Every 2 Months</option>
                            <option value="every_3_months">Every 3 Months</option>
                            <option value="every_6_months">Every 6 Months</option>
                            <option value="yearly">Yearly</option>
                        </x-select>
                        @error('recurrence')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <button
                    class="btn btn-ghost border-1 dark:border-gray-200 border-gray-800 btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="toggleCreateModal" wire:target="gamePhoto,store" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>
                <button class="btn btn-primary btn-sm uppercase text-xs text-gray-800 dark:text-gray-200"
                    wire:click="store" wire:target="gamePhoto,store" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </button>
            </x-slot>
        </x-dialog-modal>
    @endif
</div>
