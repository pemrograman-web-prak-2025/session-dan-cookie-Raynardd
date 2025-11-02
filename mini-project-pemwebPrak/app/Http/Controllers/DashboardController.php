<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard user login
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil total data barang milik user
        $totalItems = Item::where('user_id', $user->id)->count();

        return view('dashboard', compact('user', 'totalItems'));
    }
}