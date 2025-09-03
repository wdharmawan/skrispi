<?php
include "./admin/koneksi.php";

// --- 2. AMBIL DATA YANG BELUM DIANALISIS ---
// Mengambil data yang salah satu statusnya masih kosong
$sql = "SELECT * FROM data_minuman WHERE gula_per_100mL IS NULL";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    echo "Ditemukan " . $result->num_rows . " data untuk dianalisis.<br><br>";

    while($row = $result->fetch_assoc()) {
        $id = $row['id_minuman'];
        $nama_merk = $row['nama_merk'];

        // Ambil dan bersihkan data mentah
        $gula = floatval(preg_replace('/[^0-9.,]/', '', $row['kadar_gula']));
        $garam = floatval(preg_replace('/[^0-9.,]/', '', $row['kadar_garam']));
        $lemak = floatval(preg_replace('/[^0-9.,]/', '', $row['kadar_lemak']));
        $ukuran_porsi = floatval(preg_replace('/[^0-9.,]/', '', $row['ukuran_porsi']));
        
        // Hitung nilai per 100ml
        if ($ukuran_porsi > 0) {
            $gula_per_100mL = ($gula / $ukuran_porsi) * 100;
            $garam_per_100mL = ($garam / $ukuran_porsi) * 100;
            $lemak_per_100mL = ($lemak / $ukuran_porsi) * 100;
        } else {
            $gula_per_100mL = 0; $garam_per_100mL = 0; $lemak_per_100mL = 0;
        }

        // --- 3. LOGIKA UNTUK KEDUA STATUS ---

        // A. Tentukan Status Keamanan (Aman, Waspada, Risiko Tinggi)
        $status_keamanan = 'Aman'; // Default
        if (($gula_per_100mL > 11.25) || ($garam_per_100mL > 600) || ($lemak_per_100mL > 5)) {
            $status_keamanan = 'Risiko Tinggi';
        } elseif (($gula_per_100mL > 2.5) || ($garam_per_100mL > 120) || ($lemak_per_100mL > 1.5)) {
            $status_keamanan = 'Perlu Waspada';
        }

        // B. Tentukan Status Rinci (Gula Tinggi, Garam Tinggi, dll.)
        $pelanggaran_rinci = [];
        if ($gula_per_100mL > 2.5) { // Batas terendah untuk mulai dianggap "tidak aman"
            if($gula_per_100mL > 11.25) {$pelanggaran_rinci[] = 'Gula Sangat Tinggi';}
            else {$pelanggaran_rinci[] = 'Gula Sedang';}
        }
        if ($garam_per_100mL > 120) {
            if($garam_per_100mL > 600) {$pelanggaran_rinci[] = 'Garam Sangat Tinggi';}
            else {$pelanggaran_rinci[] = 'Garam Sedang';}
        }
        if ($lemak_per_100mL > 1.5) {
            if($lemak_per_100mL > 5) {$pelanggaran_rinci[] = 'Lemak Sangat Tinggi';}
            else {$pelanggaran_rinci[] = 'Lemak Sedang';}
        }
        
        $status_rinci = 'Semua Aman';
        if (!empty($pelanggaran_rinci)) {
            $status_rinci = implode(', ', $pelanggaran_rinci);
        }

        // --- 4. PERBARUI BARIS DI DATABASE ---
        $update_sql = "UPDATE data_minuman SET 
                        gula_per_100mL = ?, 
                        garam_per_100mL = ?, 
                        lemak_per_100mL = ?, 
                        status_keamanan = ?,
                        status_rinci = ?
                      WHERE id_minuman = ?";

        $stmt = $koneksi->prepare($update_sql);
        // 'dddssi' berarti: double, double, double, string, string, integer
        $stmt->bind_param("dddssi", $gula_per_100mL, $garam_per_100mL, $lemak_per_100mL, $status_keamanan, $status_rinci, $id);
        
        if ($stmt->execute()) {
            echo "Data '$nama_merk' diperbarui -> Status: **$status_keamanan** | Rincian: $status_rinci<br>";
        } else {
            echo "Error saat memperbarui data '$nama_merk': " . $stmt->error . "<br>";
        }
        $stmt->close();
    }
} else {
    echo "Tidak ada data baru untuk dianalisis.";
}

$koneksi->close();

?>