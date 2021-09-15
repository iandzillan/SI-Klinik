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
    $users = [];
    // Looping untuk mengambil semua data user
    while ($user = mysqli_fetch_assoc($sql)) {
        // Masukkan data ke array $pegawai
        $users[] = $user;
    }
    // Return function berupa array $pegawai
    return $users;
}

// Fungsi tambah user
function tambah($post)
{
    // Ambil variabel conn
    global $conn;

    // Ambil data dari form
    $id_pegawai = htmlspecialchars($post["id_pegawai"]);
    $username   = htmlspecialchars($post["username"]);
    $password   = htmlspecialchars($post["password"]);
    $confpass   = htmlspecialchars($post["confpass"]);
    $level      = htmlspecialchars($post["level"]);

    // Cek apakah username sudah digunakan
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        // Jika ada, beri pesan bahwa username sudah terpakai
        echo "
            <script>
                alert('Username sudah digunakan');
            </script>
        ";

        // return function berupa false
        return false;
    }

    // Jika username belum ada, cek apakah password dan confpass sama
    if ($password !== $confpass) {
        // Jika tidak sama, beri pesan bahwa password tidak sama
        echo "
            <script>
                alert('Password yang dimasukkan tidak sesuai');
            </script>
        ";

        // return function berupa false
        return false;
    }

    // Jika lolos pengecekan, ekripsi password
    $passwordfix = md5($password);

    // Susun query insert
    $query = "INSERT INTO user VALUES ('', '$id_pegawai', '$username', '$passwordfix', '$level')";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function 
    return mysqli_affected_rows($conn);
}

// Fungsi hapus user
function hapus($id)
{
    // Ambil variabel conn
    global $conn;

    // Susub query delete
    $query = "DELETE FROM user WHERE id = '$id'";

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
    $id         = $post["id"];
    $password   = htmlspecialchars($post["password"]);
    $confpass   = htmlspecialchars($post["confpass"]);
    $level      = htmlspecialchars($post["level"]);

    // Jika username belum ada, cek apakah password dan confpass sama
    if ($password !== $confpass) {
        // Jika tidak sama, beri pesan bahwa password tidak sama
        echo "
            <script>
                alert('Password yang dimasukkan tidak sesuai');
            </script>
        ";

        // return function berupa false
        return false;
    }

    // Jika lolos pengecekan, ekripsi password
    $passwordfix = md5($password);

    // Susun query update
    $query = "UPDATE user SET password='$passwordfix', level='$level' WHERE id='$id'";

    // Jalankan query
    mysqli_query($conn, $query);

    // Return function
    return mysqli_affected_rows($conn);
}
