<?php
session_start();
include "./admin/koneksi.php";

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data artikel berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM data_artikel WHERE id_artikel = $id");

if (mysqli_num_rows($query) === 0) {
    echo "<h3>Artikel tidak ditemukan.</h3>";
    exit;
}

$artikel = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($artikel['judul']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <a href="index.php?halaman=artikel" class="btn btn-secondary mb-3">&larr; Kembali</a>

    <h1><?= htmlspecialchars($artikel['judul']) ?></h1>
    <p class="text-muted"><?= date("d M Y", strtotime($artikel['tanggal'])) ?> | Sumber:  <?= htmlspecialchars($artikel['sumber']) ?></p>
    <hr>
    <div>
        <?= nl2br($artikel['konten']) ?>
    </div>
</body>

</html>