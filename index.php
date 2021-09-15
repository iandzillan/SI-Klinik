<?php
// Jalankan session
session_start();
// Panggil koneksi.php
require "koneksi.php";

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

// Ambil data pasien dalam pemeriksaan
$pemeriksaan = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE status='Dalam pemeriksaan'");
$pemeriksaan = mysqli_num_rows($pemeriksaan);

// Ambil data pasien dalam proses pembayaran
$pembayaran = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE status='Proses pembayaran'");
$pembayaran = mysqli_num_rows($pembayaran);

// Ambil data pasien yang transaksinya sudah selesai 
$transaksi = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE status='Transaksi selesai'");
$transaksi = mysqli_num_rows($transaksi);

// Ambil data jumlah pasien laki laki
$laki = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE jk='L'");
$laki = mysqli_num_rows($laki);

// Ambil data jumlah pasien perempuan
$perempuan = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE jk='P'");
$perempuan = mysqli_num_rows($perempuan);

// Tahun sekarang
$year = date("Y");

// Ambil data pasien bulan januari
$januari = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=01 AND year(tanggal)='$year'");
$januari = mysqli_num_rows($januari);

// Ambil data pasien bulan februari
$februari = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=02 AND year(tanggal)='$year'");
$februari = mysqli_num_rows($februari);

// Ambil data pasien bulan maret
$maret = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=03 AND year(tanggal)='$year'");
$maret = mysqli_num_rows($maret);

// Ambil data pasien bulan april
$april = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=04 AND year(tanggal)='$year'");
$april = mysqli_num_rows($april);

// Ambil data pasien bulan mei
$mei = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=05 AND year(tanggal)='$year'");
$mei = mysqli_num_rows($mei);

// Ambil data pasien bulan juni
$juni = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=06 AND year(tanggal)='$year'");
$juni = mysqli_num_rows($juni);

// Ambil data pasien bulan juli
$juli = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=07 AND year(tanggal)='$year'");
$juli = mysqli_num_rows($juli);

// Ambil data pasien bulan agustus
$agustus = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=08 AND year(tanggal)='$year'");
$agustus = mysqli_num_rows($agustus);

// Ambil data pasien bulan september
$september = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=09 AND year(tanggal)='$year'");
$september = mysqli_num_rows($september);

// Ambil data pasien bulan oktober
$oktober = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=10 AND year(tanggal)='$year'");
$oktober = mysqli_num_rows($oktober);

// Ambil data pasien bulan november
$november = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=11 AND year(tanggal)='$year'");
$november = mysqli_num_rows($november);

// Ambil data pasien bulan desember
$desember = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE month(tanggal)=12 AND year(tanggal)='$year'");
$desember = mysqli_num_rows($desember);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Klinik</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SI KLINIK</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
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
                        <a class="collapse-item" href="pegawai/index.php">Pegawai</a>
                        <a class="collapse-item" href="user/index.php">User</a>
                        <a class="collapse-item" href="tindakan/index.php">Tindakan</a>
                        <a class="collapse-item" href="obat/index.php">Obat</a>
                        <a class="collapse-item" href="wilayah/index.php">Wilayah</a>
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
                <a class="nav-link" href="pendaftaran/index.php">
                    <i class="fas fa-user"></i>
                    <span>Pendaftaran Pasien</span>
                </a>
            </li>

            <!-- Nav Item - Pemeriksaan -->
            <li class="nav-item">
                <a class="nav-link" href="pemeriksaan/index.php">
                    <i class="fas fa-th-list"></i>
                    <span>Pemeriksaan</span>
                </a>
            </li>

            <!-- Nav Item - Pembayaran -->
            <li class="nav-item">
                <a class="nav-link" href="pembayaran/index.php">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user["nama_pegawai"] ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
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
                    <div class="row">

                        <!-- Card: Jumlah pasien dalam pemeriksaan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pasien dalam pemeriksaan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemeriksaan; ?> Pasien</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-th-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Jumlah pasien dalam proses pembayaran -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Pasien dalam proses pembayaran
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pembayaran; ?> Pasien</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Jumlah transaksi selesai -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Transaksi Selesai
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $transaksi; ?> Pasien</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-5 col-lg-7">

                            <!-- Chart Jumlah Pasien Setiap Bulan-->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Pasien Tahun 2021</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="bulanChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Donut Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jumlah Pasien Berdasarkan Jenis Kelamin</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="jkChart"></canvas>
                                    </div>
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pie chart -->
    <script>
        var ctx = document.getElementById("jkChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            labels: [
                'Laki laki',
                'Perempuan'
            ],
            data: {
                labels: ['Laki laki', 'Perempuan'],
                datasets: [{
                    data: [<?= $laki; ?>, <?= $perempuan; ?>],
                    backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                    hoverOffset: 4
                }],
            }
        });
    </script>

    <!-- Script bar chart -->
    <script>
        var ctx = document.getElementById("bulanChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Jumlah pasien",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [
                        <?= $januari; ?>,
                        <?= $februari; ?>,
                        <?= $maret; ?>,
                        <?= $april; ?>,
                        <?= $mei; ?>,
                        <?= $juni; ?>,
                        <?= $juli; ?>,
                        <?= $agustus; ?>,
                        <?= $september; ?>,
                        <?= $oktober; ?>,
                        <?= $november; ?>,
                        <?= $desember; ?>
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    displayColors: false
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        maxBarThickness: 25,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>