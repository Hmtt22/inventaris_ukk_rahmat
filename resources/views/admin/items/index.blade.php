@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Items</h1>

        <a href="{{ route('admin.items.create') }}"
           class="bg-green-500 text-white px-5 py-3 rounded">
            + Add Item
        </a>
    </div>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">total</th>
                    <th class="p-3">Repair</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $index => $item)
                <tr class="border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $item->item_name }}</td>
                    <td class="p-3">{{ $item->category->name }}</td>
                    <td class="p-3">{{ $item->total_stock }}</td>
                    <td class="p-3">{{ $item->total_repaired }}</td>

                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('admin.items.edit', $item->id) }}"
                           class="bg-yellow-400 px-3 py-1 text-white rounded">
                            Edit
                        </a>

                        <form action="{{ route('admin.items.destroy', $item->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete item?')"
                                    class="bg-red-500 px-3 py-1 text-white rounded">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
