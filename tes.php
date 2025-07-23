

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- link css -->
    <link rel="stylesheet" href="./asset/css/style.css">
    <!-- link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-info py-2">
        <div class="container-fluid justify-content-center">
            <!-- <form class="d-flex search-form w-100" role="search" action="data_minuman.php" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Cari minuman..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
            </form> -->
            <form class="d-flex w-100 px-2" role="search" action="data_minuman.php" method="GET">
                <input class="form-control me-2 flex-grow-1" type="search" name="search" placeholder="Cari minuman..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
            </form>

        </div>
    </nav>

    <div class="content">
        <div class="sidebar collapsed" id="sidebar">

            <div class="btn-toggler">
                <button class="navbar-toggler" type="button" id="togglerButton">
                    <span class="toggler-icon"><i class="bi bi-text-left"></i></span>
                </button>
            </div>

            <div class="header">
                <a class="nav-link link-header" href="index.php">
                    <!-- <img class="logo-menu w-25" src="./asset/image/softdrinks.png" alt=""> -->
                    <span class="name-logo">SweetCheck</span>
                </a>
            </div>

            <div class="logo">
                <img class="logo-menu" src="./asset/image/softdrinks.png" alt="">
            </div>

            <div class="navbar-side">
                <nav class="nav flex-column">
                    <a class="nav-link" href="index.php">
                        <span class="icon">
                            <i class="bi bi-house-fill"></i>
                        </span>
                        <span class="text-sidebar">Beranda</span>
                    </a>
                    <a class="nav-link" href="index.php?halaman=data_minuman">
                        <span class="icon">
                            <i class="bi bi-measuring-cup-fill"></i>
                        </span>
                        <span class="text-sidebar">Data Minuman</span>
                    </a>

                    <!-- menu sidebar dengan drpdown -->
                    <a class="nav-link" href="index.php?halaman=filter" data-bs-toggle="collapse" data-bs-target="#submenu" aria-expanded="false" aria-controls="submenu">
                        <span class="icon">
                            <i class="bi bi-sort-down"></i>
                        </span>
                        <span class="text-sidebar">Filter<i class="bi bi-caret-down"></i> </span>
                    </a>

                    <!-- isi dropdown -->
                    <div class="sub-menu collapse" id="submenu">
                        <a class="nav-link" href="#">
                            <span class="text-dropdown">Rendah</span>
                        </a>
                        <a class="nav-link" href="#">
                            <span class="text-dropdown">Sedang</span>
                        </a>
                        <a class="nav-link" href="#">
                            <span class="text-dropdown">Tinggi</span>
                        </a>
                    </div>
                    <!-- akhir isi dropdown -->

                    <a class="nav-link" href="index.php?halaman=artikel">
                        <span class="icon">
                            <i class="bi bi-journals"></i>
                        </span>
                        <span class="text-sidebar">Artikel</span>
                    </a>
                </nav>
            </div>
        </div>
        <!-- Akhir Sidebar -->
    </div>


     <div class="main">
        <div class="main-home">

            <?php
            if (isset($_GET["halaman"])) { 

                // jika variabel halaman sama dengan data_minuman makan akan ke halaman
                if ($_GET["halaman"] == "data_minuman") {
                    include "data_minuman.php";
                }

                // jika variabel halaman sama dengan pesanan makan akan ke halaman 
                else if ($_GET["halaman"] == "filter") {
                    include "filter.php";
                }

                // jika variabel halaman sama dengan layanan makan akan ke halaman 
                else if ($_GET["halaman"] == "artikel") {
                    include "artikel.php";
                }

                // jika variabel halaman sama dengan detail makan akan ke halaman detail 
                else if ($_GET["halaman"] == "detail") {
                    include "detail.php";
                }
            } else {
                include "home.php";
            }

             ?>
         </div>
     </div>


//     <!-- <section class="form-container">
//     <form method="post" enctype="multipart/form-data">
//         <div class="form-group">
//             <label for="">Metode Bayar</label>
//             <input type="text" class="form-control" name="bayar">
//         </div>

//         <button class="btn btn-primary" name="simpan">Simpan</button>
//     </form>
// </section> -->


    <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html> 