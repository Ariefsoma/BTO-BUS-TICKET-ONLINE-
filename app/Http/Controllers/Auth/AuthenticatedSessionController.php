<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
     

    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // 🔹 Cek apakah user sebelumnya isi form pencarian tapi belum login
    if (session()->has('pending_from') && session()->has('pending_to')) {
        $from = session('pending_from');
        $to = session('pending_to');

        // Hapus data session supaya gak nyangkut
        session()->forget(['pending_from', 'pending_to']);

        // Arahkan langsung ke halaman hasil pencarian
        return redirect()->route('user.search', [
            'from' => $from,
            'to' => $to,
        ]);
    }

    // 🔹 Kalau login biasa (tanpa pencarian sebelumnya), arahkan ke dashboard
    return redirect()->intended(route('dashboard', absolute: false));
}



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
