<?php
// 1. Ambil koneksi dari file koneksi.phpi
require_once 'koneksi.php';

// 2. Buat query untuk mengambil semua data dari tabel produk
$sql = "SELECT * FROM produk";
$result = mysqli_query($conn, $sql);
?>

<section id="produk" class="bg-gray-50 py-12">
  <div class="container mx-auto px-6">
    <h2 class="text-2xl font-bold" data-aos="fade-up">Produk Terpopuler</h2>
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <?php
      // 3. Looping (ulangi) untuk setiap baris data produk yang ditemukan
      while ($row = mysqli_fetch_assoc($result)) :
      ?>

        <article class="product-card bg-white rounded-xl overflow-hidden shadow cursor-pointer hover:shadow-lg transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="100">
          <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_produk']; ?>" class="w-full h-40 object-cover">
          <div class="p-4">
            <h4 class="font-semibold text-lg"><?php echo $row['nama_produk']; ?></h4>
            <p class="mt-2 text-sm text-gray-500">IDR <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
          </div>
        </article>

      <?php
      // 4. Akhir dari looping
      endwhile;
      ?>

    </div>
  </div>
</section>