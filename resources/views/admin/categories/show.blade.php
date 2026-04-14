@extends('layouts.app')

@section("content")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Category Detail</h1>

        <a href="{{ route('admin.categories.index') }}"
           class="text-gray-600 hover:text-black">
            ← Back
        </a>
    </div>

    <div class="bg-white p-6 rounded shadow space-y-4">

        <div>
            <p class="text-gray-500">Name</p>
            <p class="text-lg font-semibold">{{ $category->name }}</p>
        </div>

        <div>
            <p class="text-gray-500">Division</p>
            <p class="text-lg font-semibold">{{ $category->division }}</p>
        </div>

        <div>
            <p class="text-gray-500">Total Items</p>
            <p class="text-lg font-semibold">{{ $category->items_count ?? 0 }}</p>
        </div>

        <div class="flex gap-3 pt-4">

            <a href="{{ route('admin.categories.edit', $category->id) }}"
               class="bg-yellow-400 text-white px-4 py-2 rounded">
                Edit
            </a>

            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button onclick="return confirm('Yakin mau hapus category ini?')"
                        class="bg-red-500 text-white px-4 py-2 rounded">
                    Delete
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>

@endsection