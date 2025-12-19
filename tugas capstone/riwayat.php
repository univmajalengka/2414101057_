<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat | BENTALA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">BENTALA</div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="destinasi.php">Destinasi</a></li>
                <li><a href="riwayat.php">Riwayat</a></li>
            </ul>
        </nav>
    </header>

    <div style="padding: 50px;">
        <h2>Daftar Pesanan Anda</h2>
        <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse; background: white;">
            <tr style="background: #6B8E23; color: white;">
                <th>Nama</th>
                <th>Destinasi</th>
                <th>Tgl Perjalanan</th>
                <th>Durasi</th>
                <th>Peserta</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM pemesanan");
            while($row = mysqli_fetch_assoc($res)) {
                echo "<tr>
                    <td>{$row['nama_pemesan']}</td>
                    <td>{$row['nama_wisata']}</td>
                    <td>{$row['tanggal_pesan']}</td>
                    <td>{$row['waktu_perjalanan']} Hari</td>
                    <td>{$row['jumlah_peserta']}</td>
                    <td>Rp " . number_format($row['jumlah_tagihan'], 0, ',', '.') . "</td>
                    <td>
                        <a href='pesan.php?edit={$row['id']}'>Edit</a> | 
                        <a href='proses.php?hapus={$row['id']}' onclick='return confirm(\"Hapus?\")'>Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>