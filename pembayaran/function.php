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
    $pembayarans = [];
    // Looping untuk mengambil semua data pasien
    while ($pembayaran = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $pembayarans[] = $pembayaran;
    }
    // Return function berupa array $pegawai
    return $pembayarans;
}

// Fungsi input pembayran
function bayar($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id_pendaftaran = htmlspecialchars($post["id_pendaftaran"]);
    $id_tindakan    = htmlspecialchars($post["id_tindakan"]);
    $id_pegawai     = htmlspecialchars($post["id_pegawai"]);
    $bayar          = htmlspecialchars($post["pasienBayar"]);

    // Susun query untuk memasukkan data ke tabel pembayaran
    $query = "INSERT INTO pembayaran VALUES('', '$id_pendaftaran', '$id_tindakan', '$id_pegawai', '$bayar')";

    // Susun query untuk update status pasien
    $status = "UPDATE pendaftaran SET status='Transaksi Selesai' WHERE id='$id_pendaftaran'";

    // Jalankan query
    mysqli_query($conn, $query);
    mysqli_query($conn, $status);

    // Return function
    return mysqli_affected_rows($conn);
}
