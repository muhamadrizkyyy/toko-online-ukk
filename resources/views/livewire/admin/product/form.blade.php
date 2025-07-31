<div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between  lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Form Product</h1>
            </div>
        </div>
    </div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="grid grid-cols-6 gap-6 w-full">
            <div class="col-span-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">
                    Upload Image Product
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" wire:model="image" type="file">
                @error('image')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Name
                </label>
                <input type="text" name="name" id="name" wire:model='name'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Jacket">
                @error('name')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Slug
                </label>
                <input type="text" name="slug" id="slug" wire:model='slug' readonly
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="-">
                @error('slug')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6">
                <form>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Category
                    </label>
                    <select id="category" wire:model='category_id'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a category</option>
                        @forelse ($this->getCategory() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                            <option value="-" selected>-</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                    @enderror
                </form>
            </div>
            <div class="col-span-6">
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Description
                </label>
                <input type="text" name="desc" id="desc" wire:model='desc'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Jacket dengan bahan berkualitas">
                @error('desc')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Price
                </label>
                <input type="number" price="price" id="price" wire:model='price'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="150000">
                @error('price')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    weight
                </label>
                <input type="number" name="weight" id="weight" wire:model='weight'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="1000 (gram)">
                @error('weight')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Stock
                </label>
                <input type="number" name="stock" id="stock" wire:model='stock'
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="12">
                @error('stock')
                    <span class="text-xs text-red-600 font-bold">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-6">
                <button type="button" wire:click='saveData'
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Save
                </button>
                <a href="{{ route('product') }}"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>
