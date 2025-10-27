<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Hubungi Kami — Petshop</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  
  <link rel="stylesheet" href="style.css">
</head>
<body class="antialiased text-gray-800 bg-white">

  <div id="navbar-placeholder"></div>

  <main class="container mx-auto px-6 py-12">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl md:text-4xl font-extrabold text-center">Hubungi Kami</h1>
      <p class="mt-4 text-gray-600 text-center">
        Punya pertanyaan atau masukan? Jangan ragu untuk mengisi formulir di bawah ini.
      </p>

      <form class="mt-8 space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input 
            type="text" 
            id="name" 
            name="name" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            required>
        </div>
        
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            required>
        </div>

        <div>
          <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
          <textarea 
            id="message" 
            name="message" 
            rows="4" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            required></textarea>
        </div>

        <div>
          <button 
            type="submit" 
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Kirim Pesan
          </button>
        </div>
      </form>
    </div>
  </main>

  <div id="footer-placeholder"></div>
  
  <script>
    // Fungsi untuk memuat komponen HTML dari file eksternal
    function loadComponent(elementId, url) {
      fetch(url)
        .then(response => response.text())
        .then(data => {
          document.getElementById(elementId).innerHTML = data;
        })
        .catch(error => console.error('Error loading component:', error));
    }
    
    // Memuat navbar dan footer saat halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
      loadComponent('navbar-placeholder', '_navbar.html');
      loadComponent('footer-placeholder', '_footer.html');
    });
  </script>
</body>
</html>