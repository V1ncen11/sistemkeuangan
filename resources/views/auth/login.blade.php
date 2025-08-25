<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Login</title>

  <!-- Memuat Bootstrap CSS dari CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Memuat CSS tambahan khusus (lokal) -->
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- Container utama untuk seluruh konten login -->
  <div class="container login-container">
    
    <!-- Judul sistem -->
    <div class="text-center mb-4 mt-5">
      <h1 class="system-title">Sistem Informasi Pembayaran Sekolah</h1>
    </div>

    <!-- Kotak/form login -->
    <div class="login-box">
      <h2 class="login-title">Login</h2>

      <!-- Form login -->
      <form>
        <!-- Input Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Masukkan email" required />
        </div>

        <!-- Input Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" placeholder="Masukkan password" required />
        </div>

        <!-- Tombol login -->
        <div class="d-grid">
          <!-- Perlu diperhatikan: menggunakan <a> untuk tombol login tidak ideal -->
          <a href="{{ route('halutama')}}" type="submit" class="btn btn-primary">Login</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Memuat Bootstrap JS bundle untuk komponen interaktif -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
