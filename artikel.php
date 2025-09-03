<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Kesehatan</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./asset/css/style3.css">
    <link rel="stylesheet" href="./asset/css/style2.css">

    <!-- Bootstrap CSS dan Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Mulai session jika belum dimulai
    }
    
    include "./admin/koneksi.php"; // Koneksi ke database

    // Ambil semua artikel dari database, urut berdasarkan tanggal terbaru
    $query = mysqli_query($koneksi, "SELECT * FROM data_artikel ORDER BY tanggal DESC");
    ?>

    <div class="main-content">

        <div class="container mt-4">
            <!-- Judul dan tombol tambah (hanya tampil jika admin login) -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Artikel Kesehatan</h3>

                <?php if (isset($_SESSION['admin'])) : ?>
                    <!-- Tombol tambah artikel untuk admin -->
                    <a href="./admin/tambahArtikel.php" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah Artikel
                    </a>
                <?php endif; ?>
            </div>

            <!-- Tampilkan semua artikel dalam bentuk card -->
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <!-- Judul dan tanggal artikel -->
                                <h5 class="card-title"><?= $row['judul'] ?></h5>
                                <small class="text-muted"><?= date("d M Y", strtotime($row['tanggal'])) ?></small>

                                <!-- Potongan isi artikel (maks. 200 karakter) -->
                                <p class="card-text mt-2">
                                    <?= substr(strip_tags($row['konten']), 0, 200) ?>...
                                </p>

                                <!-- Tombol untuk melihat artikel detail -->
                                <a href="detail_artikel.php?id=<?= $row['id_artikel'] ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>

                                <!-- Tombol edit dan hapus hanya tampil jika admin login -->
                                <?php if (isset($_SESSION['admin'])) : ?>
                                    <!-- Tombol Edit -->
                                    <!-- <a href="edit_artikel.php?id=<?= $row['id_artikel'] ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a> -->

                                    <!-- Tombol Hapus (dalam form karena pakai POST) -->
                                    <form action="./admin/hapusArtikel.php" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        <input type="hidden" name="id_artikel" value="<?= $row['id_artikel'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>

</body>

</html>