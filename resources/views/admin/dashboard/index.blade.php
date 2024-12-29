<div>

    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">Overview</h1>
    <div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-4">
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">Total Users</span>
                </div>
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">
                        {{ $totalUsers->count }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From:
                        {{ $totalUsers->start_date ? \Carbon\Carbon::parse($totalUsers->start_date)->format('F j, Y') : '' }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
                        {{ $totalUsers->end_date ? \Carbon\Carbon::parse($totalUsers->end_date)->format('F j, Y') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">Total Deposit</span>
                </div>
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalDeposit->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalDeposit->count }}</p>
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
                    <span class="text-md font-bold text-gray-800 dark:text-white">Total Withdrawal</span>
                </div>
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalWithdrawal->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalWithdrawal->count }}</p>
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
                    <span class="text-md font-bold text-gray-800 dark:text-white">Total Invested</span>
                </div>
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalInvested->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalInvested->count }}</p>
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

    <div class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-4">
        <div
            class="py-2 px-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">Total Admin Deposit</span>
                </div>
                <div class="flex items-center">
                    <span class="text-md font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalAdminDeposit->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalAdminDeposit->count }}</p>
        </div>
        <div
            class="py-2 px-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">Total Admin Withdrawal</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalAdminWithdrawal->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalAdminWithdrawal->count }}</p>
        </div>
        <div
            class="py-2 px-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">Total Withdrawn Interest</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}{{ $totalWithdrawnInterest->amount }}
                    </span>
                </div>
            </div>
            <p class="text-sm mb-1">Count: {{ $totalWithdrawnInterest->count }}</p>
        </div>
        <div
            class="py-2 px-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">Total Failed Transactions</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-bold text-gray-800 dark:text-white">
                        {{ $totalFailedTransactions->count }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
