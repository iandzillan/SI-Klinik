<?php
// Jalankan session
session_start();

// Panggil koneksi.php
require "../koneksi.php";

// Fungsi menyeleksi data
function select($query)
{
    // Ambil variabel $conn
    global $conn;
    // Jalankan query
    $sql = mysqli_query($conn, $query);
    // Siapkan array kosong
    $pasiens = [];
    // Looping untuk mengambil semua data pasien
    while ($pasien = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $pasiens[] = $pasien;
    }
    // Return function berupa array $pegawai
    return $pasiens;
}
