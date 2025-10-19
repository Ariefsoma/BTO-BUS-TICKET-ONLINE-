<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🚌 Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                {{-- Tombol Navigasi --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Menu Admin</h3>
                    <a href="{{ route('admin.bus.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                       + Tambah Bus
                    </a>
                </div>

                {{-- Menu Navigasi --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border rounded-lg p-6 shadow hover:shadow-lg transition">
                        <h4 class="font-bold text-lg mb-2">🚌 Kelola Bus</h4>
                        <p class="text-gray-600 mb-3">Lihat dan tambahkan data bus.</p>
                        <a href="{{ route('admin.bus.index') }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lihat Bus</a>
                    </div>

                    <div class="border rounded-lg p-6 shadow hover:shadow-lg transition">
                        <h4 class="font-bold text-lg mb-2">🛣️ Kelola Rute</h4>
                        <p class="text-gray-600 mb-3">Tambah, ubah, dan hapus rute perjalanan.</p>
                        <a href="{{ route('admin.routes.index') }}"
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lihat Rute</a>
                    </div>

                    <div class="border rounded-lg p-6 shadow hover:shadow-lg transition">
                        <h4 class="font-bold text-lg mb-2">🕒 Kelola Jadwal</h4>
                        <p class="text-gray-600 mb-3">Atur jadwal keberangkatan bus.</p>
                        <a href="{{ route('admin.schedules.index') }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Lihat Jadwal</a>
                    </div>
                </div>

                {{-- Tabel Bus --}}
                <div class="mt-10">
                    <h3 class="text-lg font-semibold mb-3">Daftar Bus</h3>
                    <table class="min-w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Nama Bus</th>
                                <th class="border px-4 py-2">Tipe</th>
                                <th class="border px-4 py-2">Kursi</th>
                                <th class="border px-4 py-2">Harga</th>
                                <th class="border px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($buses as $bus)
                                <tr>
                                    <td class="border px-4 py-2">{{ $bus->bus_id }}</td>
                                    <td class="border px-4 py-2">{{ $bus->bus_name }}</td>
                                    <td class="border px-4 py-2">{{ $bus->bus_type }}</td>
                                    <td class="border px-4 py-2">{{ $bus->seat_count }}</td>
                                    <td class="border px-4 py-2">Rp {{ number_format($bus->price_per_seat, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($bus->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Belum ada data bus.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
