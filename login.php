<?php
// Jalankan session
session_start();
// Panggil koneksi.php
require "koneksi.php";

// Cek apakah login sudah ditekan
if (isset($_POST["login"])) {
    // Jika sudah, cek apakah username dan password yang dimasukkan ada di database
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    // Jalankan query
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    // Cek apakah ada hasil query
    if (mysqli_num_rows($result) === 1) {
        // Jika ada, ambil data pegawai tersebut
        $row = mysqli_fetch_assoc($result);

        // Cek apakah password yang diinput benar
        if (md5($password) === $row['password']) {
            // jika benar, buat session
            $_SESSION["pegawai"]    = true;
            $_SESSION["id_pegawai"] = $row["id_pegawai"];
            $_SESSION["level"]      = $row["level"];

            // Jika user login adalah dokter
            if ($_SESSION["level"] === "Dokter") {
                // Alihkan user ke dashboard dokter
                header('Location: dokter/index.php');
                // Hentikan script
                exit;
            }

            // Jika admin, alihkan user ke dashboard
            header('Location: index.php');
            // Hentikan script
            exit;
        }
    }

    // jika gagal, beri pesan error
    echo "
        <script>
            confirm('Username dan password salah');
            document.location='login.php';
        </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SI KLINIK - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Enter username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <button name="login" class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>