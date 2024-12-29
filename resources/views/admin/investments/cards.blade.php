<div class="mb-4">
    <div class="grid grid-col-1 md:grid-cols-2 gap-5">
        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                            {{ settings()->getValue('app_currency_logo') }}500 Daily
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Invested: {{ settings()->getValue('app_currency_logo') }}{{ $planADetails->totalInvested }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Running Investments: {{ settings()->getValue('app_currency_logo') }}{{ $planADetails->totalRunningInvested }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Running Investments Users: {{ $planADetails->totalRunningInvestmentsUser }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="py-4 px-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                            {{ settings()->getValue('app_currency_logo') }}1000 Daily
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Invested: {{ settings()->getValue('app_currency_logo') }}{{ $planBDetails->totalInvested }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Running Investments: {{ settings()->getValue('app_currency_logo') }}{{ $planBDetails->totalRunningInvested }}
                        </p>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                            Toatal Running Investments Users: {{ $planBDetails->totalRunningInvestmentsUser }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
