<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Bus;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,schedule_id',
            'seat_count' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);
        $bus = $schedule->bus;

        // Hitung total harga
        $totalPrice = $bus->price_per_seat * $request->seat_count;

        // Cek ketersediaan kursi
        if ($bus->seat_count < $request->seat_count) {
            return back()->with('error', 'Kursi tidak cukup!');
        }

        // Simpan bukti pembayaran jika ada
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Simpan booking
        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->schedule_id,
            'seat_count' => $request->seat_count,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_proof' => $proofPath,
            'status' => 'Pending',
        ]);

        // Kurangi kursi tersedia
        $bus->seat_count -= $request->seat_count;
        $bus->save();

        return redirect()->route('user.history')->with('success', 'Pemesanan berhasil!');
    }
}
