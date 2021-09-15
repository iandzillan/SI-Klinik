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
    $pemeriksaans = [];
    // Looping untuk mengambil semua data pasien
    while ($pemeriksaan = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $pemeriksaans[] = $pemeriksaan;
    }
    // Return function berupa array $pegawai
    return $pemeriksaans;
}

// Fungsi input obat
function tambahObat($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id_pendaftaran = htmlspecialchars($post["id_pendaftaran"]);
    $id_obat        = htmlspecialchars($post["id_obat"]);

    // Susun query insert
    $query = "INSERT INTO tmp_obat VALUES ('', '$id_pendaftaran', '$id_obat')";

    // Ambil data stok obat
    $stok = select("SELECT stok FROM obat WHERE id='$id_obat'")[0]["stok"];
    $stok = (int)$stok;
    $stokAkhir = $stok - 1;

    // Susun query untuk update stok obat
    $queryStok = "UPDATE obat SET stok='$stokAkhir' WHERE id='$id_obat'";

    // Jalankan query
    mysqli_query($conn, $query);
    mysqli_query($conn, $queryStok);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus obat
function hapusObat($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id = htmlspecialchars($post["id"]);
    $id_obat = htmlspecialchars($post["id_obat"]);

    // Susun query
    $query = "DELETE FROM tmp_obat WHERE id = '$id'";

    // Ambil data stok obat
    $stok = select("SELECT stok FROM obat WHERE id='$id_obat'")[0]["stok"];
    $stok = (int)$stok;
    $stokAkhir = $stok + 1;

    // Susun query untuk update stok obat
    $queryStok = "UPDATE obat SET stok='$stokAkhir' WHERE id='$id_obat'";

    // Jalankan query
    mysqli_query($conn, $query);
    mysqli_query($conn, $queryStok);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi input hasil pemeriksaan
function hasil($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id_pendaftaran = ($post["id_pendaftaran"]);
    $id_obat        = ($post["id_obat"]);
    $id_tindakan    = ($post["id_tindakan"]);
    $id_pegawai     = ($post["id_pegawai"]);

    // Hitung jumlah obat yang diberikan pada pasien
    $countObat = count($id_obat);

    // Lakukan perulangan sebanyak jumlah obat
    for ($i = 0; $i < $countObat; $i++) {
        // Jalankan query insert ke tabel hasil_periksa
        mysqli_query($conn, "INSERT INTO hasil_periksa VALUES('', '$id_pendaftaran', '$id_obat[$i]', '$id_tindakan', '$id_pegawai')");
        // Jalankan query delete untuk menghapus data dari tmp_obat
        mysqli_query($conn, "DELETE FROM tmp_obat WHERE id_pendaftaran='$id_pendaftaran'");
        // Jalankan query update untuk memperbarui status pasien
        mysqli_query($conn, "UPDATE pendaftaran SET status='Proses pembayaran' WHERE id='$id_pendaftaran'");
    }

    // Return function
    return mysqli_affected_rows($conn);
}
