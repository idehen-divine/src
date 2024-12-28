<div>
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">Overview</h1>
    <div class="grid grid-col-1 md:grid-cols-3 gap-5">
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">Total Deposit</span>
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">
                        {{ settings()->getValue('app_currency_logo') }}0.00
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From: 
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
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
                        {{ settings()->getValue('app_currency_logo') }}0.00
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From: 
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
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
                        {{ settings()->getValue('app_currency_logo') }}0.00
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        From: 
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-gray-800 dark:text-white">
                        To:
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
