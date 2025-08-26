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
      <form action="{{ route('login.post')}}" method="POST">
        @csrf
        <!-- Input Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required />
          @error('email')
          <span style="color:red">{{ $message }}</span>
      @enderror
        </div>

        <!-- Input Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required />
        </div>

        <!-- Tombol login -->
        <div class="d-grid">
          <!-- Perlu diperhatikan: menggunakan <a> untuk tombol login tidak ideal -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Memuat Bootstrap JS bundle untuk komponen interaktif -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
