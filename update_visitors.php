<?php
// Nama file untuk menyimpan statistik
$file = "visitor_count.txt";

// Periksa apakah file sudah ada
if (!file_exists($file)) {
    file_put_contents($file, "0"); // Buat file dengan isi 0 jika belum ada
}

// Periksa apakah cookie sudah disetel
if (!isset($_COOKIE['has_visited'])) {
    // Cookie belum disetel, tambahkan visitor baru
    $visitor_count = (int)file_get_contents($file); // Baca jumlah pengunjung saat ini
    $visitor_count++; // Tambahkan jumlah pengunjung
    file_put_contents($file, $visitor_count); // Simpan jumlah baru ke file

    // Atur cookie untuk pengunjung baru (berlaku selama 24 jam)
    setcookie('has_visited', 'yes', time() + (24 * 60 * 60));
}

// Tampilkan jumlah pengunjung
echo file_get_contents($file);
?>
