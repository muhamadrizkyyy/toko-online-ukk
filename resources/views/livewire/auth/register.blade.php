<div>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto pt:mt-0 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Create an Account
            </h2>
            <form class="mt-8 grid gap-5" wire:submit.prevent='register'>
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
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" id="email" wire:model='email'
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@company.com">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" wire:model='password'
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="confirm-password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
                        wire:model='confirm_pass'
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Province
                    </label>
                    <select id="province" wire:model='province_id' onchange="selectchange(this)"
                        class="bg-gray-50 border selectpicker border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected wire:ignore>Choose a province</option>
                        @forelse ($this->getProvince() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('province_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="regency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Regency
                    </label>
                    <select id="regency" wire:model='regency_id' {{ $province_id ? '' : 'disabled' }}
                        class="bg-gray-50 border selectpicker border-gray-300 disabled:bg-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected wire:ignore>Choose a regency</option>
                        @forelse ($this->getRegencyByProvince() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('regency_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        District
                    </label>
                    <select id="district" wire:model='district_id' {{ $regency_id ? '' : 'disabled' }}
                        class="bg-gray-50 border selectpicker border-gray-300 disabled:bg-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected wire:ignore>Choose a district</option>
                        @forelse ($this->getDistrictByRegency() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('district_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="village" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Village
                    </label>
                    <select id="village" wire:model='village_id' {{ $district_id ? '' : 'disabled' }}
                        class="bg-gray-50 border selectpicker border-gray-300 disabled:bg-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected wire:ignore>Choose a village</option>
                        @forelse ($this->getVillageByDistrict() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('village_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
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
                    <label for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                    <input type="number" name="phone" id="phone" wire:model='phone'
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="08819xxxx">
                    @error('phone')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-6">
                    <button type="submit"
                        class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create account
                    </button>
                    <div class="text-sm font-medium mt-3 text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-blue-700 hover:underline dark:text-blue-500">Login here</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.selectpicker').select2();

            $('#province').on('change', function(e) {
                var data = $('#province').select2("val");
                @this.set('province_id', data);
            });
            $('#regency').on('change', function(e) {
                var data = $('#regency').select2("val");
                @this.set('regency_id', data);
            });
            $('#district').on('change', function(e) {
                var data = $('#district').select2("val");
                @this.set('district_id', data);
            });
            $('#village').on('change', function(e) {
                var data = $('#village').select2("val");
                @this.set('village_id', data);
            });

            $(document).on("livewire:update", function() {
                $('.selectpicker').select2();
            })
        });
    </script>
@endsection
