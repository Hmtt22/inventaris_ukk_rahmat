@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-6">

    <div class="bg-white p-6 rounded shadow text-center">

        <h1 class="text-xl font-bold mb-4 text-red-500">
            Delete User
        </h1>

        <p class="mb-6">
            Are you sure want to delete <b>{{ $user->name }}</b>?
        </p>

        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="bg-red-500 text-white px-4 py-2 rounded">
                Yes, Delete
            </button>

            <a href="{{ route('users.index') }}"
               class="ml-2 text-gray-600">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection