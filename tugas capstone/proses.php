<?php
include 'koneksi.php';

if (isset($_POST['simpan']) || isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $wisata = $_POST['nama_wisata'];
    $biaya_w = $_POST['biaya_wisata'];
    $tgl = $_POST['tanggal'];
    $durasi = $_POST['durasi'];
    $peserta = $_POST['peserta'];
    $guide = isset($_POST['guide']) ? 1 : 0;
    $mobil = isset($_POST['mobil']) ? 1 : 0;
    $harga_p = $_POST['harga_paket'];
    $total = $_POST['total'];

    if (isset($_POST['update'])) {
        $sql = "UPDATE pemesanan SET nama_pemesan='$nama', nomor_hp='$hp', tanggal_pesan='$tgl', waktu_perjalanan='$durasi', tour_guide='$guide', sewa_mobil='$mobil', jumlah_peserta='$peserta', harga_paket='$harga_p', jumlah_tagihan='$total' WHERE id=$id";
    } else {
        $sql = "INSERT INTO pemesanan (nama_pemesan, nomor_hp, nama_wisata, biaya_wisata, tanggal_pesan, waktu_perjalanan, tour_guide, sewa_mobil, jumlah_peserta, harga_paket, jumlah_tagihan) 
                VALUES ('$nama', '$hp', '$wisata', '$biaya_w', '$tgl', '$durasi', '$guide', '$mobil', '$peserta', '$harga_p', '$total')";
    }

    if (mysqli_query($conn, $sql)) header("Location: riwayat.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pemesanan WHERE id=$id");
    header("Location: riwayat.php");
}
?>