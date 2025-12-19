<!DOCTYPE html>
<html>
<head>
    <title>Hitung Diskon</title>
</head>
<body>

<h2>Input Total Belanja</h2>

<form method="POST" action="">
    <label>Total Belanja (Rp): </label>
    <input type="number" name="totalBelanja" required>
    <button type="submit">Hitung</button>
</form>

<?php

// Fungsi untuk menghitung diskon
function hitungDiskon($totalBelanja) {
    $diskon = 0;

    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        $diskon = 0.05 * $totalBelanja;
    }

    return $diskon;
}

// Proses jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $totalBelanja = $_POST['totalBelanja'];

    $diskon = hitungDiskon($totalBelanja);
    $totalBayar = $totalBelanja - $diskon;

    echo "<h3>Hasil Perhitungan</h3>";
    echo "Total Belanja: Rp " . number_format($totalBelanja, 0, ',', '.') . "<br>";
    echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
    echo "Total Bayar: Rp " . number_format($totalBayar, 0, ',', '.') . "<br>";
}
?>

</body>
</html>
