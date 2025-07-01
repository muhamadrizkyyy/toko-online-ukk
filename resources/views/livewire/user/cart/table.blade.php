<div>
    <main class="p-4 md:pb-10">
        <section id="table-history" class="relaative bg-white p-6 rounded-lg h-96 overflow-y-scroll">
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
                <h3 class="text-3xl font-bold ">Cart</h3>
            </div>
            <table class="table-auto w-full">
                <thead>
                    <tr class="border-b text-xs md:text-sm border-gray-600">
                        <th class="py-2">Image</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->getCart() as $item)
                        <tr class="text-center text-xs md:text-sm border-b border-gray-600">
                            <td class="py-5 justify-items-center">
                                <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                    class="w-10 h-10 md:w-20 md:h-20" alt="">
                            </td>
                            <td class="w-[20%]">
                                <span class="text-balance">
                                    {{ $item->product->name }}
                                </span>
                            </td>
                            <td>
                                {{ $item->qty }}
                            </td>
                            <td>
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                            <td>
                                {{-- <input type="checkbox" id="product-{{ $item->id }}"
                                    wire:model="pickCart.{{ $item->id }}" value="{{ $item->id }}"
                                    class="hidden peer" />
                                <label for="product-{{ $item->id }}"
                                    class="text-white text-[.5rem] inline peer-checked:hidden bg-sky-500 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg md:text-sm px-2 md:px-4 py-2 md:py-2.5 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                                    Choose
                                </label>
                                <label for="product-{{ $item->id }}"
                                    class="text-white text-[.5rem] hidden peer-checked:inline bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg md:text-sm px-2 md:px-4 py-2 md:py-2.5 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                                    Cancel
                                </label> --}}
                                <button type="button" wire:click="delete({{ $item->id }})"
                                    class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center text-xs md:text-sm border-b border-gray-600">
                            <td class="py-5 justify-items-center" colspan="5">
                                No Data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if (count($this->getCart()) > 0)
                <div
                    class="sticky bottom-0 left-0 z-50 w-full rounded-lg h-16 bg-yellow-400 border-t border-yellow-200 dark:bg-yellow-700 dark:border-yellow-600">
                    <div class="grid h-full grid-cols-2 justify-between">
                        {{-- <span class="inline-flex flex-col items-center justify-center font-medium px-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M3.045 11.75c.126.714.303 1.541.51 2.507l.428 2c.487 2.273.731 3.409 1.556 4.076S7.526 21 9.85 21h4.3c2.324 0 3.486 0 4.31-.667c.826-.667 1.07-1.803 1.556-4.076l.429-2c.207-.966.384-1.793.51-2.507z"
                                    opacity="0.5" />
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M9.25 14a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75"
                                    clip-rule="evenodd" />
                                <path fill="currentColor"
                                    d="M8.33 2.665a.75.75 0 0 1 1.341.67l-1.835 3.67Q8.56 7 9.422 7h5.156q.863-.001 1.586.005l-1.835-3.67a.75.75 0 0 1 1.342-.67l2.201 4.402c1.353.104 2.202.37 2.75 1.047c.436.539.576 1.209.525 2.136H21q.075 0 .146.014a13 13 0 0 1-.19 1.486H3.045a13 13 0 0 1-.192-1.486A1 1 0 0 1 3 10.25h-.147c-.051-.927.09-1.597.525-2.136c.548-.678 1.397-.943 2.75-1.047z" />
                            </svg>
                            <span class="text-sm">
                                Rp 150.000
                            </span>
                        </span> --}}
                        <button wire:click="checkout"
                            class="col-span-6 inline-flex flex-col items-center justify-center font-medium px-5 hover:rounded-e-lg hover:bg-yellow-700 dark:hover:bg-yellow-800 group">
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white">
                                Checkout
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        </section>
    </main>
</div>
