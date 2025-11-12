<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // === 1. Buat transaksi (dari tombol "Bayar Sekarang")
    public function createTransaction(Request $request)
    {
        $booking = Booking::findOrFail($request->booking_id);

        $params = [
            'transaction_details' => [
                'order_id' => 'BTO-' . $booking->booking_id . '-' . time(),
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

    // === 2. Callback otomatis dari Midtrans
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $bookingId = explode('-', $request->order_id)[1];
            $booking = Booking::find($bookingId);

            if ($booking) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $booking->status = 'selesai';
                } else {
                    $booking->status = 'dibatalkan';
                }
                $booking->save();
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
