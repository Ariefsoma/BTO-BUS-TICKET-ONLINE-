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
</style>

<div class="sidebar">
    <h4>Dashboard Pengguna</h4>
    <button id="btnHome">🏠 Beranda</button>
    <button id="btnHistory">🧾 Riwayat Pemesanan</button>

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
    {{-- ================= HOME SECTION ================= --}}
    <div id="homeSection">
        <div class="header-top">
            <h2>Cari Tiket Bus</h2>
        </div>

        {{-- 🔍 FORM PENCARIAN --}}
        <form action="{{ route('user.dashboard') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-5">
                    <input type="text" name="from" class="form-control" placeholder="Dari..." value="{{ request('from') }}">
                </div>
                <div class="col-md-5">
                    <input type="text" name="to" class="form-control" placeholder="Ke..." value="{{ request('to') }}">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        {{-- 🚌 HASIL BUS --}}
        <div class="row">
            @forelse ($schedules as $schedule)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $schedule->bus->bus_name ?? 'Bus Tidak Diketahui' }}</h5>
                            <p class="card-text">
                                <strong>Rute:</strong> {{ $schedule->route->origin }} → {{ $schedule->route->destination }}<br>
                                <strong>Pickup:</strong> {{ $schedule->bus->pickup_point ?? '-' }}<br>
                                <strong>Dropoff:</strong> {{ $schedule->bus->dropoff_point ?? '-' }}<br>
                                <strong>Waktu:</strong> {{ $schedule->start_time ?? '-' }}<br>
                                <strong>Harga:</strong> Rp {{ number_format($schedule->bus->price_per_seat, 0, ',', '.') }}<br>
                                <strong>Kursi:</strong> {{ $schedule->bus->seat_count }}
                            </p>
                            <button 
                                class="btn btn-success w-100 pesan-btn"
                                data-id="{{ $schedule->schedule_id }}"
                                data-bus="{{ $schedule->bus->bus_name }}"
                                data-time="{{ $schedule->start_time }}"
                                data-price="{{ $schedule->bus->price_per_seat }}"
                                data-available="{{ $schedule->bus->seat_count }}">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Tidak ada jadwal bus ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ================= HISTORY SECTION ================= --}}
    <div id="historySection" class="d-none">
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
                                    <strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- ================= MODAL PEMESANAN ================= --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="bookingForm" method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="schedule_id" id="schedule_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Detail Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p><strong>Bus:</strong> <span id="busName"></span></p>
                    <p><strong>Waktu:</strong> <span id="busTime"></span></p>
                    <p><strong>Harga:</strong> Rp <span id="busPrice"></span></p>
                    <p><strong>Tersedia:</strong> <span id="busAvailable"></span></p>

                    <div class="mt-3">
                        <label for="seat_count" class="form-label">Jumlah Kursi</label>
                        <input type="number" name="seat_count" id="seat_count" class="form-control" min="1" required>
                    </div>

                    <div class="mt-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="DANA">DANA</option>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Bayar di Tempat">Bayar di Tempat</option>
                        </select>
                    </div>

                    <div id="qrSection" class="mt-3 d-none text-center">
                        <p>Scan QR DANA untuk membayar</p>
                        <img src="{{ asset('images/qr_dana.png') }}" alt="QR DANA" width="200" class="rounded shadow-sm">
                    </div>

                    <div id="uploadSection" class="mt-3 d-none">
                        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
    const paymentMethod = document.getElementById('payment_method');
    const qrSection = document.getElementById('qrSection');
    const uploadSection = document.getElementById('uploadSection');

    // Sidebar
    document.getElementById('btnHome').addEventListener('click', () => {
        document.getElementById('homeSection').classList.remove('d-none');
        document.getElementById('historySection').classList.add('d-none');
    });

    document.getElementById('btnHistory').addEventListener('click', () => {
        document.getElementById('historySection').classList.remove('d-none');
        document.getElementById('homeSection').classList.add('d-none');
    });

    // Pesan bus
    document.querySelectorAll('.pesan-btn').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('schedule_id').value = button.dataset.id;
            document.getElementById('busName').textContent = button.dataset.bus;
            document.getElementById('busTime').textContent = button.dataset.time;
            document.getElementById('busPrice').textContent = button.dataset.price;
            document.getElementById('busAvailable').textContent = button.dataset.available;
            modal.show();
        });
    });

    // Metode pembayaran
    paymentMethod.addEventListener('change', () => {
        qrSection.classList.add('d-none');
        uploadSection.classList.add('d-none');

        if (paymentMethod.value === 'DANA') {
            qrSection.classList.remove('d-none');
            uploadSection.classList.remove('d-none');
        } else if (paymentMethod.value === 'Transfer Bank') {
            uploadSection.classList.remove('d-none');
        }
    });
});
</script>
@endsection
