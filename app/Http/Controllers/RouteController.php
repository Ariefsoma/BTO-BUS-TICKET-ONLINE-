<?php

namespace App\Http\Controllers; // ⬅️ Ubah ini — hapus ".Admin"

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // Menampilkan semua rute
    public function index()
    {
        $routes = Route::all();
        return view('admin.routes.index', compact('routes'));
    }

    // Form tambah rute
    public function create()
    {
        return view('admin.routes.create');
    }

    // Proses simpan rute baru
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'distance' => 'required|numeric',
            'estimated_time' => 'required|string|max:50',
        ]);

        Route::create($request->all());

        return redirect()->route('admin.routes.index')
            ->with('success', 'Rute berhasil ditambahkan!');
    }
}
