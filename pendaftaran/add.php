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

// panggil function select untuk mengambil data tindakan
$tindakan = select("SELECT id, tindakan FROM tindakan");

// Panggil function select untuk mengambil data pegawai
$pegawai = select("SELECT A.id, A.nama_pegawai FROM pegawai A LEFT JOIN user B ON B.id_pegawai = A.id WHERE level='Dokter'");

// Panggil function select untuk mengambil data wilayah
$wilayah = select("SELECT * FROM wilayah");

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
    // Jika sudah, panggil function tambah dan cek hasil function
    if (tambah($_POST) > 0) {
        // Jika function berhasil dijalankan, beri pesan berhasil
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href= '../pendaftaran/index.php';
            </script>
        ";
    } else {
        // Jika gagal, beri pesan gagal
        echo "
            <script>
                alert('Data gagal ditambahkan');
                document.location.href= '../pendaftaran/index.php';
            </script>
        ";
        mysqli_error($conn);
    }
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

    <title>SI Klinik - Pendaftaran Pasien</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

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

                    <!-- Basic Card Example -->
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pendaftaran Pasien</h6>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_pasien">Nama Pasien</label>
                                                <input type="text" class="form-control form-control-user" id="nama_pasien" name="nama_pasien" placeholder="Masukkan nama pasien..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select class="form-control" name="jk" id="jk" required>
                                                    <option value="">Pilih...</option>
                                                    <option value="L">Laki laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nohp">Nomor Handphone</label>
                                                <input type="number" class="form-control form-control-user" id="nohp" name="nohp" placeholder="Masukkan no. handphone pasien..." required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12">
                                            </div>
                                            <div class="form-group">
                                                <label for="id_wilayah">Wilayah</label>
                                                <select class="form-control" name="id_wilayah" id="id_wilayah" required>
                                                    <option value="">Pilih...</option>
                                                    <?php foreach ($wilayah as $row) : ?>
                                                        <option value="<?= $row["id"]; ?>"><?= $row["kelurahan"]; ?>, <?= $row["kecamatan"]; ?>, <?= $row["kota"]; ?>, <?= $row["provinsi"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan alamat pasien..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="keluhan">Keluhan</label>
                                                <input type="text" class="form-control form-control-user" id="keluhan" name="keluhan" placeholder="Masukkan keluhan pasien..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_tindakan">Tindakan</label>
                                                <select class="form-control" name="id_tindakan" id="id_tindakan" required>
                                                    <option value="">Pilih...</option>
                                                    <?php foreach ($tindakan as $row) : ?>
                                                        <option value="<?= $row["id"]; ?>"><?= $row["tindakan"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_pegawai">Nama Pegawai</label>
                                                <select class="form-control" name="id_pegawai" id="id_pegawai" required>
                                                    <option value="">Pilih...</option>
                                                    <?php foreach ($pegawai as $row) : ?>
                                                        <option value="<?= $row["id"]; ?>"><?= $row["nama_pegawai"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button name="submit" class="btn btn-primary btn-user btn-block" type="submit">
                                        Submit
                                    </button>
                                </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>