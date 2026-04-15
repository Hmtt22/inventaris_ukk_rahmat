@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Lendings</h1>

        <a href="{{ route('lendings.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Add Lending
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white shadow rounded overflow-hidden">

        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Item</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Ket.</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Returned</th>
                    <th class="p-3">Edited By</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($lendings as $index => $lending)
                <tr class="border-b hover:bg-gray-50">

                    {{-- No --}}
                    <td class="p-3">{{ $index + 1 }}</td>

                    {{-- Item --}}
                    <td class="p-3">{{ $lending->item->item_name }}</td>

                    {{-- Name --}}
                    <td class="p-3">{{ $lending->name }}</td>

                    {{-- Total --}}
                    <td class="p-3">{{ $lending->total }}</td>

                    {{-- Description --}}
                    <td class="p-3">{{ $lending->description ?? '-' }}</td>

                    {{-- Tanggal Pinjam (pakai created_at) --}}
                    <td class="p-3">
                        {{ $lending->created_at->format('d-m-Y') }}
                    </td>

                    {{-- Returned At --}}
                    <td class="p-3">
                        {{ $lending->returned_at 
                            ? \Carbon\Carbon::parse($lending->returned_at)->format('d-m-Y') 
                            : 'Not Returned' }}
                    </td>

                    {{-- Edited By --}}
                    <td class="p-3">
                        {{ $lending->edited_by ?? '-' }}
                    </td>

                    {{-- ACTION --}}
                    <td class="p-3 text-center space-x-2">

                        {{-- RETURN --}}
                        @if(!$lending->is_returned)
                            <form action="{{ route('lendings.return', $lending->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                <button class="bg-green-500 px-3 py-1 text-white rounded hover:bg-green-600">
                                    Return
                                </button>
                            </form>
                        @endif

                        {{-- DELETE --}}
                        <form action="{{ route('lendings.destroy', $lending->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete lending?')"
                                    class="bg-red-500 px-3 py-1 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="p-4 text-center text-gray-500">
                        No lending data found
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>

@endsection