<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('admin.routes.index', compact('routes'));
    }

    public function create()
    {
        return view('admin.routes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|numeric|min:0',
            'estimated_time' => 'required|string|max:255',
        ]);

        Route::create($request->all());

        return redirect()->route('admin.routes.index')->with('success', 'Rute baru berhasil ditambahkan!');
    }
}
