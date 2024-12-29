<div>
    <livewire:admin.investments.cards />

    <div class="grid grid-col-1 md:grid-cols-2 gap-5">
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-2">
                {{ settings()->getValue('app_currency_logo') }}500 Daily
            </h3>
            <div>
                <div class="flex gap-2">
                    <select wire:model.live="planAdirection"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <option value="DESC">Top</option>
                        <option value="ASC">Bottom</option>
                    </select>
                    <select wire:model.live="planAColumn"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">.
                        <option value="joined_at">Latest</option>
                        <option value="total_invested">Invested</option>
                        <option value="current_streak">Current Streak</option>
                        <option value="longest_streak">Longest Streak</option>
                    </select>
                    <select wire:model.live="planAPerPage"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="overflow-x-auto mt-4">
                    <table class="table table-compact w-full">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Username/UID</th>
                                <th>Invested</th>
                                <th>Total Checkedin</th>
                                <th>Last Checkedin</th>
                                <th>Current Streak</th>
                                <th>Longest Streak</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @unless ($planAUsers === null)
                                @foreach ($planAUsers as $planAUser)
                                    <tr class="text-sm">
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">
                                            <div>
                                                <div class="font-medium">
                                                    {{ '@' . $planAUser->user_name }}
                                                </div>
                                                <div class="text-xs">
                                                    {{ $planAUser->uid }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ settings()->getValue('app_currency_logo') }}{{ $planAUser->total_invested }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planAUser->total_checkedin }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($planAUser->last_checkedin)->diffForHumans() }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planAUser->current_streak }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planAUser->longest_streak }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($planAUser->joined_at)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endunless
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white mb-2">
                {{ settings()->getValue('app_currency_logo') }}1000 Daily
            </h3>
            <div>
                <div class="flex gap-2">
                    <select wire:model.live="planBdirection"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <option value="DESC">Top</option>
                        <option value="ASC">Bottom</option>
                    </select>
                    <select wire:model.live="planBColumn"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">.
                        <option value="joined_at">Latest</option>
                        <option value="total_invested">Invested</option>
                        <option value="current_streak">Current Streak</option>
                        <option value="longest_streak">Longest Streak</option>
                    </select>
                    <select wire:model.live="planBPerPage"
                        class="select select-bordered w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="overflow-x-auto mt-4">
                    <table class="table table-compact w-full">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Username/UID</th>
                                <th>Invested</th>
                                <th>Total Checkedin</th>
                                <th>Last Checkedin</th>
                                <th>Current Streak</th>
                                <th>Longest Streak</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @unless ($planBUsers === null)
                                @foreach ($planBUsers as $planBUser)
                                    <tr class="text-sm">
                                        <td class="whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="whitespace-nowrap">
                                            <div>
                                                <div class="font-medium">
                                                    {{ '@' . $planBUser->user_name }}
                                                </div>
                                                <div class="text-xs">
                                                    {{ $planBUser->uid }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ settings()->getValue('app_currency_logo') }}{{ $planBUser->total_invested }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planBUser->total_checkedin }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($planBUser->last_checkedin)->diffForHumans() }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planBUser->current_streak }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ $planBUser->longest_streak }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ \Carbon\Carbon::parse($planBUser->joined_at)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endunless
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
