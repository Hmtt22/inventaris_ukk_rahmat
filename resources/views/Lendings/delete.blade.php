<td>

    {{-- ================= RETURN ================= --}}
    @if(!$lending->is_returned)
        <form action="{{ route('lendings.return', $lending->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:green;color:white;">
                Return
            </button>
        </form>
    @else
        <span style="color:green;">Returned</span>
    @endif

    {{-- ================= DELETE ================= --}}
    <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
            onclick="return confirm('Yakin ingin menghapus data ini?')"
            style="background:red;color:white;">
            Delete
        </button>
    </form>

</td>