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
    $pemdaftarans = [];
    // Looping untuk mengambil semua data pasien
    while ($pemdaftaran = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $pemdaftarans[] = $pemdaftaran;
    }
    // Return function berupa array $pegawai
    return $pemdaftarans;
}

// Fungsi tambah pegawai
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id_tindakan    = htmlspecialchars($post["id_tindakan"]);
    $id_wilayah     = htmlspecialchars($post["id_wilayah"]);
    $id_pegawai     = htmlspecialchars($post["id_pegawai"]);
    $nama_pasien    = htmlspecialchars($post["nama_pasien"]);
    $jk             = htmlspecialchars($post["jk"]);
    $alamat         = htmlspecialchars($post["alamat"]);
    $nohp           = htmlspecialchars($post["nohp"]);
    $tanggal        = date('Y-m-d');
    $keluhan        = htmlspecialchars($post["keluhan"]);
    $status         = "Dalam pemeriksaan";

    // Susun query insert
    $query = "INSERT INTO pendaftaran VALUES ('', '$id_tindakan', '$id_wilayah', '$id_pegawai', '$nama_pasien', '$jk', '$alamat', '$nohp', '$tanggal', '$keluhan', '$status')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}
