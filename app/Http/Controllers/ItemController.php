<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // INDEX
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('admin.items.index', compact('items'));
    }

    // CREATE
    public function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
    }

    // STORE
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

    // EDIT
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('admin.items.edit', compact('item', 'categories'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'item_name' => 'required',
            'total_stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item->update($request->all());

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.items.index')
            ->with('success', 'Item berhasil dihapus');
    }
}