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

    .sidebar a {
        display: block;
        color: white;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        margin-bottom: 8px;
        transition: 0.2s;
    }

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

    .btn-login {
        background: #0d6efd;
        color: white;
        border-radius: 6px;
        padding: 8px 16px;
        text-decoration: none;
        margin-left: 8px;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #0b5ed7;
        color: #fff;
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
</style>

<div class="sidebar">
    <h4>Bus Ticket Online</h4>
    {{-- 🔹 Beranda tidak kemana-mana --}}
    <a href="javascript:void(0);" class="active">🏠 Beranda</a>
    <a href="{{ route('login') }}">🔐 Masuk untuk Pesan</a>
</div>

<div class="content">
    

    {{-- ✅ FORM PENCARIAN --}}
    <form action="{{ route('search.route') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <select name="from" class="form-select" required>
                    <option value="">Pilih Kota Asal</option>
                    @foreach ($availableCities as $city)
                        <option value="{{ $city }}" {{ (isset($from) && $from == $city) ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select name="to" class="form-select" required>
                    <option value="">Pilih Kota Tujuan</option>
                    @foreach ($availableCities as $city)
                        <option value="{{ $city }}" {{ (isset($to) && $to == $city) ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    {{-- ✅ HASIL PENCARIAN --}}
    @if(isset($from) && isset($to))
        <h5 class="mt-4 mb-3">
            Hasil Pencarian: <strong>{{ $from }}</strong> → <strong>{{ $to }}</strong>
        </h5>

        @if($schedules->isEmpty())
            <div class="alert alert-warning">Tidak ada jadwal bus untuk rute ini.</div>
        @else
            <div class="row">
                @foreach ($schedules as $schedule)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $schedule->bus->bus_name }}</h5>
                                <p class="card-text">
                                    <strong>Rute:</strong> {{ $schedule->route->origin }} → {{ $schedule->route->destination }}<br>
                                    <strong>Pickup:</strong> {{ $schedule->route->pickup_point }}<br>
                                    <strong>Dropoff:</strong> {{ $schedule->route->dropoff_point }}<br>
                                    <strong>Waktu:</strong> {{ $schedule->start_time }}<br>
                                    <strong>Harga:</strong> Rp {{ number_format($schedule->price, 0, ',', '.') }}<br>
                                    <strong>Sisa Kursi:</strong> {{ $schedule->available_seats }}
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-success w-100">Pesan</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
