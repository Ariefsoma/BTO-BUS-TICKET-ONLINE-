<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // Autentikasi user
        $request->authenticate();

        // Regenerasi session
        $request->session()->regenerate();

        // Hapus redirect "intended" lama agar tidak kembali ke /dashboard
        $request->session()->forget('url.intended');

        // 🔍 Redirect berdasarkan role user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Default (untuk user biasa)
        return redirect()->route('user.dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman utama setelah logout
        return redirect('/');
    }
}
