<?php
// Panggil koneksi.php
require "function.php";

// Ambil data user
$pegawai = $_SESSION["id_pegawai"];
$user = mysqli_query($conn, "SELECT * FROM user A LEFT JOIN pegawai B ON B.id = A.id_pegawai WHERE A.id_pegawai = '$pegawai'");
$user = mysqli_fetch_assoc($user);

// Cek apakah session kosong
if (!isset($_SESSION["pegawai"])) {
    // Jika kosong, beri pesan untuk login dan alihkan ke halaman login
    echo "
        <script>
            confirm('Silahkan login terlebih dahulu');
            document.location='login.php';
        </script>
    ";
    // Hentikan script
    exit;
}

// Ambil data id dari url
$id = $_GET["id"];

// Cek apakah function hapus berhasil dijalankan
if (hapus($id) > 0) {
    // Jika berhasil, beri pesan data berhasil di hapus
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href= '../tindakan/index.php';
        </script>
    ";
} else {
    // Jika gagal, beri pesan data gagal di hapus
    echo "
        <script>
            alert('Data gagal dihapus');
            document.location.href= '../tindakan/index.php';
        </script>
    ";
}
