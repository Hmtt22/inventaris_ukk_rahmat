@extends('layouts.app')

@section("content")

<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus kategori ini?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
        Delete
    </button>
</form>

@endsection