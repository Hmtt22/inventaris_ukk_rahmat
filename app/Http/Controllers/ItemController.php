<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // INDEX - Menampilkan semua data barang
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('admin.items.index', compact('items'));
    }

    // CREATE - Menampilkan form tambah barang
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    // STORE - Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'total_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Item::create([
            'item_name' => $request->item_name,
            'total_stock' => $request->total_stock,
            'total_repaired' => 0,
            'total_borrowed' => 0,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil ditambahkan');
    }

    // EDIT - Menampilkan form edit barang
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('admin.items.edit', compact('item', 'categories'));
    }

    // UPDATE - Memperbarui data barang
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'item_name' => 'required',
            'total_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'total_repaired' => 'nullable|integer|min:0',
        ]);

        $item->item_name = $request->item_name;
        $item->total_stock = $request->total_stock;
        $item->category_id = $request->category_id;

        if ($request->filled('total_repaired')) {
            $item->total_repaired += $request->total_repaired;
        }

        $item->save();

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil diupdate');
    }

    // DELETE - Menghapus data barang
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil dihapus');
    }

    // EXPORT - Method yang tadi hilang
    public function export()
    {
        $items = Item::with('category')->get();

        $fileName = 'data_barang_' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nama Barang', 'Kategori', 'Stok Total', 'Dipinjam', 'Diperbaiki');

        $callback = function() use($items, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($items as $item) {
                fputcsv($file, array(
                    $item->item_name,
                    $item->category->name ?? 'Tanpa Kategori',
                    $item->total_stock,
                    $item->total_borrowed,
                    $item->total_repaired
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
