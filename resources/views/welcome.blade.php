<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTO - Bus Ticket Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .hero {
            background: url('{{ asset('images/hero.jpg') }}') no-repeat center center/cover;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
        }
        .hero-content {
            background: rgba(0,0,0,0.6);
            padding: 30px;
            border-radius: 10px;
        }
        .popular-route img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.4s ease;
        }
        .card-route {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .card-route:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
        }
        .card-route:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    {{-- ====================== Navbar ====================== --}}
    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ url('/') }}">🚌 BTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>

                    {{-- ✅ Gunakan Auth::check() agar tidak error saat user belum login --}}
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary ms-3" href="{{ route('register') }}">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- ====================== Hero Section ====================== --}}
    <section class="hero mt-5">
        <div class="container">
            <div class="col-md-6 hero-content">
                <h1 class="fw-bold">Pesan Tiket Bus Mudah dan Cepat</h1>
                <p>Cari rute, pilih kursi, dan nikmati perjalanan nyaman bersama BTO.</p>

                <form class="row g-2 mt-3" action="{{ route('search.route') }}" method="GET">
                    <div class="col-md-5">
                        <select name="from" class="form-select" required>
                            <option value="">Pilih Kota Asal</option>
                            @foreach($availableCities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="to" class="form-select" required>
                            <option value="">Pilih Kota Tujuan</option>
                            @foreach($availableCities as $city)
                                <option value="{{ $city }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning w-100" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ====================== Rute Populer ====================== --}}
    <section class="py-5">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Rute Bus Populer</h3>
            <div class="row g-4">

                <div class="col-md-3">
                    <a href="{{ route('search.route', ['from' => 'Jakarta', 'to' => 'Bandung']) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/bandung.jpg') }}" alt="Jakarta - Bandung">
                            <h5 class="mt-2">Jakarta - Bandung</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('search.route', ['from' => 'Surabaya', 'to' => 'Malang']) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/malang.jpg') }}" alt="Surabaya - Malang">
                            <h5 class="mt-2">Surabaya - Malang</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('search.route', ['from' => 'Yogyakarta', 'to' => 'Semarang']) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/semarang.jpg') }}" alt="Yogyakarta - Semarang">
                            <h5 class="mt-2">Yogyakarta - Semarang</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('search.route', ['from' => 'Denpasar', 'to' => 'Ubud']) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/ubud.jpg') }}" alt="Denpasar - Ubud">
                            <h5 class="mt-2">Denpasar - Ubud</h5>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- ====================== Footer ====================== --}}
    <footer class="bg-primary text-white text-center py-3">
        <p class="mb-0">© 2025 BTO - Bus Ticket Online. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
