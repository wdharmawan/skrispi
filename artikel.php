<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link css -->
    <link rel="stylesheet" href="./asset/css/style3.css">
    <link rel="stylesheet" href="./asset/css/style2.css">
    <!-- link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="main-content">
        <!-- <div class="container-table">
            <h3>Artikel</h3>
        </div> -->

        <?php
        include "./admin/koneksi.php";

        $query = mysqli_query($koneksi, "SELECT * FROM data_artikel ORDER BY tanggal DESC");
        ?>

        <div class="container mt-4">
            <h3 class="mb-4">Artikel Kesehatan</h3>
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Gambar bisa ditambahkan jika kamu punya kolom gambar -->
                            <!-- <img src="uploads/artikel/<?= $row['gambar'] ?? 'default.jpg' ?>" class="card-img-top" alt="Gambar Artikel"> -->

                            <div class="card-body">
                                <h5 class="card-title"><?= $row['judul'] ?></h5>
                                <small class="text-muted"><?= date("d M Y", strtotime($row['tanggal'])) ?></small>
                                <p class="card-text mt-2">
                                    <?= substr(strip_tags($row['konten']), 0, 200) ?>...
                                </p>
                                <a href="detail_artikel.php?id=<?= $row['id_artikel'] ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>



    </div>

</body>

</html>