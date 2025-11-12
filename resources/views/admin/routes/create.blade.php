<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">➕ Tambah Rute Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                <form action="{{ route('admin.routes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Asal</label>
                        <input type="text" name="origin" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Tujuan</label>
                        <input type="text" name="destination" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Jarak (km)</label>
                        <input type="number" name="distance" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Estimasi Waktu</label>
                        <input type="text" name="estimated_time" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                    <a href="{{ route('admin.routes.index') }}" class="ml-2 bg-gray-400 text-black px-4 py-2 rounded hover:bg-gray-500">
                        Batal
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
