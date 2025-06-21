
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product List') }}
        </h2>
    </x-slot>
    <div>
        <a href="{{ route('products.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Add New Product
        </a>
    </div>
    <table class="min-w-full bg-white border border-gray-200 shadow rounded">
        <thead>
            <tr class="bg-blue-100 text-left text-gray-700">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-t border-gray-200">
                <td class="px-4 py-2">{{ $product->id }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->description }}</td>
                <td class="px-4 py-2">{{ $product->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
