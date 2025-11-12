<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentTriggerController extends Controller
{
    public function process(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        // Simpan bukti transfer
        $path = $request->file('proof')->store('bukti-transfer', 'public');

        $booking->update([
            'payment_method' => $request->payment_method,
            'proof_path' => $path,
            'status' => 'berhasil',
        ]);

        return redirect()->route('user.history')->with('success', 'Pembayaran berhasil! Tiketmu sudah dikonfirmasi.');
    }
}
