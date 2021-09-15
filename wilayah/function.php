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
    $wilayahs = [];
    // Looping untuk mengambil semua data wilayah
    while ($wilayah = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $wilayah
        $wilayahs[] = $wilayah;
    }
    // Return function berupa array $wilayahs
    return $wilayahs;
}

// Fungsi tambah tindakan
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $provinsi   = htmlspecialchars($post["provinsi"]);
    $kota       = htmlspecialchars($post["kota"]);
    $kecamatan  = htmlspecialchars($post["kecamatan"]);
    $kelurahan  = htmlspecialchars($post["kelurahan"]);

    // Susun query insert
    $query = "INSERT INTO wilayah VALUES ('', '$provinsi', '$kota', '$kecamatan', '$kelurahan')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus wilayah
function hapus($id)
{
    // Ambil variabel conn
    global $conn;

    // Susub query delete
    $query = "DELETE FROM wilayah WHERE id = '$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi edit wilayah
function edit($post)
{
    // Ambil variable conn
    global $conn;

    // Ambil data dari form
    $id         = $post["id"];
    $provinsi   = htmlspecialchars($post["provinsi"]);
    $kota       = htmlspecialchars($post["kota"]);
    $kecamatan  = htmlspecialchars($post["kecamatan"]);
    $kelurahan  = htmlspecialchars($post["kelurahan"]);

    // Susun query update
    $query = "UPDATE wilayah SET provinsi='$provinsi', kota='$kota', kecamatan='$kecamatan', kelurahan='$kelurahan' WHERE id='$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function
    return mysqli_affected_rows($conn);
}
