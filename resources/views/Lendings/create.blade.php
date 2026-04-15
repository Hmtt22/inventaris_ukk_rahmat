@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6">Create Lending (Pinjam Barang)</h1>

    {{-- ERROR VALIDATION --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('lendings.store') }}" method="POST"
          class="bg-white p-6 rounded shadow">

        @csrf

        {{-- NAME --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name"
                   class="w-full border p-2 rounded"
                   required>
        </div>

        {{-- ITEM --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Item</label>
            <select name="item_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Item --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->item_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TOTAL --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Total</label>
            <input type="number" name="total"
                   class="w-full border p-2 rounded"
                   required>
        </div>

         {{-- DESCRIPTION --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Ket.</label>
            <textarea name="description"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        {{-- BUTTON --}}
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save
        </button>

        <a href="{{ route('lendings.index') }}"
           class="ml-2 text-gray-600">
            Cancel
        </a>

    </form>

</div>

@endsection