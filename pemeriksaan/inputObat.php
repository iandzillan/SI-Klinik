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

// Tangkap data id pendaftaran dari url
$id = $_GET["id"];

// Susun query untuk menyeleksi data
$query = "SELECT A.id AS id_pendaftaran, A.nama_pasien, A.tanggal, A.keluhan, A.jk,
          B.id AS id_tindakan, B.tindakan, 
          C.id AS id_pegawai, C.nama_pegawai FROM pendaftaran A 
          LEFT JOIN tindakan B ON B.id = A.id_tindakan
          LEFT JOIN pegawai C ON C.id = A.id_pegawai
          WHERE A.id = '$id'";
// Panggil function select
$pasien = select($query)[0];

// Jalankan function select untuk mengambil data obat
$obat = select("SELECT * FROM obat");

// Jalankan function select untuk mengambil data dari tmp_obat
$tmp_obat_query = "SELECT A.id, A.id_obat, B.nama_obat FROM tmp_obat A 
                   LEFT JOIN obat B ON B.id = A.id_obat
                   WHERE A.id_pendaftaran = '$id'";
$tmp_obat = select($tmp_obat_query);

// Cek apakah tombol inputObat sudah ditekan
if (isset($_POST["inputObat"])) {
    // Jika sudah, panggil function tambahObat dan cek hasil function
    if (tambahObat($_POST) > 0) {
        // Jika function berhasil dijalankan, beri pesan berhasil
        echo "
            <script>
                document.location.href= '../pemeriksaan/inputObat.php?id=$id';
            </script>
        ";
        exit;
    } else {
        // Jika gagal, beri pesan gagal
        echo "
            <script>
                alert('Data gagal ditambahkan');
                document.location.href= '../pemeriksaan/inputObat.php?id=$id';
            </script>
        ";
    }
}

// Cek apakah tombol hapusObat sudah ditekan
if (isset($_POST["hapusObat"])) {
    // Jika sudah, panggil function hapusObat dan cek hasilnya
    if (hapusObat($_POST) > 0) {
        // Jika function berhasil dijalankan, beri pesan berhasil
        echo "
            <script>
                document.location.href= '../pemeriksaan/inputObat.php?id=$id';
            </script>
        ";
        exit;
    } else {
        // Jika gagal, beri pesan gagal
        echo "
            <script>
                alert('Data gagal dihapus');
                document.location.href= '../pemeriksaan/inputObat.php?id=$id';
            </script>
        ";
    }
}

// Cek apakah tombol inputHasil sudah ditekan
if (isset($_POST["inputHasil"])) {
    // Jika sudah, jalankan function hasil
    hasil($_POST);
    echo "
        <script>
            alert('Data Berhasil diinput');
            document.location.href= '../pemeriksaan/index.php';
        </script>
     ";
    // Hentikan script
    exit;
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

    <title>SI KLINIK - Data Pasien</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SI KLINIK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Master Data -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../pegawai/index.php">Pegawai</a>
                        <a class="collapse-item" href="../user/index.php">User</a>
                        <a class="collapse-item" href="../tindakan/index.php">Tindakan</a>
                        <a class="collapse-item" href="../obat/index.php">Obat</a>
                        <a class="collapse-item" href="../wilayah/index.php">Wilayah</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pendaftaran Pasien -->
            <li class="nav-item">
                <a class="nav-link" href="../pendaftaran/index.php">
                    <i class="fas fa-user"></i>
                    <span>Pendaftaran Pasien</span>
                </a>
            </li>

            <!-- Nav Item - Pemeriksaan -->
            <li class="nav-item">
                <a class="nav-link" href="../pemeriksaan/index.php">
                    <i class="fas fa-th-list"></i>
                    <span>Pemeriksaan</span>
                </a>
            </li>

            <!-- Nav Item - Pembayaran -->
            <li class="nav-item">
                <a class="nav-link" href="../pembayaran/index.php">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Pembayaran</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user["nama_pegawai"]; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Pasien <?= $pasien["nama_pasien"]; ?></h1>

                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Data Pasien</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table cellpadding="10">
                                            <tr>
                                                <th>Nama Pasien</th>
                                                <td>:</td>
                                                <td><?= $pasien["nama_pasien"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Periksa</th>
                                                <td>:</td>
                                                <td><?= $pasien["tanggal"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>:</td>
                                                <td>
                                                    <?php if ($pasien["jk"] === "L") : ?>
                                                        Laki laki
                                                    <?php else : ?>
                                                        Perempuan
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Keluhan</th>
                                                <td>:</td>
                                                <td><?= $pasien["keluhan"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tindakan</th>
                                                <td>:</td>
                                                <td><?= $pasien["tindakan"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Dokter</th>
                                                <td>:</td>
                                                <td><?= $pasien["nama_pegawai"]; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Input Obat</h6>
                                </div>
                                <div class="card-body">
                                    <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#obatModal">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Obat</span>
                                    </a>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Obat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($tmp_obat as $row) : ?>
                                                    <tr>
                                                        <td><?= $row["nama_obat"]; ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" id="id" value="<?= $row["id"]; ?>">
                                                                <input type="hidden" name="id_obat" id="id_obat" value="<?= $row["id_obat"]; ?>">
                                                                <button type="submit" name="hapusObat" class="btn btn-danger btn-circle">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <form action="" method="post">
                                        <?php foreach ($tmp_obat as $row) : ?>
                                            <input type="hidden" name="id_pendaftaran" id="id_pendaftaran" value="<?= $_GET["id"]; ?>">
                                            <input type="hidden" name="id_obat[]" id="id_obat" value="<?= $row["id_obat"]; ?>">
                                            <input type="hidden" name="id_tindakan" id="id_tindakan" value="<?= $pasien["id_tindakan"]; ?>">
                                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="<?= $pasien["id_pegawai"]; ?>">
                                        <?php endforeach; ?>
                                        <button type="submit" class="btn btn-info btn-icon-split" name="inputHasil">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Submit</span>
                                        </button>
                                    </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SI KLINIK <?= date("Y") ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Obat Modal-->
    <div class="modal fade" id="obatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Obat</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Obat</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($obat as $row) : ?>
                                    <tr>
                                        <td><?= $row["nama_obat"]; ?></td>
                                        <td><?= $row["stok"]; ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_pendaftaran" id="id_pendaftaran" value="<?= $_GET["id"]; ?>">
                                                <input type="hidden" name="id_obat" id="id_obat" value="<?= $row["id"]; ?>">
                                                <button type="submit" name="inputObat" class="btn btn-success btn-circle">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

</body>

</html>