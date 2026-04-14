@extends('layouts.app')

@section("content")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Categories</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            + Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Division</th>
                    <th class="p-3 text-left">Total Items</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $index => $category)
                <tr class="border-b">

                    <!-- NO -->
                    <td class="p-3">
                        {{ $index + 1 }}
                    </td>

                    <td class="p-3">{{ $category->name }}</td>
                    <td class="p-3">{{ $category->division }}</td>
                    <td class="p-3">{{ $category->items_count }}</td>

                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                        class="bg-yellow-400 px-3 py-1 rounded text-white">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Hapus data?')"
                                    class="bg-red-500 px-3 py-1 rounded text-white">
                                Delete
                            </button>
                        </form>

                        <a href="{{ route('admin.categories.show', $category->id) }}"
                        class="bg-blue-500 px-3 py-1 rounded text-white">
                            View
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>

@endsection