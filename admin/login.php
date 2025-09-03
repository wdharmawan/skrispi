<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- Mengatur agar layout mobile responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>

  <!-- Memanggil file CSS Bootstrap dari CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Memanggil ikon Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<!-- Memberikan warna latar belakang terang -->

<body class="bg-light">

  <?php
  // Memulai sesi agar bisa menggunakan $_SESSION
  session_start();

  // Menghubungkan ke file koneksi database
  include "koneksi.php";

  // Variabel untuk menampung pesan error
  $error = '';

  // Cek apakah form login telah disubmit
  if (isset($_POST['login'])) {
    // Mengambil nilai input dan menghapus spasi di awal/akhir
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query untuk mencocokkan username dan password dengan data di database
    $sql = "SELECT * FROM data_admin WHERE username='$username' AND password='$password'";
    $result = $koneksi->query($sql);

    // Jika data ditemukan, login berhasil
    if ($result->num_rows > 0) {
      // Set session untuk menandai user sebagai admin
      $_SESSION['admin'] = true;

      // Redirect ke halaman utama
      header("Location: ../index.php");
      exit;
    } else {
      // Jika tidak cocok, tampilkan pesan error
      $error = "Username atau password salah!";
    }
  }
  ?>

  <!-- Kontainer Bootstrap untuk posisi form di tengah -->
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
      <!-- Header form login -->
      <div class="text-center mb-4">
        <h4 class="fw-bold">Login Admin</h4>
        <i class="bi bi-shield-lock-fill fs-1 text-primary"></i>
      </div>

      <!-- Menampilkan alert jika terjadi kesalahan login -->
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <!-- Form login admin -->
      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <!-- Tombol submit login -->
        <button type="submit" name="login" class="btn btn-primary w-100">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
      </form>
    </div>
  </div>

  <!-- Script Bootstrap JS untuk interaksi seperti alert/modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>