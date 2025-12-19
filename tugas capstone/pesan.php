<?php 
include 'koneksi.php';
$wisata = $_GET['wisata'] ?? "";
$biaya = $_GET['harga'] ?? 0;

// Logika Edit
$id = ""; $nama = ""; $hp = ""; $tgl = ""; $durasi = ""; $peserta = ""; $guide = 0; $mobil = 0;
$is_edit = false;

if (isset($_GET['edit'])) {
    $is_edit = true;
    $id = $_GET['edit'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pemesanan WHERE id=$id"));
    $nama = $data['nama_pemesan']; $hp = $data['nomor_hp']; $wisata = $data['nama_wisata'];
    $biaya = $data['biaya_wisata']; $tgl = $data['tanggal_pesan']; $durasi = $data['waktu_perjalanan'];
    $peserta = $data['jumlah_peserta']; $guide = $data['tour_guide']; $mobil = $data['sewa_mobil'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan | BENTALA</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-box { max-width: 500px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        input[type="text"], input[type="number"], input[type="date"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="form-box">
        <h3>Form Pemesanan: <?php echo $wisata; ?></h3>
        <form action="proses.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="nama_wisata" value="<?php echo $wisata; ?>">
            <input type="hidden" name="biaya_wisata" id="biaya_wisata" value="<?php echo $biaya; ?>">

            <label>Nama Pemesan:</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>" required>

            <label>Nomor HP:</label>
            <input type="text" name="hp" value="<?php echo $hp; ?>" required>

            <label>Tanggal Perjalanan:</label>
            <input type="date" name="tanggal" value="<?php echo $tgl; ?>" required>

            <label>Durasi (Hari):</label>
            <input type="number" name="durasi" id="durasi" value="<?php echo $durasi; ?>" min="1" required>

            <label>Jumlah Peserta:</label>
            <input type="number" name="peserta" id="peserta" value="<?php echo $peserta; ?>" min="1" required>

            <p><strong>Layanan Tambahan:</strong></p>
            <input type="checkbox" name="guide" class="layanan" value="200000" <?php echo $guide ? 'checked' : ''; ?>> Tour Guide (Rp 200.000)<br>
            <input type="checkbox" name="mobil" class="layanan" value="300000" <?php echo $mobil ? 'checked' : ''; ?>> Sewa Mobil (Rp 300.000)<br><br>

            <label>Harga Paket (Per Orang/Hari):</label>
            <input type="text" name="harga_paket" id="harga_paket" readonly>

            <label>Total Tagihan:</label>
            <input type="text" name="total" id="total" readonly style="font-weight:bold; color:green;">

            <button type="submit" name="<?php echo $is_edit ? 'update' : 'simpan'; ?>" class="main-cta-button" style="width:100%; border:none; cursor:pointer;">KONFIRMASI</button>
        </form>
    </div>

    <script>
        const biayaDasar = parseInt(document.getElementById('biaya_wisata').value);
        const durasiIn = document.getElementById('durasi');
        const pesertaIn = document.getElementById('peserta');
        const checkboxes = document.querySelectorAll('.layanan');
        const hrgPaket = document.getElementById('harga_paket');
        const hrgTotal = document.getElementById('total');

        function hitung() {
            let biayaLayanan = 0;
            checkboxes.forEach(c => { if(c.checked) biayaLayanan += parseInt(c.value); });
            
            let paket = biayaDasar + biayaLayanan;
            let total = paket * (parseInt(durasiIn.value) || 0) * (parseInt(pesertaIn.value) || 0);

            hrgPaket.value = paket;
            hrgTotal.value = total;
        }

        durasiIn.addEventListener('input', hitung);
        pesertaIn.addEventListener('input', hitung);
        checkboxes.forEach(c => c.addEventListener('change', hitung));
        window.onload = hitung;
    </script>
</body>
</html>