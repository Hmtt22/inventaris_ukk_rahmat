@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <div class="bg-white p-6 rounded shadow text-center">

        <h1 class="text-xl font-bold text-red-500 mb-4">
            Delete Item
        </h1>

        <p class="mb-6">
            Are you sure want to delete <b>{{ $item->item_name }}</b>?
        </p>

        <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="bg-red-500 text-white px-4 py-2 rounded">
                Yes, Delete
            </button>

            <a href="{{ route('admin.items.index') }}"
               class="ml-2 text-gray-600">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection