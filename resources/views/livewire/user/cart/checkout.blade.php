<div>
    <main class="p-4">
        <div class="grid sm:grid-cols-2 gap-5">
            <section id="list_product" class="list_product">
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($this->getCartByUser() as $p)
                        <div
                            class="flex flex-col items-center w-full bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="img md:w-1/2">
                                <img class="object-cover aspect-square rounded-e-lg md:rounded-s-lg h-auto w-full"
                                    src="{{ asset('storage/products/' . $p->product->image) }}" alt="">
                            </div>
                            <div class="flex flex-col justify-between w-full p-4 leading-normal tracking-tight">
                                <h6 class="text-xs md:text-sm font-bold tracking-tigh line-clamp-1">
                                    Rp {{ number_format($p->product->price, 0, ',', '.') }}
                                </h6>
                                <h6 class="text-xs md:text-sm font-bold mb-2 tracking-tight">
                                    {{ $p->product->name }}
                                </h6>
                                <div class="subtotal flex justify-between text-xs">
                                    <p>
                                        Qty {{ $p->qty }} x
                                        {{ number_format($p->product->price, 0, ',', '.') }}
                                    </p>
                                    <p>
                                        Rp {{ number_format($p->subtotal, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="transaction_form" class="transaction_form">
                <div
                    class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-5 text-2xl font-bold tracking-tight text-sky-800 text-center">
                        Transaction Form
                    </h5>

                    <form class="mt-5">
                        <div class="mb-6">
                            <label for="fee_shipping"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Fee Shipping
                            </label>
                            <input type="number" id="fee_shipping" wire:model="fee_shipping"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="-" readonly />
                        </div>
                        <div class="mb-6">
                            <label for="subtotal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Subsubtotal
                            </label>
                            <input type="number" id="subtotal" wire:model="subtotal"
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
                        </div>
                    </form>
                </div>
                @if (session()->has('error'))
                    <div id="alert-2"
                        class="flex items-center p-4 my-2 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @elseif (session()->has('success'))
                    <div id="alert-3"
                        class="flex items-center p-4 my-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                <div
                    class="p-6 mt-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-5 text-2xl font-bold tracking-tight text-sky-800 text-center">
                        Transaction Detail
                    </h5>

                    <table class="table-fixed w-full mb-5">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-right py-1.5">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Fee Shipping</td>
                            <td class="text-right py-1.5">
                                Rp {{ number_format($fee_shipping, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="font-bold text-xl">
                            <td>Total</td>
                            <td class="text-right py-1.5 mt-2">
                                Rp {{ number_format($fee_shipping + $subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    </table>

                    <button type="submit" wire:click.prevent="checkout"
                        class="text-white bg-sky-500 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                        Checkout
                    </button>
                </div>
            </section>
        </div>
    </main>
</div>
