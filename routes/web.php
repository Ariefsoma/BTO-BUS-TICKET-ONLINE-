<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserDashboardController;

use App\Models\Route as BusRoute;
use App\Models\Schedule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========================
// 🏠 HALAMAN UTAMA (WELCOME)
// ========================
Route::get('/', function () {
    $origins = BusRoute::select('origin')->distinct()->pluck('origin');
    $destinations = BusRoute::select('destination')->distinct()->pluck('destination');
    $availableCities = $origins->merge($destinations)->unique()->values();

    return view('welcome', compact('availableCities'));
})->name('home');


// ========================
// 🔍 PENCARIAN DARI HALAMAN UTAMA
// ========================
// - Jika belum login → tampilkan guest dashboard (/dashboard)
// - Jika sudah login → arahkan ke /user/dashboard
Route::get('/search-route', function (Request $request) {
    $from = $request->from;
    $to = $request->to;

    // simpan di session agar tetap terbaca setelah login
    session([
        'pending_from' => $from,
        'pending_to'   => $to,
    ]);

    if (Auth::check()) {
        // kalau sudah login → ke user dashboard
        return redirect()->route('user.dashboard');
    }

    // kalau belum login → ke dashboard tamu
    return redirect()->route('dashboard');
})->name('search.route');


// ========================
// 👁️ DASHBOARD UNTUK TAMU (BELUM LOGIN)
// ========================
Route::get('/dashboard', function () {
    $from = session('pending_from');
    $to   = session('pending_to');

    $origins = BusRoute::select('origin')->distinct()->pluck('origin');
    $destinations = BusRoute::select('destination')->distinct()->pluck('destination');
    $availableCities = $origins->merge($destinations)->unique()->values();

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

    return view('dashboard', compact('from', 'to', 'availableCities', 'schedules'));
})->name('dashboard');


// ========================
// 👤 DASHBOARD USER (SETELAH LOGIN)
// ========================
Route::middleware(['auth'])->group(function () {
    // Dashboard utama user
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // Simpan booking (user login wajib)
    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');
});


// ========================
// 🔍 USER SEARCH (SETELAH LOGIN)
// ========================
// Digunakan untuk redirect setelah login (mengambil data from/to dari session)
Route::get('/user/search', function (Request $request) {
    $from = $request->query('from') ?? session('pending_from');
    $to   = $request->query('to') ?? session('pending_to');

    session([
        'pending_from' => $from,
        'pending_to'   => $to,
    ]);

    return redirect()->route('user.dashboard');
})->name('user.search');


// ========================
// ⚙️ PROFILE (Bawaan Laravel Breeze)
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ========================
// 🔐 AUTH ROUTES (BREEZE / FORTIFY)
// ========================
require __DIR__ . '/auth.php';
