
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product View') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Product Name: {{ $product->name }}</h3>
        </div>
        <div class="mb-4">
            <p class="text-gray-700 dark:text-gray-300">Description: {{ $product->description }}</p>
        </div>
        <div class="mb-4">
            <p class="text-gray-700 dark:text-gray-300">Quantity: {{ $product->quantity }}</p>
        </div>
    </div>
    
    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
            Back to Product List
        </a>
    </div>
</x-app-layout>
