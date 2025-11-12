@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center">Cari Tiket Bus</h3>

    {{-- Form pencarian kota --}}
    <form action="{{ route('search.route') }}" method="GET" class="mb-4">
        <div class="row g-2 justify-content-center">
            <div class="col-md-4">
                <select name="from" class="form-select" required>
                    <option value="">Pilih Kota Asal</option>
                    @foreach($availableCities as $city)
                        <option value="{{ $city }}" {{ $from == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="to" class="form-select" required>
                    <option value="">Pilih Kota Tujuan</option>
                    @foreach($availableCities as $city)
                        <option value="{{ $city }}" {{ $to == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    {{-- Hasil pencarian --}}
    @if($schedules->isNotEmpty())
        <h5 class="mb-3">Hasil Pencarian dari <b>{{ $from }}</b> ke <b>{{ $to }}</b></h5>

        <div class="row">
            @foreach($schedules as $schedule)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</h5>
                            <p>Bus: <strong>{{ $schedule->bus->bus_name ?? '-' }}</strong></p>
                            <p>Waktu Berangkat: {{ $schedule->start_time }}</p>
                            <p>Pickup Point: {{ $schedule->route->pickup_point ?? '-' }}</p>
                            <p>Dropoff Point: {{ $schedule->route->dropoff_point ?? '-' }}</p>
                            <p class="text-success fw-bold">
                                Harga: Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </p>
                            <p class="text-muted">Tersisa: {{ $schedule->available_seats }} kursi</p>

                            @auth
                                {{-- Kalau sudah login bisa pesan --}}
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="schedule_id" value="{{ $schedule->schedule_id }}">
                                    <input type="number" name="seat_count" class="form-control mb-2" min="1" max="{{ $schedule->available_seats }}" placeholder="Jumlah kursi" required>
                                    <input type="hidden" name="payment_method" value="DANA">
                                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                                </form>
                            @else
                                {{-- Kalau belum login, tombol login --}}
                                <a href="{{ route('login') }}" class="btn btn-secondary w-100">Login untuk Memesan</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($from && $to)
        <p class="text-center mt-5">Tidak ada jadwal bus untuk rute ini.</p>
    @endif
</div>
@endsection
