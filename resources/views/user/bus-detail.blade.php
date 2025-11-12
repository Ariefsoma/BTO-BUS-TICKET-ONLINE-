<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-3">{{ $bus->bus_name }}</h2>
        <img src="{{ asset('images/'.$bus->image) }}" alt="Bus Image" class="img-fluid rounded mb-3" style="max-height:300px;">

        <ul class="list-group mb-3">
            <li class="list-group-item"><b>Jenis:</b> {{ $bus->bus_type }}</li>
            <li class="list-group-item"><b>Plat Nomor:</b> {{ $bus->plate_number }}</li>
            <li class="list-group-item"><b>Pickup:</b> {{ $bus->pickup_point }}</li>
            <li class="list-group-item"><b>Dropoff:</b> {{ $bus->dropoff_point }}</li>
            <li class="list-group-item"><b>Kursi Tersedia:</b> {{ $bus->seat_count }}</li>
            <li class="list-group-item"><b>Harga per Kursi:</b> Rp {{ number_format($bus->price_per_seat,0,',','.') }}</li>
        </ul>

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
            <div class="mb-3">
                <label>Jumlah Kursi Dipesan:</label>
                <input type="number" name="seat_number" class="form-control" min="1" max="{{ $bus->seat_count }}" required>
            </div>

            <button type="submit" class="btn btn-success">Pesan Sekarang</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</x-app-layout>
