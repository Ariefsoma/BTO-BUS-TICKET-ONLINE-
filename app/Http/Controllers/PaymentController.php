<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function create($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('user.payment', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'payment_method' => 'required|string|max:50',
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'amount' => 'required|numeric|min:1000'
        ]);

        // Upload bukti pembayaran ke folder public/storage/bukti_transfer
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        // Simpan ke tabel payments
        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'payment_method' => $request->payment_method,
            'bukti_transfer' => $path,
            'amount' => $request->amount,
            'payment_date' => now(),
            'status' => 'dibayar', // langsung dianggap sudah dibayar
        ]);

        // Update status booking juga ke "dibayar"
        Booking::where('booking_id', $request->booking_id)
            ->update(['status' => 'dibayar']);

        return redirect()->route('user.dashboard')->with('success', 'Pembayaran berhasil dikirim dan status telah diperbarui menjadi dibayar.');
    }
}
