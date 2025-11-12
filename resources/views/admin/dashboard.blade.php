<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧭 Dashboard Admin
        </h2>
    </x-slot>

    <div x-data="{ tab: 'bus' }" class="flex h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 text-white p-6 space-y-4">
            <h3 class="text-xl font-bold mb-6">Menu Admin</h3>

            <button @click="tab = 'bus'"
                :class="tab === 'bus' ? 'bg-blue-600' : 'bg-gray-700 hover:bg-gray-600'"
                class="w-full text-left px-4 py-2 rounded transition">
                🚌 Kelola Bus
            </button>

            <button @click="tab = 'route'"
                :class="tab === 'route' ? 'bg-blue-600' : 'bg-gray-700 hover:bg-gray-600'"
                class="w-full text-left px-4 py-2 rounded transition">
                🛣️ Kelola Rute
            </button>

            <button @click="tab = 'schedule'"
                :class="tab === 'schedule' ? 'bg-blue-600' : 'bg-gray-700 hover:bg-gray-600'"
                class="w-full text-left px-4 py-2 rounded transition">
                🕒 Kelola Jadwal
            </button>
        </aside>

        {{-- Konten Utama --}}
        <main class="flex-1 bg-gray-50 p-8 overflow-y-auto">

            {{-- BUS --}}
            <div x-show="tab === 'bus'" x-transition>
                <h3 class="text-lg font-semibold mb-4">🚌 Daftar Bus</h3>
                <a href="{{ route('admin.bus.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Tambah Bus
                </a>

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
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
                            <tr><td colspan="6" class="text-center py-4">Belum ada data bus.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ROUTE --}}
            <div x-show="tab === 'route'" x-transition>
                <h3 class="text-lg font-semibold mb-4">🛣️ Daftar Rute</h3>
                <a href="{{ route('admin.routes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Tambah Rute
                </a>

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Asal</th>
                            <th class="border px-4 py-2">Tujuan</th>
                            <th class="border px-4 py-2">Jarak (km)</th>
                            <th class="border px-4 py-2">Estimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routes as $route)
                            <tr>
                                <td class="border px-4 py-2">{{ $route->route_id }}</td>
                                <td class="border px-4 py-2">{{ $route->origin }}</td>
                                <td class="border px-4 py-2">{{ $route->destination }}</td>
                                <td class="border px-4 py-2">{{ $route->distance }}</td>
                                <td class="border px-4 py-2">{{ $route->estimated_time }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Belum ada data rute.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- SCHEDULE --}}
            <div x-show="tab === 'schedule'" x-transition>
                <h3 class="text-lg font-semibold mb-4">🕒 Jadwal Keberangkatan</h3>
                <a href="{{ route('admin.schedules.create') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    + Tambah Jadwal
                </a>

                <table class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">#</th>
                            <th class="border px-4 py-2">Bus</th>
                            <th class="border px-4 py-2">Rute</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td class="border px-4 py-2">{{ $schedule->schedule_id }}</td>
                                <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $schedule->route->origin ?? '-' }} → {{ $schedule->route->destination ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $schedule->date ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $schedule->time ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Belum ada jadwal.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
