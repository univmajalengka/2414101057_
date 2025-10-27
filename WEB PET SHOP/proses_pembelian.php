<?php
// proses_pembelian.php
header('Content-Type: application/json');

require_once 'koneksi.php';

// 3. PENGECEKAN KONEKSI
if (!$conn || mysqli_connect_errno()) {
    echo json_encode([
        'status' => 'gagal',
        'message' => 'Koneksi ke database gagal: ' . mysqli_connect_error()
    ]);
    exit;
}

// 4. Ambil data dari POST
$nama_pelanggan = $_POST['name'];
$no_whatsapp = $_POST['whatsapp'];
$alamat = $_POST['address'];
$metode_pembayaran = $_POST['payment'];
$nama_produk = $_POST['productName'];

// 5. Cari produk di database
$sql_produk = "SELECT id, harga FROM produk WHERE nama_produk = ?";
$stmt_produk = mysqli_prepare($conn, $sql_produk);

if ($stmt_produk === false) {
    echo json_encode(['status' => 'gagal', 'message' => 'Query error (stmt_produk): ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt_produk, "s", $nama_produk);
mysqli_stmt_execute($stmt_produk);


// ===================================================================
// !! BAGIAN YANG DIPERBAIKI (MENGGANTIKAN get_result) !!
// ===================================================================

mysqli_stmt_store_result($stmt_produk); // Simpan hasil di statement

$produk = null; // Inisialisasi $produk sebagai null

// Cek apakah ada produk yang ditemukan
if (mysqli_stmt_num_rows($stmt_produk) > 0) {
    // Bind variabel hasil
    $produk_id_db = null;
    $harga_db = null;
    mysqli_stmt_bind_result($stmt_produk, $produk_id_db, $harga_db);
    
    // Ambil nilainya
    mysqli_stmt_fetch($stmt_produk);
    
    // Masukkan ke array $produk agar sisa kode tidak perlu diubah
    $produk = [
        'id' => $produk_id_db,
        'harga' => $harga_db
    ];
}
// ===================================================================
// !! AKHIR BAGIAN YANG DIPERBAIKI !!
// ===================================================================


// 6. Cek jika produknya ada (Sisa kode sama persis)
if ($produk) {
    $produk_id = $produk['id'];
    $harga_saat_beli = $produk['harga'];
    
    // 7. Mulai Transaksi Database
    mysqli_autocommit($conn, false);

    try {
        // A. Masukkan data ke tabel `pesanan`
        $sql_pesanan = "INSERT INTO pesanan (nama_pelanggan, no_whatsapp, alamat, metode_pembayaran) VALUES (?, ?, ?, ?)";
        $stmt_pesanan = mysqli_prepare($conn, $sql_pesanan);
        if ($stmt_pesanan === false) {
            throw new Exception('Prepare statement gagal (pesanan): ' . mysqli_error($conn));
        }
        
        mysqli_stmt_bind_param($stmt_pesanan, "ssss", $nama_pelanggan, $no_whatsapp, $alamat, $metode_pembayaran);
        if (!mysqli_stmt_execute($stmt_pesanan)) {
            throw new Exception('Eksekusi statement gagal (pesanan): ' . mysqli_stmt_error($stmt_pesanan));
        }
        
        $pesanan_id = mysqli_insert_id($conn);

        // B. Masukkan data ke tabel `detail_pesanan`
        $sql_detail = "INSERT INTO detail_pesanan (pesanan_id, produk_id, harga_saat_beli) VALUES (?, ?, ?)";
        $stmt_detail = mysqli_prepare($conn, $sql_detail);
        if ($stmt_detail === false) {
            throw new Exception('Prepare statement gagal (detail): ' . mysqli_error($conn));
        }
        
        mysqli_stmt_bind_param($stmt_detail, "iii", $pesanan_id, $produk_id, $harga_saat_beli);
        if (!mysqli_stmt_execute($stmt_detail)) {
            throw new Exception('Eksekusi statement gagal (detail): ' . mysqli_stmt_error($stmt_detail));
        }

        // C. Commit
        mysqli_commit($conn);
        echo json_encode(['status' => 'sukses', 'message' => 'Pesanan berhasil dibuat! ID Pesanan: ' . $pesanan_id]);

    } catch (Exception $e) {
        // D. Rollback
        mysqli_rollback($conn);
        echo json_encode(['status' => 'gagal', 'message' => 'Transaksi gagal: ' . $e->getMessage()]);
    }

} else {
    // Jika produk tidak ditemukan
    echo json_encode(['status' => 'gagal', 'message' => 'Produk tidak ditemukan.']);
}

// 8. Tutup semua
mysqli_stmt_close($stmt_produk);
if (isset($stmt_pesanan)) {
    mysqli_stmt_close($stmt_pesanan);
}
if (isset($stmt_detail)) {
    mysqli_stmt_close($stmt_detail);
}
mysqli_close($conn);
?>