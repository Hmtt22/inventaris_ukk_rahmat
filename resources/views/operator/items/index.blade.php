@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Items (Operator View)</h1>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $index => $item)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">
                        {{ $index + 1 }}
                    </td>

                    <td class="p-3">
                        {{ $item->category->name ?? '-' }}
                    </td>

                    <td class="p-3">
                        {{ $item->item_name }}
                    </td>

                    <td class="p-3">
                        {{ $item->total_stock }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection