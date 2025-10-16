<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 

Route::get('/search-route', function (Illuminate\Http\Request $request) {
 
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

Route::middleware(['auth'])->get('/user/search', function (Request $request) {
    return view('user.search', [
        'from' => $request->from,
        'to' => $request->to,
    ]);
})->name('user.search');


require __DIR__.'/auth.php';

  

Route::get('/', function () {
    return view('welcome');
})->name('home');
 
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

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
