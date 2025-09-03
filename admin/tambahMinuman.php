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
    session_start();
    include 'koneksi.php';

   

    // Cek login admin
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: login.php");
        exit;
    }

    // Proses form jika disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_merk = $_POST['nama_merk'];
        $nama_minuman = $_POST['nama_minuman'];
        $kelompok = $_POST['kategori_kelompok'];
        $ukuran_porsi = $_POST['ukuran_porsi'];
        $ukuran_kalori = $_POST['ukuran_kalori'];
        $jenis_pemanis = $_POST['jenis_pemanis'];
        $kadar_gula = $_POST['kadar_gula'];
        $kadar_garam = $_POST['kadar_garam'];
        $kadar_lemak = $_POST['kadar_lemak'];

        // Upload gambar
        // $gambar = '';
        // if ($_FILES['gambar']['name']) {
        //     $target_dir = "../uploads/";
        //     $gambar = basename($_FILES["gambar"]["name"]);
        //     $target_file = $target_dir . $gambar;
        //     move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        // }

        // Simpan ke database
        $query = "INSERT INTO data_minuman (nama_merk, nama_minuman, kategori_kelompok, ukuran_porsi, ukuran_kalori, jenis_pemanis, kadar_gula, kadar_garam, kadar_lemak) 
              VALUES ('$nama_merk','$nama_minuman', '$kelompok', '$ukuran_porsi', '$ukuran_kalori', '$jenis_pemanis', '$kadar_gula', '$kadar_garam', '$kadar_lemak')";

        if (mysqli_query($koneksi, $query)) {
            header("Location:../index.php?halaman=data_minuman");
            exit();
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($koneksi);
        }
    }
    ?>
    <!-- akhir -->

    <div class="container mt-5">
        <h2>Tambah Data Minuman</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Merk</label>
                <input type="text" class="form-control" name="nama_merk" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Minuman</label>
                <input type="text" class="form-control" name="nama_minuman" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Kategori Kelompok</label>
                <input type="text" class="form-control" name="kategori_kelompok" required>
            </div>
            <div class="mb-3">
                <label for="ukuran_porsi" class="form-label">Ukuran Porsi (ml)</label>
                <input type="number" class="form-control" name="ukuran_porsi" required>
            </div>
            <div class="mb-3">
                <label for="ukuran_porsi" class="form-label">Ukuran Kalori</label>
                <input type="number" class="form-control" name="ukuran_kalori" required>
            </div>
            <div class="mb-3">
                <label for="jenis_pemanis" class="form-label">Jenis Pemanis</label>
                <input type="text" class="form-control" name="jenis_pemanis" required>
            </div>
            <div class="mb-3">
                <label for="kadar_gula" class="form-label">Kadar Gula (g)</label>
                <input type="number" class="form-control" name="kadar_gula" required>
            </div>
            <div class="mb-3">
                <label for="kadar_garam" class="form-label">Kadar Garam (mg)</label>
                <input type="number" class="form-control" name="kadar_garam" required>
            </div>
            <div class="mb-3">
                <label for="kadar_lemak" class="form-label">Kadar Lemak (g)</label>
                <input type="number" class="form-control" name="kadar_lemak" required>
            </div>
            <!-- <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Produk (opsional)</label>
                <input type="file" class="form-control" name="gambar" accept="image/*">
            </div> -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../index.php?halaman=data_minuman" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>