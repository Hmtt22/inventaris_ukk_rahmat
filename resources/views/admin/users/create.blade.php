@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Create User</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label>Name</label>
            <input type="text" name="name" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Role</label>
            <select name="role" class="w-full border p-2 rounded">
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
            </select>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>

        <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

@endsection