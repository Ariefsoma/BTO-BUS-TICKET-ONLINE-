<form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

    <label>Jumlah Kursi:</label>
    <input type="number" name="seat_count" min="1" max="{{ $schedule->available_seats }}" required>

    <label>Metode Pembayaran:</label>
    <select name="payment_method" required>
        <option value="dana">DANA</option>
        <option value="bank">Transfer Bank</option>
    </select>

    <div id="qr_dana" style="display:none;">
        <img src="{{ asset('images/qr_dana.png') }}" width="200">
    </div>

    <label>Upload Bukti Pembayaran:</label>
    <input type="file" name="payment_proof" accept="image/*" required>

    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
</form>

<script>
document.querySelector('select[name="payment_method"]').addEventListener('change', function() {
    document.getElementById('qr_dana').style.display = this.value === 'dana' ? 'block' : 'none';
});
</script>
