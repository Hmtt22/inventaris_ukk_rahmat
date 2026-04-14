@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Items Data Table</h1>

        <div class="flex gap-2">
            <a href="{{ route('admin.items.export') }}"
               class="bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700 transition flex items-center gap-2">
               <i class="fas fa-file-excel"></i> Export Excel
            </a>

            <a href="{{ route('admin.items.create') }}"
               class="bg-emerald-500 text-white px-4 py-2 rounded shadow hover:bg-emerald-600 transition flex items-center gap-2">
               <i class="fas fa-plus"></i> Add Item
            </a>
        </div>
    </div>

    <div class="bg-white shadow rounded overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 font-semibold text-gray-600 text-center w-16">No</th>
                    <th class="p-4 font-semibold text-gray-600">Category</th>
                    <th class="p-4 font-semibold text-gray-600">Name</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Total</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Repair</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $index => $item)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4 text-center text-gray-500">{{ $index + 1 }}</td>
                    <td class="p-4 font-medium text-gray-700">{{ $item->category->name }}</td>
                    <td class="p-4 text-gray-600">{{ $item->item_name }}</td>
                    <td class="p-4 text-center text-gray-600">{{ $item->total_stock }}</td>
                    <td class="p-4 text-center text-gray-600">{{ $item->total_repaired }}</td>

                    <td class="p-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.items.edit', $item->id) }}"
                               class="bg-purple-600 hover:bg-purple-700 px-4 py-2 text-white rounded shadow-sm transition min-w-[80px]">
                               Edit
                            </a>

                            <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete item?')"
                                        class="bg-red-500 hover:bg-red-600 px-4 py-2 text-white rounded shadow-sm transition min-w-[80px]">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
