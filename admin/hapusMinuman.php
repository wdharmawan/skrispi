<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

// Ambil ID
$id = $_GET['id'] ?? 0;

if ($id > 0) {
    $hapus = mysqli_query($koneksi, "DELETE FROM data_minuman WHERE id_minuman = $id");
    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='../data_minuman.php';</script>";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak valid.";
}

?>

    
</body>
</html>