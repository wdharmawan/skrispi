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
    include 'koneksi.php'; // Pastikan path ke file koneksi benar

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
        $ukuran = $_POST['ukuran_porsi'];
        $jenis = $_POST['jenis_pemanis'];
        $gula = $_POST['kadar_gula'];
        $garam = $_POST['kadar_garam'];
        $lemak = $_POST['kadar_lemak'];

        $update = mysqli_query($koneksi, "UPDATE data_minuman SET 
        nama_minuman='$nama',
        ukuran_porsi='$ukuran',
        jenis_pemanis='$jenis',
        kadar_gula='$gula',
        kadar_garam='$garam',
        kadar_lemak='$lemak'
        WHERE id_minuman=$id
    ");

        if ($update) {
            echo "<script>alert('Data berhasil diubah'); window.location='../data_minuman.php';</script>";
        } else {
            echo "Gagal mengubah data: " . mysqli_error($koneksi);
        }
    }
    ?>

    <h2>Edit Data Minuman</h2>
    <form method="post">
        <label>Nama Minuman:</label><br>
        <input type="text" name="nama_minuman" value="<?= $data['nama_minuman'] ?>"><br>

        <label>Ukuran Porsi (ml):</label><br>
        <input type="number" name="ukuran_porsi" value="<?= $data['ukuran_porsi'] ?>"><br>

        <label>Jenis Pemanis:</label><br>
        <input type="text" name="jenis_pemanis" value="<?= $data['jenis_pemanis'] ?>"><br>

        <label>Kadar Gula (g):</label><br>
        <input type="number" step="0.01" name="kadar_gula" value="<?= $data['kadar_gula'] ?>"><br>

        <label>Kadar Garam (mg):</label><br>
        <input type="number" step="0.01" name="kadar_garam" value="<?= $data['kadar_garam'] ?>"><br>

        <label>Kadar Lemak (g):</label><br>
        <input type="number" step="0.01" name="kadar_lemak" value="<?= $data['kadar_lemak'] ?>"><br>

        <br>
        <button type="submit" name="simpan">Simpan Perubahan</button>
    </form>


     <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>