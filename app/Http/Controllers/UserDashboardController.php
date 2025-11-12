<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Route as BusRoute;
use App\Models\Schedule;

class UserDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard user berisi:
     * - Riwayat Pemesanan
     * - Form & hasil pencarian tiket (dari include user.search)
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil semua booking milik user
        $bookings = Booking::with(['schedule.route', 'schedule.bus'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Untuk form pencarian kota
        $origins = BusRoute::select('origin')->distinct()->pluck('origin');
        $destinations = BusRoute::select('destination')->distinct()->pluck('destination');
        $availableCities = $origins->merge($destinations)->unique()->values();

        // Ambil hasil pencarian jika ada query dari user
        $from = $request->query('from');
        $to   = $request->query('to');
        $schedules = collect();

        if ($from && $to) {
            $route = BusRoute::where('origin', $from)
                ->where('destination', $to)
                ->first();

            if ($route) {
                $schedules = Schedule::with(['bus', 'route'])
                    ->where('route_id', $route->route_id)
                    ->where('status', '!=', 'dibatalkan')
                    ->get();
            }
        }

        return view('user.dashboard', compact('bookings', 'from', 'to', 'availableCities', 'schedules'));
    }
}
