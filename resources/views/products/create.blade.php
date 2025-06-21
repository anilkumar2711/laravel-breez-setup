
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Create') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                <input type="number" id="quantity" name="quantity" required min="0" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create Product</button>
        </form>
    </div>
</x-app-layout>
