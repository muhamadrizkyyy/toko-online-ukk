<div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between  lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Form Users</h1>
            </div>
        </div>
    </div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-6 gap-6 w-full">
            <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Name
                </label>
                <input type="text" name="name" id="name" wire:model='name'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie">
                @error('name')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Username
                </label>
                <input type="text" name="username" id="username" wire:model='username'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie_01983">
                @error('username')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" wire:model='email'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="example@company.com">
                @error('email')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" wire:model='password'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="****">
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="confirm_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                    Password</label>
                <input type="password" name="confirm_pass" id="confirm_pass" wire:model='confirm_pass'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="****">
                @error('confirm_pass')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <form>
                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Province
                    </label>
                    <select id="province" wire:model='province_id'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a province</option>
                        @forelse ($this->getProvince() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('province_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </form>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <form>
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Regency
                    </label>
                    <select id="countries" wire:model='regency_id'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a regency</option>
                        @forelse ($this->getRegencyByProvince() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('regency_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </form>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="address"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="text" name="address" id="address" wire:model='address'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Jl. Subroto Gatot">
                @error('address')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="number" name="phone" id="phone" wire:model='phone'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="08819xxxx">
                @error('phone')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Role
                </label>
                <select id="role" wire:model='role_u'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a role</option>
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                    <option value="buyer">Buyer</option>
                </select>
                @error('role')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-6">
                <button type="button" wire:click='saveData'
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save
                </button>
                <a href="{{ route('users') }}"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>
