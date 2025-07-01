<div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between  lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Form Category</h1>
            </div>
        </div>
    </div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-6 gap-6 w-full">
            <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Transaction Code
                </label>
                <input type="text" name="name" id="name" wire:model='code'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie">
                @error('name')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="buyer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Buyer
                </label>
                <input type="text" buyer="buyer" id="buyer" wire:model='buyer'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie">
                @error('buyer')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="fee_shiping" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Fee Shipping
                </label>
                <input type="text" fee_shiping="fee_shiping" id="fee_shiping" wire:model='fee_shiping'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie">
                @error('fee_shiping')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="trans_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Transaction Date
                </label>
                <input type="text" name="trans_date" id="trans_date" wire:model='trans_date' readonly
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="-">
                @error('trans_date')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="trans_send" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Transaction Sending
                </label>
                <input type="text" name="trans_send" id="trans_send" wire:model='trans_send' readonly
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="-">
                @error('trans_send')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>

            @if ($data_trans->status == 'pending cancelled')
                <div class="col-span-6 sm:col-span-3">
                    <label for="trans_pending_cancelled"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Transaction Pending Cancelled
                    </label>
                    <input type="text" name="trans_pending_cancelled" id="trans_pending_cancelled"
                        wire:model='trans_pending_cancelled' readonly
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="-">
                    @error('trans_pending_cancelled')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="trans_cancelled" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Transaction Cancelled
                    </label>
                    <input type="text" name="trans_cancelled" id="trans_cancelled" wire:model='trans_cancelled'
                        readonly
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="-">
                    @error('trans_cancelled')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <div class="col-span-6 sm:col-span-3">
                    <label for="trans_completed" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Transaction Completed
                    </label>
                    <input type="text" name="trans_completed" id="trans_completed" wire:model='trans_completed'
                        readonly
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="-">
                    @error('trans_completed')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
            @endif
            <div class="col-span-3">
                <span class="font-bold mb-3">Product Detail</span>
                @foreach ($detail_trans as $item)
                    <div class="card flex  justify-between">
                        <p>
                            {{ $item->product->name }}
                        </p>
                        <p>
                            {{ $item->qty }} x Rp {{ $item->product->price }}
                        </p>
                        <p>
                            {{ $item->subtotal }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="col-span-3">
                <span class="font-bold mb-3">Payment Information</span>
                @if ($payments->proof)
                    <img src="{{ asset('storage/proof/' . $payments->proof) }}" alt="">
                @else
                    <p>
                        Unpaid Transaction
                    </p>
                @endif
            </div>
            <div class="col-span-6">
                <a href="{{ route('transaction') }}"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>
