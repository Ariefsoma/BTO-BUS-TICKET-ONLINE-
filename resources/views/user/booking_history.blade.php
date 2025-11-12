@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f8f9fa;
    }

    .sidebar {
        width: 250px;
        background: #0d6efd;
        color: white;
        position: fixed;
        height: 100vh;
        padding: 20px;
        top: 0;
        left: 0;
    }

    .sidebar h4 {
        font-weight: 600;
        margin-bottom: 20px;
        color: #fff;
    }

    .sidebar button, 
    .sidebar a {
        display: block;
        color: white;
        background: transparent;
        border: none;
        text-align: left;
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: 0.2s;
    }

    .sidebar button:hover,
    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .content {
        margin-left: 270px;
        padding: 40px 30px 30px 30px;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-top h2 {
        font-weight: 700;
        color: #212529;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-3px);
    }

    .badge {
        font-size: 0.85rem;
    }
</style>

<div class="sidebar">
    <h4>Dashboard Pengguna</h4>
    <a href="{{ url('/user/dashboard') }}">🏠 Beranda</a>
    <button class="active">🧾 Riwayat Pemesanan</button>

    <hr>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        🚪 Keluar
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<div class="content">
    <div class="header-top">
        <h2>Riwayat Pemesanan</h2>
    </div>

    @if ($bookings->isEmpty())
        <div class="alert alert-info">Belum ada riwayat pemesanan.</div>
    @else
        <div class="row">
            @foreach ($bookings as $booking)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->schedule->bus->bus_name ?? '-' }}</h5>
                            <p class="card-text">
                                <strong>Rute:</strong> {{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}<br>
                                <strong>Waktu:</strong> {{ $booking->schedule->start_time ?? '-' }}<br>
                                <strong>Kursi:</strong> {{ $booking->seat_count }}<br>
                                <strong>Total:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}<br>
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $booking->status == 'selesai' ? 'success' : ($booking->status == 'proses' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
