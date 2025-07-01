<div>
    <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <!-- Main widget -->
        <a href="{{ route('dashboard.admin') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countProduct() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Product</h3>
                </div>
            </div>
        </a>
        <a href="{{ route('users') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countUser() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Buyer</h3>
                </div>
            </div>
        </a>
        <a href="{{ route('transaction') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countTransactionCompleted() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Transaction Completed</h3>
                </div>
            </div>
        </a>
        <a href="{{ route('transaction') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countTransactionPending() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Transaction Pending</h3>
                </div>
            </div>
        </a>
        <a href="{{ route('transaction') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countTransactionSending() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Transaction Sending</h3>
                </div>
            </div>
        </a>
        <a href="{{ route('transaction') }}"
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $this->countTransactionCancelled() }}</span>
                    <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Transaction Cancelled</h3>
                </div>
            </div>
        </a>
        <!--Tabs widget -->

    </div>
</div>
