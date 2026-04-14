@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
            </select>
        </div>

        <button class="bg-yellow-500 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

@endsection