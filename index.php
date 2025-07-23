<?php
session_start();

// if(!isset($_SESSION['admin'])) {
//     header('location:login.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="./asset/css/style.css"> -->
  <link rel="stylesheet" href="./asset/css/style3.css">
  <!-- link Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="name-logo">SweetCheck</div>
    <div class="logo">
      <img src="./asset/image/softdrinks.png" alt="Logo">
    </div>
    <nav class="nav flex-column">
      <a class="nav-link" href="index.php"><i class="bi bi-house-fill"></i> Beranda</a>
      <a class="nav-link" href="index.php?halaman=data_minuman"><i class="bi bi-measuring-cup-fill"></i> Data Minuman</a>

      <!-- menu sidebar dengan drpdown -->
      <!-- Menu Kategori -->
      <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#kategoriMenu" aria-expanded="false" aria-controls="kategoriMenu">
        <i class="bi bi-tags-fill"></i>
        <span class="text-sidebar">Kategori <i class="bi bi-caret-down"></i></span>
      </a>

      <div class="sub-menu collapse" id="kategoriMenu">
        <a class="nav-link" href="index.php?halaman=data_minuman&kategori=energi">
          <span class="text-dropdown">Minuman Energi</span>
        </a>
        <a class="nav-link" href="index.php?halaman=data_minuman&kategori=teh">
          <span class="text-dropdown">Teh</span>
        </a>
        <a class="nav-link" href="index.php?halaman=data_minuman&kategori=kopi">
          <span class="text-dropdown">Kopi</span>
        </a>
        <a class="nav-link" href="index.php?halaman=data_minuman&kategori=karbonasi">
          <span class="text-dropdown">Soda</span>
        </a>
        <a class="nav-link" href="index.php?halaman=data_minuman&kategori=jus">
          <span class="text-dropdown">Jus</span>
        </a>
      </div>
      <!-- akhir isi dropdown -->

      <a class="nav-link" href="index.php?halaman=artikel"><i class="bi bi-journals"></i> Artikel</a>

    </nav>
  </div>

  <!-- Navbar -->
  <nav class="navbar py-2">
    <div class="container-fluid">
      <form class="search-form w-100" role="search" action="index.php" method="GET">
         <!-- Menentukan halaman tujuan adalah data_minuman -->
        <input type="hidden" name="halaman" value="data_minuman">

         <!-- Input pencarian -->
        <input class="form-control" type="search" name="search" placeholder="Cari minuman..." aria-label="Search">

        <!-- Tombol submit -->
        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </nav>



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


    <!-- link Js Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>