<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =====================
    // INDEX (FILTER ROLE)
    // =====================
    public function index(Request $request)
    {
        $role = $request->query('role');

        $users = User::query();

        if ($role) {
            $users->where('role', $role);
        }

        $users = $users->latest()->get();

        return view('admin.users.index', compact('users', 'role'));
    }

    // =====================
    // CREATE FORM
    // =====================
    public function create()
    {
        return view('admin.users.create');
    }

    // =====================
    // STORE DATA
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,operator',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index',)
            ->with('success', 'User berhasil ditambahkan');
    }

    // =====================
    // EDIT FORM
    // =====================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // =====================
    // UPDATE DATA
    // =====================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,operator',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // password optional (kalau diisi baru diupdate)
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    // =====================
    // DELETE
    // =====================
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }

}