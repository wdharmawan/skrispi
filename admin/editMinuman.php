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

<body>

    <?php
    session_start();
    include 'koneksi.php'; // Pastikan file koneksi di folder admin

    // Cek login admin
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
        header("Location: login.php");
        exit;
    }

    // Ambil ID minuman
    $id = $_GET['id'] ?? 0;
    if ($id == 0) {
        echo "ID tidak valid.";
        exit;
    }

    // Ambil data lama
    $query = mysqli_query($koneksi, "SELECT * FROM data_minuman WHERE id_minuman = $id");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }

    // Proses update
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama_minuman'];
        $kategori = $_POST['kategori_kelompok'];
        $ukuran = $_POST['ukuran_porsi'];
        $jenis = $_POST['jenis_pemanis'];
        $gula = $_POST['kadar_gula'];
        $garam = $_POST['kadar_garam'];
        $lemak = $_POST['kadar_lemak'];

        $update = mysqli_query($koneksi, "UPDATE data_minuman SET 
        nama_minuman='$nama',
        kategori_kelompok='$kategori',
        ukuran_porsi='$ukuran',
        jenis_pemanis='$jenis',
        kadar_gula='$gula',
        kadar_garam='$garam',
        kadar_lemak='$lemak'
        WHERE id_minuman=$id
    ");

        if ($update) {
            echo "<script>alert('Data berhasil diubah'); window.location='../index.php?halaman=data_minuman';</script>";
        } else {
            echo "Gagal mengubah data: " . mysqli_error($koneksi);
        }
    }
    ?>

        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Data Minuman</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama Minuman</label>
                            <input type="text" name="nama_minuman" class="form-control" value="<?= $data['nama_minuman'] ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Kategori Kelompok</label>
                            <input type="text" name="kategori_kelompok" class="form-control" value="<?= $data['kategori_kelompok'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ukuran Porsi (ml)</label>
                            <input type="number" name="ukuran_porsi" class="form-control" value="<?= $data['ukuran_porsi'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Pemanis</label>
                            <input type="text" name="jenis_pemanis" class="form-control" value="<?= $data['jenis_pemanis'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kadar Gula (g)</label>
                            <input type="number" step="0.01" name="kadar_gula" class="form-control" value="<?= $data['kadar_gula'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kadar Garam (mg)</label>
                            <input type="number" step="0.01" name="kadar_garam" class="form-control" value="<?= $data['kadar_garam'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kadar Lemak (g)</label>
                            <input type="number" step="0.01" name="kadar_lemak" class="form-control" value="<?= $data['kadar_lemak'] ?>" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="../index.php?halaman=data_minuman" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>