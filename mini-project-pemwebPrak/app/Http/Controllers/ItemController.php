<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Tampilkan semua barang milik user yang login
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::query()
            ->where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('items.index', compact('items', 'search'));
    }

    /**
     * Form tambah barang baru
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Simpan barang baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Item::create([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'condition' => $request->condition,
            'description' => $request->description,
            'user_id' => Auth::id(), // 👈 simpan ID user login
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Form edit barang
     */
    public function edit(Item $item)
    {
        // Cegah user lain akses data ini
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak!');
        }

        return view('items.edit', compact('item'));
    }

    /**
     * Update data barang
     */
    public function update(Request $request, Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak!');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'condition' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $item->update($request->only(['name', 'category', 'quantity', 'condition', 'description']));

        return redirect()->route('items.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Hapus barang
     */
    public function destroy(Item $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak!');
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}