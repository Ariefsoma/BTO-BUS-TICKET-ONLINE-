<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 🧭 Dashboard umum (user biasa)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 👤 Profile user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔍 Pencarian rute (umum)
Route::get('/search-route', function (Request $request) {
    if (!Auth::check()) {
        session([
            'pending_from' => $request->from,
            'pending_to' => $request->to,
        ]);
        return redirect()->route('login');
    }

    return redirect()->route('user.search', [
        'from' => $request->from,
        'to' => $request->to,
    ]);
})->name('search.route');

// 🔎 Halaman hasil pencarian user
Route::middleware(['auth'])->get('/user/search', function (Request $request) {
    return view('user.search', [
        'from' => $request->from,
        'to' => $request->to,
    ]);
})->name('user.search');

// 🚏 Detail rute tertentu
Route::get('/rute/{id}', function ($id) {
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
    }

    $routes = [
        1 => ['from' => 'Jakarta', 'to' => 'Bandung', 'time' => '07:30 WIB', 'price' => 120000],
        2 => ['from' => 'Surabaya', 'to' => 'Malang', 'time' => '08:00 WIB', 'price' => 90000],
        3 => ['from' => 'Yogyakarta', 'to' => 'Semarang', 'time' => '09:00 WIB', 'price' => 100000],
        4 => ['from' => 'Denpasar', 'to' => 'Ubud', 'time' => '10:00 WIB', 'price' => 75000],
    ];

    $route = $routes[$id] ?? null;
    if (!$route) abort(404);

    return view('route-info', compact('route'));
})->name('route.info');

// 🧑‍💼 Grup untuk Admin
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // 🚌 Manajemen Bus
    Route::get('/admin/bus', [BusController::class, 'index'])->name('admin.bus.index');
    Route::get('/admin/bus/create', [BusController::class, 'create'])->name('admin.bus.create');
    Route::post('/admin/bus/store', [BusController::class, 'store'])->name('admin.bus.store');

    // 🚍 Manajemen Rute
    Route::get('/admin/routes', [RouteController::class, 'index'])->name('admin.routes.index');
    Route::get('/admin/routes/create', [RouteController::class, 'create'])->name('admin.routes.create');
    Route::post('/admin/routes', [RouteController::class, 'store'])->name('admin.routes.store');
});

require __DIR__.'/auth.php';
