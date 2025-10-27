// index.js

// Fungsi untuk memuat komponen, DENGAN callback setelah selesai
function loadComponent(elementId, url, callback) {
  fetch(url)
    .then(response => response.text())
    .then(data => {
      document.getElementById(elementId).innerHTML = data;
      if (callback) {
        callback(); // Jalankan callback jika ada
      }
    })
    .catch(error => console.error('Error loading component:', error));
}

// js/index.js

function initializeModalLogic() {
  const purchaseModal = document.getElementById('purchaseModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const purchaseForm = document.getElementById('purchaseForm');
  const productNameInput = document.getElementById('productNameInput');
  const productCards = document.querySelectorAll('.product-card');

  productCards.forEach(card => {
    card.addEventListener('click', () => {
      const productName = card.querySelector('h4').innerText;
      productNameInput.value = productName;
      purchaseModal.classList.remove('hidden');
    });
  });
  
  const closeModal = () => {
    purchaseModal.classList.add('hidden');
  };

  closeModalBtn.addEventListener('click', closeModal);

  purchaseModal.addEventListener('click', (event) => {
    if (event.target === purchaseModal) {
      closeModal();
    }
  });

  // ===== INI BAGIAN YANG DIPERBARUI =====
  purchaseForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Tetap cegah form reload halaman

    const formData = new FormData(purchaseForm);
    const submitButton = purchaseForm.querySelector('button[type="submit"]');
    
    // Nonaktifkan tombol saat mengirim data
    submitButton.disabled = true;
    submitButton.innerText = 'Memproses...';

    // Kirim data form ke PHP menggunakan Fetch API
    fetch('proses_pembelian.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json()) // Mengambil respons sebagai JSON
    .then(data => {
      // Tampilkan pesan berdasarkan respons dari PHP
      if (data.status === 'sukses') {
        alert('Pesanan Sukses!\n\n' + data.message);
        closeModal();
        purchaseForm.reset();
      } else {
        alert('Pesanan Gagal!\n\n' + data.message);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Terjadi kesalahan koneksi.');
    })
    .finally(() => {
      // Aktifkan kembali tombol setelah selesai
      submitButton.disabled = false;
      submitButton.innerText = 'Selesai';
    });
  });
}

// Memanggil fungsi saat halaman siap
document.addEventListener("DOMContentLoaded", function() {
  // Cek apakah ada placeholder produk, jika ada, jalankan logika modal
  if (document.getElementById('produk-placeholder') || document.querySelectorAll('.product-card').length > 0) {
    initializeModalLogic();
  }
});