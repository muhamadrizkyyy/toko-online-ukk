<div>
    {{-- @dd($this->getPayment()->payment_logs) --}}
    <main class="p-4">
        <section id="list-product" class="max-w-4xl mx-auto">
            <div id="accordion-flush" data-accordion="collapse"
                data-active-classes="dark:bg-gray-900 text-gray-900 dark:text-white"
                data-inactive-classes="text-gray-500 dark:text-gray-400">
                <h2 id="accordion-flush-heading-1">
                    <button type="button"
                        class="flex items-center justify-between w-full py-3 font-medium rtl:text-right text-gray-500 border-b border-gray-600 dark:border-gray-700 dark:text-gray-400 gap-3"
                        data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                        aria-controls="accordion-flush-body-1">
                        <span>Product Detail</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                    <div class="block md:grid md:grid-cols-2 mt-3 gap-3">
                        @foreach ($this->getTransactionDetail() as $item)
                            <div
                                class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div
                                    class="bg-[url({{ asset('storage/products/' . $item->product->image) }})] w-full h-32 md:h-auto md:w-32 bg-cover bg-center aspect-square rounded-e-lg md:rounded-s-lg">
                                </div>
                                <div class="flex flex-col justify-between w-full p-4 leading-normal tracking-tight">
                                    <h6 class="text-xs md:text-sm font-bold tracking-tigh line-clamp-1">
                                        {{ $item->product->price }}
                                    </h6>
                                    <h6 class="text-xs md:text-sm font-bold mb-2 tracking-tight">
                                        {{ $item->product->name }}
                                    </h6>
                                    <div class="subtotal flex justify-between text-xs">
                                        <p>
                                            Qty {{ $item->qty }} x Rp
                                            {{ number_format($item->product->price, 0, ',', '.') }}
                                        </p>
                                        <p>
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section id="transaction_detail" class="mt-5">
            @if (session()->has('error'))
                <div id="alert-2"
                    class="flex items-center p-4 mb-2 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @elseif (session()->has('success'))
                <div id="alert-3"
                    class="flex items-center p-4 mb-2 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            <div
                class="p-6 grid {{ $data_trans->status == 'pending' ? 'md:grid-cols-2 gap-5' : '' }} bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="detail-content">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Transaction Detail
                    </h5>
                    <table class="table-fixed w-full">
                        <tbody>
                            <tr>
                                <td>Transaction Code</td>
                                <td class="text-right py-2 px-2.5">
                                    {{ $data_trans->transaction_code }}
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td class="text-right py-2 px-2.5">
                                    {{ $data_trans->transaction_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td class="text-right place-items-end py-2">
                                    @if ($data_trans->status == 'pending')
                                        <button type="button"
                                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                            {{ $data_trans->status }}
                                        </button>
                                    @elseif ($data_trans->status == 'pending cancelled')
                                        <button type="button"
                                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                            {{ $data_trans->status }}
                                        </button>
                                    @elseif ($data_trans->status == 'sending')
                                        <button type="button"
                                            class="text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                                            {{ $data_trans->status }}
                                        </button>
                                    @elseif ($data_trans->status == 'completed')
                                        <button type="button"
                                            class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                            {{ $data_trans->status }}
                                        </button>
                                    @else
                                        <button type="button"
                                            class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            {{ $data_trans->status }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($data_trans->status == 'pending')
                    <div class="detail-payment">
                        <div class="payment-method flex justify-between items-center">
                            <div class="payment-method-content">
                                <h5 class="font-bold tracking-tight text-black">
                                    Payment Method
                                </h5>
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">
                                    {{ strtoupper($this->getPayment()->methods->payment_name) }}
                                </h5>
                            </div>
                            <img src="..." alt="">
                        </div>

                        <div class="payment-content flex flex-col gap-4 text-center my-10">
                            <p>
                                Please make payment by transfer to
                                {{ $this->getPaymentLogs()['payment_type'] == 'gopay' ? 'QR Code' : 'Va Number' }}
                                below
                                :
                            </p>
                            <h3 class="text-3xl font-bold">
                                @if ($this->getPaymentLogs()['payment_type'] == 'gopay')
                                    <img class="w-1/3 mx-auto"
                                        src="{{ $this->getPaymentLogs()['actions'][0]['url'] }}" alt="">
                                @else
                                    {{ $this->getPaymentLogs()['va_numbers'][0]['va_number'] }}
                                @endif
                            </h3>
                            <p class="font-bold text-red-600">
                                <span>
                                    Make payment before
                                    {{ date_format(date_create($this->getPaymentLogs()['expiry_time']), '(d/m/Y H:i:s)') }}
                                </span>
                            </p>
                        </div>

                        <div class="total-paid flex justify-between items-center">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">
                                Total Paid
                            </h5>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">
                                Rp. {{ number_format($data_trans->total, 0, ',', '.') }}

                            </h5>
                        </div>
                    </div>
                @endif

            </div>

        </section>
        <div class="btn-group flex justify-end mt-4">

            @if ($data_trans->status == 'pending')
                <button type="button" wire:click='paymentStatusCheck("{{ $data_trans->transaction_code }}")'
                    class="text-white bg-blue-600 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Payment Status Check
                </button>
                <button type="button" onclick="statusChange({{ $data_trans->id }}, 'cancelled')"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Cancelled
                </button>
            @elseif ($data_trans->status == 'sending')
                <button type="button" onclick="statusChange({{ $data_trans->id }}, 'completed')"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Received
                </button>
            @endif
            <a href="{{ route('history') }}"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Back
            </a>
        </div>
    </main>
</div>

@section('script')
    <script>
        function statusChange(id, state) {
            Swal.fire({
                icon: "question",
                title: "Do you want to change this?",
                showCancelButton: true,
                confirmButtonText: "Change",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emit('changeStatus', id, state)
                }
            });
        }
    </script>
@endsection
