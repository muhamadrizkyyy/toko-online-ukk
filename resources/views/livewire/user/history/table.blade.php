<div>
    <main class="p-4 md:pb-10">
        <section id="table-history" class="relative bg-white p-6 min-h-screen rounded-lg">
            <div class="title flex gap-2 mb-3 text-sky-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M3.045 11.75c.126.714.303 1.541.51 2.507l.428 2c.487 2.273.731 3.409 1.556 4.076S7.526 21 9.85 21h4.3c2.324 0 3.486 0 4.31-.667c.826-.667 1.07-1.803 1.556-4.076l.429-2c.207-.966.384-1.793.51-2.507z"
                        opacity="0.5" />
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.25 14a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75"
                        clip-rule="evenodd" />
                    <path fill="currentColor"
                        d="M8.33 2.665a.75.75 0 0 1 1.341.67l-1.835 3.67Q8.56 7 9.422 7h5.156q.863-.001 1.586.005l-1.835-3.67a.75.75 0 0 1 1.342-.67l2.201 4.402c1.353.104 2.202.37 2.75 1.047c.436.539.576 1.209.525 2.136H21q.075 0 .146.014a13 13 0 0 1-.19 1.486H3.045a13 13 0 0 1-.192-1.486A1 1 0 0 1 3 10.25h-.147c-.051-.927.09-1.597.525-2.136c.548-.678 1.397-.943 2.75-1.047z" />
                </svg>
                <h3 class="text-3xl font-bold ">History</h3>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b text-xs md:text-sm border-gray-600">
                        <th class="py-2">Code</th>
                        <th>date</th>
                        <th>amount</th>
                        <th>total</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->getTransactionByUser() as $item)
                        <tr class="text-center text-xs md:text-sm border-b border-gray-600">
                            <td class="py-5 justify-items-center">
                                {{ $item->transaction_code }}
                            </td>
                            <td class="w-[20%]">
                                <span class="text-balance">
                                    {{ $item->transaction_date }}
                                </span>
                            </td>
                            <td>
                                {{ $item->amount }}
                            </td>
                            <td>
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </td>
                            <td>
                                @if ($item->status == 'pending')
                                    <button type="button"
                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-2 py-1 md:px-5 md:py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                        {{ $item->status }}
                                    </button>
                                @elseif ($item->status == 'pending cancelled')
                                    <button type="button"
                                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg px-1.5 py-1.5 md:px-5 md:py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                        {{ $item->status }}
                                    </button>
                                @elseif ($item->status == 'sending')
                                    <button type="button"
                                        class="text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg px-2 py-1.5 md:px-5 md:py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                                        {{ $item->status }}
                                    </button>
                                @elseif ($item->status == 'completed')
                                    <button type="button"
                                        class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg px-2 py-1.5 md:px-5 md:py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                        {{ $item->status }}
                                    </button>
                                @else
                                    <button type="button"
                                        class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg px-2 py-1.5 md:px-5 md:py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                        {{ $item->status }}
                                    </button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('history.detail', $item->id) }}"
                                    class="inline-flex items-center px-2 py-1.5 md:px-5 md:py-2.5 font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </section>
    </main>
</div>
