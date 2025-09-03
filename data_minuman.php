<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Minuman</title>
    <link rel="stylesheet" href="./asset/css/style3.css">
    <link rel="stylesheet" href="./asset/css/style2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="main-content">
        <div class="container-table">
            <div class="container mt-4">
                <!-- Judul dan tombol tambah (hanya tampil jika admin login) -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Data Minuman</h3>

                    <?php if (isset($_SESSION['admin'])) : ?>
                        <!-- Tombol tambah artikel untuk admin -->
                        <a href="./admin/tambahMinuman.php" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Tambah Minuman
                        </a>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ukuran Porsi (ml)</th>
                                <th>Jenis Pemanis</th>
                                <th>Kadar Gula (g)</th>
                                <th>Kadar Garam (mg)</th>
                                <th>Kadar Lemak (g)</th>
                                <th>Detail</th>
                                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // Koneksi ke database
                            include "./admin/koneksi.php";


                            // Fungsi untuk memformat angka agar pakai titik sebagai pemisah ribuan dan koma untuk desimal
                            function format_angka($angka)
                            {
                                if (!is_numeric($angka)) return $angka;
                                return (floor($angka) == $angka) ? number_format($angka, 0, ',', '.') : rtrim(rtrim(number_format($angka, 2, ',', '.'), '0'), ',');
                            }

                            $jumlahDataPerHalaman = 25; // Banyak data per halaman
                            $halamanAktif = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Halaman saat ini
                            $dataAwal = ($halamanAktif - 1) * $jumlahDataPerHalaman;  // Indeks awal data yang ditampilkan

                            // Trik awal WHERE agar bisa ditambah kondisi pakai AND
                            $sqlWhere = "WHERE 1=1";
                            // Untuk mempertahankan link saat pagination
                            $baseUrl = "index.php?halaman=data_minuman";

                            if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
                                $keyword = mysqli_real_escape_string($koneksi, $_GET['search']);
                                $sqlWhere .= " AND nama_minuman LIKE '%$keyword%'"; // Filter berdasarkan nama merk
                                $baseUrl .= "&search=" . urlencode($keyword);  // Tambahkan ke URL untuk pagination
                            }

                            if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
                                $kategori = mysqli_real_escape_string($koneksi, $_GET['kategori']);
                                $sqlWhere .= " AND kategori_kelompok LIKE '%$kategori%'";
                                $baseUrl .= "&kategori=" . urlencode($kategori);
                            }

                            $sqlTotal = "SELECT COUNT(*) AS total FROM data_minuman $sqlWhere";
                            $totalData = $koneksi->query($sqlTotal)->fetch_assoc()['total'];
                            $totalHalaman = ceil($totalData / $jumlahDataPerHalaman);

                            $sql = "SELECT * FROM data_minuman $sqlWhere LIMIT $dataAwal, $jumlahDataPerHalaman";
                            $result = $koneksi->query($sql);



                            ?>

                            <?php $no = $dataAwal + 1;
                            while ($data = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama_minuman'] ?></td>
                                    <td><?= format_angka($data['ukuran_porsi']) ?></td>
                                    <td><?= $data['jenis_pemanis'] ?></td>
                                    <td><?= format_angka($data['kadar_gula']) ?></td>
                                    <td><?= format_angka($data['kadar_garam']) ?></td>
                                    <td><?= format_angka($data['kadar_lemak']) ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal<?= $data['id_minuman'] ?>">Detail</button>
                                    </td>

                                    <!-- aksi admin jika sudah  login -->
                                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true): ?>
                                        <td>
                                            <a href="./admin/editMinuman.php?id=<?= $data['id_minuman'] ?>" class="btn btn-warning btn-sm mb-1"><i class="bi bi-pencil-square"></i> Ubah</a>
                                            <a href="./admin/hapusMinuman.php?id=<?= $data['id_minuman'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');"><i class="bi bi-trash"></i> Hapus</a>
                                        </td>
                                    <?php endif; ?>

                                </tr>

                                <?php
                                // Tentukan kelas warna berdasarkan status keamanan
                                $warna_status = 'bg-secondary';
                                if ($data['status_keamanan'] === 'Aman') {
                                    $warna_status = 'bg-success';
                                } elseif ($data['status_keamanan'] === 'Perlu Waspada') {
                                    $warna_status = 'bg-warning text-dark';
                                } elseif ($data['status_keamanan'] === 'Risiko Tinggi') {
                                    $warna_status = 'bg-danger';
                                }
                                ?>

                                <div class="modal fade" id="detailModal<?= $data['id_minuman'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Minuman: <?= $data['nama_merk'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <p><strong>Nama:</strong> <?= $data['nama_minuman'] ?></p>
                                                <p><strong>Kelompok:</strong> <?= $data['kategori_kelompok'] ?></p>
                                                <p><strong>Jenis Pemanis:</strong> <?= $data['jenis_pemanis'] ?></p>
                                                <!-- <p><strong>Ukuran Porsi:</strong> <?= format_angka($data['ukuran_porsi']) ?> ml</p> -->
                                                <p><strong>Gula Per 100 mL:</strong> <?= format_angka($data['gula_per_100mL']) ?> g</p>
                                                <p><strong>Garam Per 100 mL:</strong> <?= format_angka($data['garam_per_100mL']) ?> mg</p>
                                                <p><strong>Lemak Per 100 mL:</strong> <?= $data['lemak_per_100mL'] ?> g</p>
                                                <p>
                                                    <strong>Status Keamanan:</strong><span class="badge <?= $warna_status ?> fs-6"> <?= $data['status_keamanan'] ?></span>
                                                </p>
                                                <p><strong>Status Rinci:</strong> <?= $data['status_rinci'] ?></p>
                                                <!-- <div class="text-center">
                                                    <strong>Gambar Produk:</strong><br>
                                                    <img src="./asset/image/<?= $data['gambar_produk'] ?>" class="img-fluid mt-2" style="max-width: 150px;">
                                                </div> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="mt-3 text-center">
                        <?php if ($halamanAktif > 1): ?>
                            <a href="<?= $baseUrl ?>&page=1">
                                << </a> &nbsp;
                                    <a href="<?= $baseUrl ?>&page=<?= $halamanAktif - 1 ?>">
                                        < </a> &nbsp;
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
                                            <a href="<?= $baseUrl ?>&page=<?= $i ?>" <?= ($i == $halamanAktif) ? 'style="font-weight:bold;"' : '' ?>><?= $i ?></a> &nbsp;
                                        <?php endfor; ?>

                                        <?php if ($halamanAktif < $totalHalaman): ?>
                                            <a href="<?= $baseUrl ?>&page=<?= $halamanAktif + 1 ?>">></a> &nbsp;
                                            <a href="<?= $baseUrl ?>&page=<?= $totalHalaman ?>">>></a>
                                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>