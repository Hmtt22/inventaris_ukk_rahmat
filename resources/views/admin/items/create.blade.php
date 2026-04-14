@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Create Item</h1>

    <form action="{{ route('admin.items.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label>Item Name</label>
            <input type="text" name="item_name" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Total Stock</label>
            <input type="number" name="total_stock" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Category</label>
            <select name="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>

        <a href="{{ route('admin.items.index') }}" class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

@endsection