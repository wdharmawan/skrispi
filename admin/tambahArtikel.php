<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <!-- awal php -->
    <?php
    include "koneksi.php";
    session_start();

    // Cek login admin
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: login.php");
        exit;
    }

    $pesan = '';

    if (isset($_POST['submit'])) {
        $judul = trim($_POST['judul']);
        $konten = trim($_POST['konten']);
        $tanggal = $_POST['tanggal'];
        $sumber = trim($_POST['sumber']);
        $id_admin = 1; // bisa disesuaikan dengan session login jika ada

        $query = "INSERT INTO data_artikel (judul, konten, tanggal, sumber, id_admin)
              VALUES ('$judul', '$konten', '$tanggal', '$sumber', $id_admin)";

        if (mysqli_query($koneksi, $query)) {
            $pesan = "Artikel berhasil ditambahkan!";
        } else {
            $pesan = "Gagal menambahkan artikel.";
        }
    }
    ?>
    <!-- akhir -->

    <div class="container mt-5">
        <h3>Tambah Artikel Baru</h3>

        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= $pesan ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konten</label>
                <textarea name="konten" rows="5" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sumber</label>
                <input type="text" name="sumber" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-success">Tambah Artikel</button>
            <a href="../index.php?halaman=artikel" class="btn btn-secondary">Batal</a>
        </form>
    </div>



    <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>