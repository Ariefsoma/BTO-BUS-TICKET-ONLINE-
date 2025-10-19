<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Bus Baru
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">

                <form action="{{ route('admin.bus.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Nama Bus</label>
                        <input type="text" name="bus_name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Tipe Bus</label>
                        <input type="text" name="bus_type" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Jumlah Kursi</label>
                        <input type="number" name="seat_count" value="40" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Harga per Kursi (Rp)</label>
                        <input type="number" step="0.01" name="price_per_seat" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Status</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
