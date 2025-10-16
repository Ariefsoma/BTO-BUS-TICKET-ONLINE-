<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧭 Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Selamat datang, Admin {{ Auth::user()->name }}!</h3>
                <p>Ini adalah halaman dashboard admin 🎉</p>
            </div>
        </div>
    </div>
</x-app-layout>
