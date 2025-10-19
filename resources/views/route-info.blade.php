<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Informasi Rute
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold mb-3">Rute: {{ $route['from'] }} → {{ $route['to'] }}</h3>
                <p><strong>Waktu Berangkat:</strong> {{ $route['time'] }}</p>
                <p><strong>Harga Tiket:</strong> Rp {{ number_format($route['price'], 0, ',', '.') }}</p>

                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</x-app-layout>
