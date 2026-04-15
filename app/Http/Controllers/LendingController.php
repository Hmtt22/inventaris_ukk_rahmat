<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LendingController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        $lendings = Lending::with('item')
            ->latest()
            ->get();

        return view('lendings.index', compact('lendings'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $items = Item::all();
        return view('lendings.create', compact('items'));
    }

    /**
     * STORE (PINJAM BARANG)
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'name' => 'required|string|max:255',
            'total' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($request) {

            $item = Item::lockForUpdate()->findOrFail($request->item_id);

            // cek stok
            if ($item->total_stock < $request->total) {
                return back()->with('error', 'Stok tidak mencukupi');
            }

            // update stok
            $item->total_stock -= $request->total;
            $item->total_borrowed += $request->total;
            $item->save();

            // simpan lending
            Lending::create([
                'item_id' => $item->id,
                'name' => $request->name,
                'total' => $request->total,
                'description' => $request->description,
                'edited_by' => auth()->user()->name ?? 'system',
                'is_returned' => false,
            ]);

            return redirect()->route('lendings.index')
                ->with('success', 'Barang berhasil dipinjam');
        });
    }

    /**
     * RETURN (KEMBALIKAN BARANG)
     */
    public function return($id)
    {
        return DB::transaction(function () use ($id) {

            $lending = Lending::lockForUpdate()->findOrFail($id);

            if ($lending->is_returned) {
                return back()->with('error', 'Barang sudah dikembalikan');
            }

            $item = Item::lockForUpdate()->findOrFail($lending->item_id);

            // kembalikan stok
            $item->total_stock += $lending->total;
            $item->total_borrowed -= $lending->total;
            $item->save();

            // update status lending
            $lending->update([
                'is_returned' => true,
                'returned_at' => now(),
            ]);

            return back()->with('success', 'Barang berhasil dikembalikan');
        });
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $lending = Lending::findOrFail($id);

        // kalau belum dikembalikan, balikin stok dulu
        if (!$lending->is_returned) {
            $item = Item::findOrFail($lending->item_id);

            $item->total_stock += $lending->total;
            $item->total_borrowed -= $lending->total;
            $item->save();
        }

        $lending->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}