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
    $tindakans = [];
    // Looping untuk mengambil semua data tindakan
    while ($tindakan = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $tindakan
        $tindakans[] = $tindakan;
    }
    // Return function berupa array $tindakans
    return $tindakans;
}

// Fungsi tambah tindakan
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $tindakan   = htmlspecialchars($post["tindakan"]);
    $harga      = htmlspecialchars($post["harga"]);

    // Susun query insert
    $query = "INSERT INTO tindakan VALUES ('', '$tindakan', '$harga')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus tindakan
function hapus($id)
{
    // Ambil variabel conn
    global $conn;

    // Susub query delete
    $query = "DELETE FROM tindakan WHERE id = '$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi edit tindakan
function edit($post)
{
    // Ambil variable conn
    global $conn;

    // Ambil data dari form
    $id         = $post["id"];
    $tindakan   = htmlspecialchars($post["tindakan"]);
    $harga      = htmlspecialchars($post["harga"]);

    // Susun query update
    $query = "UPDATE tindakan SET tindakan='$tindakan', harga='$harga' WHERE id='$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function
    return mysqli_affected_rows($conn);
}
