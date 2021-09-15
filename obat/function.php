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
    $obats = [];
    // Looping untuk mengambil semua data obat
    while ($obat = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $obat
        $obats[] = $obat;
    }
    // Return function berupa array $obat
    return $obats;
}

// Fungsi tambah obat
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $nama_obat  = htmlspecialchars($post["nama_obat"]);
    $jenis      = htmlspecialchars($post["jenis"]);
    $satuan     = htmlspecialchars($post["satuan"]);
    $harga      = htmlspecialchars($post["harga"]);
    $stok       = htmlspecialchars($post["stok"]);

    // Susun query insert
    $query = "INSERT INTO obat VALUES ('', '$nama_obat', '$jenis', '$satuan', '$harga', '$stok')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus obat
function hapus($id)
{
    // Ambil variabel conn
    global $conn;

    // Susub query delete
    $query = "DELETE FROM obat WHERE id = '$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi edit obat
function edit($post)
{
    // Ambil variable conn
    global $conn;

    // Ambil data dari form
    $id         = $post["id"];
    $nama_obat  = htmlspecialchars($post["nama_obat"]);
    $jenis      = htmlspecialchars($post["jenis"]);
    $satuan     = htmlspecialchars($post["satuan"]);
    $harga      = htmlspecialchars($post["harga"]);
    $stok       = htmlspecialchars($post["stok"]);

    // Susun query update
    $query = "UPDATE obat SET nama_obat='$nama_obat', jenis='$jenis', satuan='$satuan', harga='$harga', stok='$stok' WHERE id='$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function
    return mysqli_affected_rows($conn);
}
