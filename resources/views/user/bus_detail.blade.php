<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-4">{{ $bus->bus_name }}</h2>

        <div class="bg-white shadow p-6 rounded-lg space-y-2">
            <p><strong>Tipe:</strong> {{ $bus->bus_type }}</p>
            <p><strong>Rute:</strong> {{ $bus->route->origin }} → {{ $bus->route->destination }}</p>
            <p><strong>Harga per kursi:</strong> Rp {{ number_format($bus->price_per_seat, 0, ',', '.') }}</p>
            <p><strong>Kursi tersedia:</strong> {{ $bus->seat_count }}</p>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ url()->previous() }}" class="bg-gray-400 text-black px-4 py-2 rounded-lg hover:bg-gray-500">
                ← Kembali
            </a>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
                <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg hover:bg-blue-700">
                    Pesan Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
