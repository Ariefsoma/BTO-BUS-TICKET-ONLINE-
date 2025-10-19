<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Tambah Rute Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('admin.routes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Asal</label>
                        <input type="text" name="origin" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Tujuan</label>
                        <input type="text" name="destination" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Jarak (km)</label>
                        <input type="number" step="0.1" name="distance" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Estimasi Waktu</label>
                        <input type="text" name="estimated_time" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
