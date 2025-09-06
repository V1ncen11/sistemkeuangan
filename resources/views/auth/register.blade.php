<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Halaman Register</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="container login-container">
    <div class="text-center mb-4 mt-5">
      <h1 class="system-title">Sistem Informasi Pembayaran Sekolah</h1>
    </div>

    <div class="login-box">
      <h2 class="login-title">Register</h2>

      <!-- 🔹 Form Laravel -->
      <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Input Nama -->
        <div class="mb-3">
          <label for="name" class="form-label">Nama</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required />
          @error('name')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required />
          @error('email')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <!-- Input Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required />
          @error('password')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required />
        </div>

        <!-- Tombol Daftar -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Daftar</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
