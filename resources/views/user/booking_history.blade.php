@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Riwayat Pemesanan</h3>

    @foreach($bookings as $booking)
        <div class="border rounded p-3 bg-white mb-3">
            <p><strong>Bus:</strong> {{ $booking->schedule->bus->bus_name }}</p>
            <p><strong>Rute:</strong> {{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</p>
            <p><strong>Tanggal:</strong> {{ $booking->schedule->departure_time }}</p>
            <p><strong>Jumlah Kursi:</strong> {{ $booking->seat_count }}</p>
            <p><strong>Total Bayar:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $booking->status == 'berhasil' ? 'success' : 'warning' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
        </div>
    @endforeach
</div>
@endsection
