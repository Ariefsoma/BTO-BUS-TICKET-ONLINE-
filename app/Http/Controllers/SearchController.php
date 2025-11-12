<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route as BusRoute;   // model Route (nama alias agar tidak bentrok)
use App\Models\Schedule;

class SearchController extends Controller
{
    /**
     * Mencari jadwal berdasarkan origin & destination.
     */
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to'   => 'required|string',
        ]);

        $from = $request->input('from');
        $to   = $request->input('to');

        // Cari rute yang cocok (case-insensitive, partial match)
        $routes = BusRoute::where('origin', 'like', '%' . $from . '%')
                    ->where('destination', 'like', '%' . $to . '%')
                    ->pluck('route_id'); // ambil id rute yang cocok

        // Ambil schedules yang terhubung ke rute-rute tersebut
        $schedules = Schedule::with(['bus','route'])
            ->whereIn('route_id', $routes)
            ->where('status', 'aktif')
            ->where('available_seats', '>', 0)
            ->orderBy('departure_time')
            ->get();

        return view('user.search', [
            'from' => $from,
            'to' => $to,
            'schedules' => $schedules,
        ]);
    }
}
