@extends('layouts.app')

@section("content")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}"
          method="POST"
          class="bg-white p-6 rounded shadow">

        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name"
                   value="{{ $category->name }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Division</label>
            <select name="division"
                class="w-full border rounded px-3 py-2">
            <option value="">Select Division PJ</option>
            <option value="Sarpras">Sarpras</option>
            <option value="Tata Usaha">Tata Usaha</option>
            <option value="Tefa">Tefa</option>
        </select>
        </div>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="{{ route('admin.categories.index') }}"
           class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

</body>
</html>

@endsection