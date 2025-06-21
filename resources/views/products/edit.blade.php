
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Edit') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required min="0" class="mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Product</button>
        </form>
    </div>
    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
            Back to Product List
        </a>
    </div>
</x-app-layout>
