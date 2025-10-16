<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTO - Bus Ticket Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .hero {
            background: url('https://images.unsplash.com/photo-1587139223877-5d4a5e1e77c0?auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
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
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">🚌 BTO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Rute</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-3" href="/login">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero mt-5" style="background: url('{{ asset('images/hero.jpg') }}') no-repeat center center/cover;">
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

    <!-- Rute Populer -->
    <section class="py-5">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Rute Bus Populer</h3>
            <div class="row g-4">
                <div class="col-md-3 popular-route">
                    <img src="{{ asset('images/bandung.jpg') }}" alt="Jakarta - Bandung">
                    <h5 class="mt-2">Jakarta - Bandung</h5>
                </div>
                <div class="col-md-3 popular-route">
                    <img src="{{ asset('images/malang.jpg') }}" alt="Surabaya - Malang">
                    <h5 class="mt-2">Surabaya - Malang</h5>
                </div>
                <div class="col-md-3 popular-route">
                     <img src="{{ asset('images/semarang.jpg') }}" alt="Yogyakarta - Semarang">
                    <h5 class="mt-2">Yogyakarta - Semarang</h5>
                </div>
                <div class="col-md-3 popular-route">
                    <img src="{{ asset('images/ubud.jpg') }}" alt="Denpasar - Ubud">
                    <h5 class="mt-2">Denpasar - Ubud</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p class="mb-0">© 2025 BTO - Bus Ticket Online. Semua Hak Dilindungi.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
