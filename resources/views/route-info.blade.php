<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Rute | BTO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-primary mb-4 text-center fw-bold">Detail Rute Bus</h3>

        <div class="row mb-3">
            <div class="col-md-6">
                <h5><strong>Keberangkatan:</strong> {{ $route['from'] }}</h5>
            </div>
            <div class="col-md-6">
                <h5><strong>Tujuan:</strong> {{ $route['to'] }}</h5>
            </div>
        </div>

        <p><strong>Jam Keberangkatan:</strong> {{ $route['time'] }}</p>
        <p><strong>Harga Tiket:</strong> Rp {{ number_format($route['price'], 0, ',', '.') }}</p>

        <div class="mt-4 d-flex justify-content-center gap-3">
            <button class="btn btn-success px-4">Pesan Sekarang</button>
            <button class="btn btn-outline-primary px-4">Simpan</button>
            <a href="{{ route('home') }}" class="btn btn-secondary px-4">Kembali</a>
        </div>
    </div>
</div>

</body>
</html>
