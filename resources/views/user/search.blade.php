<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencarian Tiket Bus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Hasil Pencarian</h3>

                <p>Dari: <strong>{{ $from }}</strong> → Ke: <strong>{{ $to }}</strong></p>
                <hr class="my-3">

                <p class="text-gray-600">Menampilkan jadwal bus yang tersedia...</p>
            </div>
        </div>
    </div>
</x-app-layout>
