@extends('layouts.app')

@section('content')
<h2 class="text-xl font-semibold mb-4">Stock Transactions</h2>
<table class="min-w-full bg-white border border-gray-200 shadow rounded">
    <thead>
        <tr class="bg-green-100 text-left text-gray-700">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Product</th>
            <th class="px-4 py-2">Type</th>
            <th class="px-4 py-2">Quantity</th>
            <th class="px-4 py-2">User</th>
            <th class="px-4 py-2">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $txn)
        <tr class="border-t border-gray-200">
            <td class="px-4 py-2">{{ $txn->id }}</td>
            <td class="px-4 py-2">{{ $txn->product->name }}</td>
            <td class="px-4 py-2">{{ ucfirst($txn->type) }}</td>
            <td class="px-4 py-2">{{ $txn->quantity }}</td>
            <td class="px-4 py-2">{{ $txn->user->name }}</td>
            <td class="px-4 py-2">{{ $txn->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
