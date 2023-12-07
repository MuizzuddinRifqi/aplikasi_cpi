<?php  
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SPK CPI (Composite Performance Index)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="shortcut icon" href="images/download.png" />
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
<style>
  .textwelcome:{
    color: white;
  text-align: center;

  }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <a href="?module=home" class="nav-link">Home</a>
      </li>
    </ul>

    <div style="width: 88%; text-align: right; font-size: 16px; color: #8a8a8a">Welcome, <?php echo $_SESSION["nama"];?></div>

   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="?module=home" class="brand-link">
      <img src="images/logo.png" alt="AdminLTE Logo" width="70px">
      <span class="brand-text font-weight-light"></span>
      <small>SMP ABC-XYZ</small><br>
      <small>Penentuan Kinerja Guru Terbaik</small>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- <li class="nav-header">MISCELLANEOUS</li> -->
          
          <li class="nav-item">
            <a href="?module=data_guru" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Data Guru</p>
            </a>
         <li class="nav-item">
            <a href="?module=data_kriteria" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Data Kriteria</p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="?module=data_nilai" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Data Nilai Guru</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="?module=perhitungan" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>Proses Perhitungan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?module=cetak_sk" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Cetak Hasil Keputusan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?module=data_user" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Data User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <?php  
        $module=$_GET["module"];
        
            switch ($module) {
              default:
                # code...
                ?>
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <?php  
                              $mysql=mysqli_fetch_array(mysqli_query($koneksi,"select count(id_kriteria) as jumlah from kriteria"));
                            ?>
                            <h3><?php echo $mysql['jumlah'] ?></h3>

                            <p>Kriteria</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-ios-compose"></i>
                          </div>
                          <a href="?module=data_kriteria" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                             <?php  
                              $mysql=mysqli_fetch_array(mysqli_query($koneksi,"select count(id_guru) as jumlah from guru"));
                            ?>
                            <h3><?php echo $mysql['jumlah'] ?></h3>

                            <p>GURU</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-android-people"></i>
                          </div>
                          <a href="?module=data_guru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                             <?php  
                              $mysql=mysqli_fetch_array(mysqli_query($koneksi,"select count(nilai) as jumlah from nilai"));
                            ?>
                            <h3><?php echo $mysql['jumlah'] ?></h3>

                            <p>Nilai</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          <a href="?module=data_nilai" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                          <div class="inner">
                             <?php  
                              $mysql=mysqli_fetch_array(mysqli_query($koneksi,"select count(id_Kinerja) as jumlah from kinerja"));
                            ?>
                            <h3><?php echo $mysql['jumlah'] ?></h3>
                            <p>Hasil Akhir</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                          </div>
                          <a href="?module=cetak_sk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                      <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                          
                          <div class="card-body">
                            <div class="tab-content">
                              <h2 align="center">PROFIL SMP ABC-XYZ</h2>
                              <hr>
                              <p>SEJARAH SEKOLAH</p>
                              <p>
                                <b>VISI</b><br>
                                INI VISI
                              </p>
                              <p>
                                <b>MISI</b>
                                <ul>
                                  <li>Misi 1</li>
                                  <li>Misi 2</li>
                                  <li>Misi 3</li>
                                  <li>Misi 4</li>
                                  <li>Misi 5</li>
                                </ul>
                              </p>

                            </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                        <!-- ./card -->
                      </div>
                      <!-- /.col -->
                    </div>
                <?php 
                break;
                
                case "data_kriteria" :
                        include "modul/kriteria/data_kriteria.php";
                break;
                case "data_guru" :
                        include "modul/alternatif/data_guru.php";
                break;
                case "data_nilai" :
                        include "modul/nilai/data_nilai.php";
                break;
                case "data_user" :
                        include "modul/user/data_user.php";
                break;
                case "input_guru" :
                        include "modul/alternatif/input_guru.php";
                break;
                case "input_kriteria" :
                        include "modul/kriteria/input_kriteria.php";
                break;
                case "input_nilai" :
                        include "modul/nilai/input_nilai.php";
                break;
                case "input_user" :
                        include "modul/user/input_user.php";
                break;
                case "edit_guru" :
                        include "modul/alternatif/edit_guru.php";
                break;
                case "edit_kriteria" :
                        include "modul/kriteria/edit_kriteria.php";
                break;
                case "edit_nilai" :
                        include "modul/nilai/edit_nilai.php";
                break;
                case "cpi" :
                        include "modul/cpi/cpi.php";
                break;
                case "perhitungan" :
                        include "modul/cpi/perhitungan.php";
                break;
                case "edit_user" :
                        include "modul/user/edit_user.php";
                break;
                case "cetak_sk" :
                        include "modul/cpi/cetak_sk.php";
                break;
            }
        ?>
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <!-- isi utama disini -->
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2-pre
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
