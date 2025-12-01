<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * LIST USER (owner lihat semua admin_kasir)
     */
    public function index()
    {
        $users = User::where('role', 'admin_kasir')->get();

        return view('owner.users.index', compact('users'));
    }

    /**
     * FORM TAMBAH USER
     */
    public function create()
    {
        return view('owner.users.create');
    }

    /**
     * SIMPAN USER BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin_kasir',
        ]);

        return redirect()->route('owner.users.index')
            ->with('success', 'User admin kasir berhasil dibuat.');
    }

    /**
     * FORM EDIT USER
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('owner.users.edit', compact('user'));
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6', // opsional
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * HAPUS USER
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
