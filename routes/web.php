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
    // Jika belum login, redirect ke login dulu
    if (!Auth::check()) {
        // Simpan dulu input supaya bisa digunakan nanti
        session([
            'pending_from' => $request->from,
            'pending_to' => $request->to,
        ]);
        return redirect()->route('login');
    }

    // Jika sudah login, arahkan ke halaman pencarian tiket user
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
