@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Booking</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>ID Booking:</strong> {{ $booking->booking_id }}</p>
            <p><strong>Bus:</strong> {{ $booking->schedule->bus->bus_name ?? 'Tidak ada data' }}</p>
            <p><strong>Rute:</strong> {{ $booking->schedule->route->origin ?? '' }} → {{ $booking->schedule->route->destination ?? '' }}</p>
            <p><strong>Jumlah Kursi:</strong> {{ $booking->seat_count }}</p>
            <p><strong>Total Harga:</strong> Rp{{ number_format($booking->total_price, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($booking->payment_method) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

            @if($booking->payment_proof)
                <p><strong>Bukti Pembayaran:</strong></p>
                <img src="{{ asset('storage/' . $booking->payment_proof) }}" alt="Bukti Pembayaran" width="250">
            @endif
        </div>
    </div>

    <a href="{{ route('bookings.history') }}" class="btn btn-secondary mt-3">Kembali ke Riwayat</a>
</div>
@endsection
