<?php
session_start();
    include 'conn.php';
    if (!isset($_SESSION["user"]) || !isset($_SESSION["jenjang"])) {
        // echo $_SESSION["jenjang"];
        header("Location: login.php");
    }
    $Jumlah_masuk=mysqli_query($conn, "select sum(nilai) as tbl_anggaran from tbl_anggaran where jenjang='".$_SESSION['jenjang']."'");
    $total=mysqli_fetch_array($Jumlah_masuk);


    $Jumlah_keluar=mysqli_query($conn, "select sum(nilai) as tbl_realisasi from tbl_realisasi where jenjang='".$_SESSION['jenjang']."'");
    $total_out=mysqli_fetch_array($Jumlah_keluar)?>

<!DOCTYPE html>
<html>
<head>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <!-- Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  
</head>
<style>
  /* this is needed to make the content scrollable on larger screens */
  @media (min-width: 576px) {
    .h-sm-100 {
      height: 100%;
    }}
</style>

<body>
    <div class="container-fluid overflow-hidden">
        <div class="row vh-100 overflow-auto">
            <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">
                <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
                    <a href="/" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5">Sistem Keuangan</span>
                    </a>
                    <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fs-5 bi-journal"></i><span class="ms-1 d-none d-sm-inline">Anggaran</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                                <li><a class="dropdown-item" href="input.php">Input Anggaran</a></li>
                                <li><a class="dropdown-item" href="laporan.php">Laporan Pengeluaran</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fs-5 bi-journal"></i><span class="ms-1 d-none d-sm-inline">Pengeluaran</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                                <li><a class="dropdown-item" href="output.php">Input Pengeluaran</a></li>
                                <li><a class="dropdown-item" href="laporan2.php">Laporan Pengeluaran</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                    <?php
                $pass = $_SESSION['user'];
                $in = mysqli_query($conn, "select * from tbl_user where username = '$pass'");
                $inn = mysqli_fetch_array($in);
                if($inn){
                    ?>

                    <!-- Nav Item - User Information -->
                    <li class="dropdown">
                    <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fs-5 bi-person-fill"></i><span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $inn['name']; ?></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        </a></li>
                    </li>
                    <?php
        }
                    ?>

                </ul>

                </nav>
                <!-- End of Topbar -->
                </div>
            </div>
            <div class="col d-flex flex-column h-sm-100">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">

                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan Anggaran:</h6>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <?php
                            $jumlah=mysqli_query($conn,"SELECT COUNT(*) as id from tbl_anggaran where jenjang='".$_SESSION['jenjang']."'");
                             $row = mysqli_fetch_array($jumlah);
                             $jum = $row['id'];
                             $hmm= $jum;
                             $hal= 10;
                             $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
                             $start = ($page - 1) * $hal;
                             $kap = $hal * $hal;
                             ?>
                             <div class="row mt-3">
                                <div class="col-md-8  mt-4">
                                    <h7 class="m-0 font-weight-bold">Pemasukan Anggaran di Tabel: <?php echo $kap." Max"; ?></h7><br>
                                    <a href="downloadanggaran.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
                                </div>
                            </div>
                            <div class="table-responsive service">
                            <table class="table table-bordered table-hover  mt-3 text-nowrap css-serial">
                                
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Agenda</th>
                                    <th scope="col">Jumlah Pemasukan</th>
                                    <th scope="col">Tanggal</th>
                                </tr>

                            </thead>
                            <?php
                            if(isset($_GET['cari'])){
                                $cari=mysqli_real_escape_string($conn, $_GET['cari']);
                                $search=mysqli_query($conn, "select * from tbl_realisasi where keterangan like '%".$cari."%'");
                                if(mysqli_num_rows($search) > 0){
                                    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                    echo "<div class='alert alert-primary mt-4 ml-5' role='alert'>";
                                    echo "<p><center>Data Yang Anda Cari  Ditemukan</center></p>";
                                    echo   "</div>";
                                    echo "</div>";
                                }else{
                                    echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                    echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                                    echo "<p><center>$cari Yang Anda Cari Tidak Ditemukan</center></p>";
                                    echo   "</div>";
                                    echo "</div>";
                                }
                            }else{
                                $search=mysqli_query($conn, "select * from tbl_anggaran limit $start, $hal");
                            }
                            if(mysqli_num_rows($search)){
                                while($row = mysqli_fetch_array($search)){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $row['id_anggaran'] ?></th>
                                            <td><?php echo $row['keterangan'] ?></td>
                                            <td><?php echo number_format($row['nilai']) ?></td>
                                            <td><?php echo $row['tanggal'] ?></td>
                                </tr>
                            </tbody>
                            <?php }}elseif(mysqli_num_rows($search) <= 0 AND !$cari){
                                echo "<div class='col-md-10 col-sm-12 col-xs-12 ml-5'>";
                                echo "<div class='alert alert-danger mt-4 ml-5' role='alert'>";
                                echo "<p><center>Data Anda Masih Kosong</center></p>";
                                echo "</div>";
                                echo "</div>";
                                }?>
                                </table>
                                
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <?php
                                        for($x=1;$x<=$hal ;$x++){
                                            ?>
                                            <li class="page-item"><a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
                                            <?php } ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>