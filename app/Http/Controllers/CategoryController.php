<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // LIST DATA
    public function index()
    {
        $categories = Category::withCount('items')->get();

        return view('admin.categories.index', compact('categories'));
    }

    // FORM CREATE
    public function create()
    {
        return view('admin.categories.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'division' => $request->division,
            'total_items' => 0,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'division' => 'required',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'division' => $request->division,
            'total_items' => 0,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil diupdate');
    }

    // DELETE
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category berhasil dihapus');
    }

    public function show($id)
    {
        $category = Category::withCount('items')->findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }

}
