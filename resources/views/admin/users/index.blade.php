@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Users</h1>
            <a href="{{ route('users.export') }}"
               class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 transition text-sm">
                Export Data
            </a>

            <a href="{{ route('users.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition text-sm">
                + Add User
            </a>
        </div>


    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $index => $user)
                <tr class="border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->role }}</td>

                    <td class="p-3 text-center space-x-2">

                        <a href="{{ route('users.edit', $user->id) }}"
                           class="bg-yellow-400 px-3 py-1 text-white rounded">
                            Edit
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('users.destroy', $user->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete user ini?')"
                                    class="bg-red-500 px-3 py-1 text-white rounded">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
