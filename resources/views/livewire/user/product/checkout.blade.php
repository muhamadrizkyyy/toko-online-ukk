<div>
    <main class="p-4">
        @if (session()->has('error'))
            <div id="alert-2"
                class="flex items-center p-4 mb-2 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @elseif (session()->has('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <section id="transaction_form" class="transaction_form max-w-lg mx-auto">
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-5 text-2xl font-bold tracking-tight text-center">
                    Transaction Form
                </h5>
                <div
                    class="flex items-center w-full bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                    <div class="img w-1/2">
                        <img class="object-cover aspect-square rounded-s-lg h-auto w-48"
                            src="{{ asset('storage/products/' . $data_product->image) }}" alt="">
                    </div>
                    <div class="flex flex-col justify-between w-full p-4 leading-normal">
                        <h5 class="text-lg font-bold tracking-tigh line-clamp-1">
                            Rp {{ number_format($data_product->price, 0, ',', '.') }}
                        </h5>
                        <h6 class="mb-2 text-lg font-bold tracking-tight line-clamp-1">
                            {{ $data_product->name }}
                        </h6>
                        <div class="qty mt-2">
                            <div class="inline-flex rounded-md shadow-xs" role="group">
                                <button type="button" wire:click="incrementQty"
                                    {{ $qty >= $data_product->stock ? 'disabled' : '' }}
                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                    </svg>
                                </button>
                                <button type="button" disabled
                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                    {{ $qty }}
                                </button>
                                <button type="button" wire:click="decrementQty" {{ $qty == 0 ? 'disabled' : '' }}
                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 12.998H5v-2h14z" />
                                    </svg>
                                </button>
                                @if ($qty == 0)
                                    <span class="text-red-600 ms-2 self-center text-xs font-bold">
                                        Qty doesn't 0
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <form class="mt-5">
                    <div class="mb-6">
                        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Fee Shipping
                        </label>
                        <input type="number" id="total" wire:model="fee_shipping"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="-" readonly />
                    </div>
                    <div class="mb-5">
                        <label for="methods" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Payment Method
                        </label>
                        <select id="methods" wire:model="methods"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected readonly>Choose a payment methods</option>
                            @foreach ($this->getPaymentMethod() as $item)
                                <option value="{{ $item->id }}">{{ $item->payment_name }}</option>
                            @endforeach
                        </select>
                        @error('methods')
                            <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Total
                        </label>
                        <input type="number" id="total" wire:model="total"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="-" readonly />
                    </div>
                    <button type="submit" wire:click.prevent='checkout' {{ $qty == 0 ? 'disabled' : '' }}
                        class="text-white bg-green-700 hover:bg-green-800 disabled:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Checkout
                    </button>
                </form>
            </div>
        </section>
    </main>
</div>
