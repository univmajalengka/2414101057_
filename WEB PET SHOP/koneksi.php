<?php
// koneksi.php (Versi untuk LOKAL / XAMPP)

$servername = "localhost";
$username = "tugaspabw_2414101057";      // <-- KEMBALIKAN KE 'root'
$password = "ADIT2414101057_";          // <-- KOSONGKAN LAGI PASSWORDNYA
$dbname = "tugaspabw_2414101057"; // Nama database di komputer lokal Anda

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>