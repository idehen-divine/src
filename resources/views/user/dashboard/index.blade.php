<div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">Overview</h1>
    <div class="grid grid-col-1 md:grid-cols-3 gap-5 mb-4">
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">Total Deposit</span>
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalDeposit->amount }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From:
                        {{ $totalDeposit->start_date ? \Carbon\Carbon::parse($totalDeposit->start_date)->format('F j, Y') : '' }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
                        {{ $totalDeposit->end_date ? \Carbon\Carbon::parse($totalDeposit->end_date)->format('F j, Y') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">Total Withdrawal</span>
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalWithdrawal->amount }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From:
                        {{ $totalWithdrawal->start_date ? \Carbon\Carbon::parse($totalWithdrawal->start_date)->format('F j, Y') : '' }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
                        {{ $totalWithdrawal->end_date ? \Carbon\Carbon::parse($totalWithdrawal->end_date)->format('F j, Y') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">Total Invested</span>
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalInvested->amount }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From:
                        {{ $totalInvested->start_date ? \Carbon\Carbon::parse($totalInvested->start_date)->format('F j, Y') : '' }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
                        {{ $totalInvested->end_date ? \Carbon\Carbon::parse($totalInvested->end_date)->format('F j, Y') : '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">Current Plan Details</h1>
    <div class="grid grid-col-1 md:grid-cols-3 gap-5">
        <div class="flex flex-col md:col-span-2 gap-5">
            <div
                class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                <div>
                    <div class="flex justify-between">
                        <h3>Virtual Account</h3>
                        <a href="{{ route('wallet') }}"
                            class="btn px-4 py-2 bg-orange-500 hover:bg-orange-400 btn-sm text-white float-right">
                            Withdraw <i class="bx bx-wallet"></i>
                        </a>
                    </div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }} {{ $wallet->balance }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        Account Number: {{ $wallet->account_number }}
                    </p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        Account Name: {{ $wallet->account_name }}
                    </p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        Bank: {{ $wallet->bank_name }}
                    </p>
                </div>
            </div>
            <div
                class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
                <div>
                    <div class="flex justify-between">
                        <h3>Local Account</h3>
                        <a href="{{ route('wallet') }}"
                            class="btn px-4 py-2 bg-orange-500 hover:bg-orange-400 btn-sm text-white float-right">
                            Add <i class="bx bx-plus"></i>
                        </a>
                    </div>
                    @if ($bank)
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Account Number: {{ $bank->account_number }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Account Name: {{ $bank->account_name }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Bank: {{ $bank->bank_name }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex justify-between mb-2">
                <h3 class="font-semibold text-gray-800 dark:text-white">Plan Chart</h3>
                <a href="{{ route('checkins') }}"
                    class="btn px-4 py-2 bg-orange-500 hover:bg-orange-400 btn-sm text-white float-right">
                    Checkin Today
                </a>
            </div>
            @if ($plan)
                <canvas id="investmentProgressChart"></canvas>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            window.investmentData = {
                checked: {{ $checkedDays }},
                missed: {{ $missedDays }},
                remaining: {{ $remainingDays }}
            };
        </script>
        @vite(['resources/js/user-dashboard.js'])
    @endpush
</div>
