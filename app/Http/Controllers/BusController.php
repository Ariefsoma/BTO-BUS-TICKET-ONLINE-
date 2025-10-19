<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('admin.dashboard', compact('buses'));
    }

    public function create()
    {
        return view('admin.add-bus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'bus_type' => 'nullable|string|max:255',
            'seat_count' => 'required|integer|min:1',
            'price_per_seat' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Bus::create($request->only([
            'bus_name', 'bus_type', 'seat_count', 'price_per_seat', 'status'
        ]));

        return redirect()->route('admin.bus.index')->with('success', 'Bus baru berhasil ditambahkan!');
    }
}
