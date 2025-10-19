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

                    @auth
                        <li class="nav-item">
                            <a class="btn btn-outline-danger ms-3" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary ms-3" href="{{ route('register') }}">Daftar</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('login') }}">Masuk</a>
                        </li>
                    @endauth
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
                        <input type="text" name="from" class="form-control" placeholder="Kota Asal" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="to" class="form-control" placeholder="Kota Tujuan" required>
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
                    <a href="{{ route('route.info', 1) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/bandung.jpg') }}" alt="Jakarta - Bandung">
                            <h5 class="mt-2">Jakarta - Bandung</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('route.info', 2) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/malang.jpg') }}" alt="Surabaya - Malang">
                            <h5 class="mt-2">Surabaya - Malang</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('route.info', 3) }}" class="text-decoration-none text-dark">
                        <div class="card-route text-center p-2">
                            <img src="{{ asset('images/semarang.jpg') }}" alt="Yogyakarta - Semarang">
                            <h5 class="mt-2">Yogyakarta - Semarang</h5>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('route.info', 4) }}" class="text-decoration-none text-dark">
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
