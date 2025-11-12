<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;

class BusController extends Controller
{
    public function index()
    {
        $availableCities = Route::select('origin')
            ->distinct()
            ->pluck('origin')
            ->merge(Route::select('destination')->distinct()->pluck('destination'))
            ->unique()
            ->sort()
            ->values();

        return view('welcome', compact('availableCities'));
    }

    // 🔍 Form pencarian bus (tampilan awal)
    public function searchForm()
    {
        return view('user.search');
    }

    // 🔍 Hasil pencarian bus
    public function searchResults(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to'   => 'required',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $buses = Bus::with('route')
            ->whereHas('route', function ($q) use ($from, $to) {
                $q->where('origin', $from)
                  ->where('destination', $to);
            })
            ->get();

        return view('user.search-results', compact('buses', 'from', 'to'));
    }

    // 🚌 Detail satu bus
    public function show($id)
    {
        $bus = Bus::with('route')->findOrFail($id);
        return view('user.bus-detail', compact('bus'));
    }
}
