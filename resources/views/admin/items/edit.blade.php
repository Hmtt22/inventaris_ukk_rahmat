@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Item</h1>

    <form action="{{ route('admin.items.update', $item->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Item Name</label>
            <input type="text" name="item_name"
                   value="{{ $item->item_name }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Total Stock</label>
            <input type="number" name="total_stock"
                   value="{{ $item->total_stock }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Category</label>
            <select name="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>New Broke Item </label>
            <input type="number" name="total_repaired" class="w-full border p-2 rounded" >
        </div>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="{{ route('admin.items.index') }}" class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

@endsection