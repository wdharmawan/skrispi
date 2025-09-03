<?php
session_start();
include "koneksi.php"; // koneksi ke database

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data statistik
$totalMinuman = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_minuman"))['total'];
$totalArtikel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_artikel"))['total'];

$jumlahMerah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_minuman WHERE status_keamanan = 'Merah'"))['total'];
$jumlahKuning = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_minuman WHERE status_keamanan = 'Kuning'"))['total'];
$jumlahHijau = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_minuman WHERE status_keamanan = 'Hijau'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard Admin</h2>

        <div class="row g-4">
            <!-- Total Data Minuman -->
            <div class="col-md-4">
                <div class="card border-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Data Minuman</h5>
                        <p class="card-text display-6"><?= $totalMinuman ?></p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Artikel -->
            <div class="col-md-4">
                <div class="card border-success shadow">
                    <div class="card-body">
                        <h5 class="card-title text-success">Total Artikel</h5>
                        <p class="card-text display-6"><?= $totalArtikel ?></p>
                    </div>
                </div>
            </div>

            <!-- Distribusi Keamanan -->
            <div class="col-md-4">
                <div class="card border-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Distribusi Keamanan Minuman</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">🔴 Merah: <strong><?= $jumlahMerah ?></strong></li>
                            <li class="list-group-item">🟡 Kuning: <strong><?= $jumlahKuning ?></strong></li>
                            <li class="list-group-item">🟢 Hijau: <strong><?= $jumlahHijau ?></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="../index.php?halaman=data_minuman" class="btn btn-outline-primary"><i class="bi bi-collection"></i> Kelola Data Minuman</a>
            <a href="kelolaArtikel.php" class="btn btn-outline-success"><i class="bi bi-journal-text"></i> Kelola Artikel</a>
            <a href="logout.php" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>