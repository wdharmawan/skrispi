<?php 

$host ="localhost:8111";
$user ="root";
$pass ="";
$db ="ptm";

// untuk mengkoneksikan antara php dan database
$koneksi = mysqli_connect($host, $user, $pass);
if ($koneksi) {
    $buka=mysqli_select_db($koneksi, $db);
    // echo "terhubung";
    if (!$buka) {
        echo "database ";
    }
}else {
    echo " tidak hubung";
}

?>