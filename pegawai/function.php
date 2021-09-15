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
    $pegawais = [];
    // Looping untuk mengambil semua data pegawai
    while ($pegawai = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $pegawais[] = $pegawai;
    }
    // Return function berupa array $pegawai
    return $pegawais;
}

// Fungsi tambah pegawai
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $nama_pegawai   = htmlspecialchars($post["nama_pegawai"]);
    $nohp           = htmlspecialchars($post["nohp"]);
    $alamat         = htmlspecialchars($post["alamat"]);
    $jk             = htmlspecialchars($post["jk"]);

    // Susun query insert
    $query = "INSERT INTO pegawai VALUES ('', '$nama_pegawai', '$nohp', '$alamat', '$jk')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus pegaawi
function hapus($id)
{
    // Ambil variabel conn
    global $conn;

    // Susub query delete
    $query = "DELETE FROM pegawai WHERE id = '$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi edit pegawai
function edit($post)
{
    // Ambil variable conn
    global $conn;

    // Ambil data dari form
    $id             = $post["id"];
    $nama_pegawai   = htmlspecialchars($post["nama_pegawai"]);
    $nohp           = htmlspecialchars($post["nohp"]);
    $alamat         = htmlspecialchars($post["alamat"]);
    $jk             = htmlspecialchars($post["jk"]);

    // Susun query update
    $query = "UPDATE pegawai SET nama_pegawai='$nama_pegawai', nohp='$nohp', alamat='$alamat', jk='$jk' WHERE id='$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function
    return mysqli_affected_rows($conn);
}
