
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
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-t border-gray-200">
                <td class="px-4 py-2">{{ $product->id }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->description }}</td>
                <td class="px-4 py-2">{{ $product->quantity }}</td>
                <td class="px-4 py-2">
                    <!-- Create vertical dots icon as drop down where it has edit , delete, show -->
                    <div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="options-menu" aria-haspopup="true" aria-expanded="true">
                                Actions
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                                <a href="{{ route('products.edit', $product->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" role="none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem">Delete</button>
                                </form>
                                <a href="{{ route('products.show', $product->id) }}" class="block px-4 py-2 text-sm text-green-600 hover:bg-gray-100" role="menuitem">View</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButtons = document.querySelectorAll('[id="options-menu"]');
        dropdownButtons.forEach(button => {
            button.addEventListener('click', function() {
                const menu = this.parentElement.nextElementSibling;
                menu.classList.toggle('hidden');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('.origin-top-right').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
    });

    </script>
</x-app-layout>
