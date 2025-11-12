<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">🛣️ Daftar Rute</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                {{-- Notifikasi sukses --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Semua Rute</h3>
                    <a href="{{ route('admin.routes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Rute</a>
                </div>

                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Asal</th>
                            <th class="px-4 py-2 border">Tujuan</th>
                            <th class="px-4 py-2 border">Jarak (km)</th>
                            <th class="px-4 py-2 border">Estimasi Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routes as $route)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $route->route_id }}</td>
                                <td class="border px-4 py-2">{{ $route->origin }}</td>
                                <td class="border px-4 py-2">{{ $route->destination }}</td>
                                <td class="border px-4 py-2 text-center">{{ $route->distance }}</td>
                                <td class="border px-4 py-2 text-center">{{ $route->estimated_time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada data rute.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
