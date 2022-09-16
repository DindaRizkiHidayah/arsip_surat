<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Arsip Surat</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <h1>MENU</h1>  
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Arsip</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">
                <span class="menu-title">About</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h1 class="page-title"> Arsip Surat
                <br><p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
                  Klik "lihat" pada kolom aksi untuk menampilkan surat.
              </p>
              </h1>
            </div>
            <div class="search-field d-none d-md-block">
            <form method=post class="d-flex align-items-center h-100">
              <div class="input-group">
                <div class="input-group-prepend bg-white">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" name="pencarian"  class="form-control h-full" placeholder="Search">
                <button class="btn btn-primary btn-user btn-block" type="submit">
                        Cari
                    </button>
              </div>
            </form>
          </div>
    </div>

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Nomor Surat </th>
                            <th> Kategori </th>
                            <th> Judul </th>
                            <th> Waktu Pengarsipan </th>
                            <th> Aksi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              
                              $batas = 5;
                              extract ($_GET);
                              if(empty($hal)){
                                  $posisi = 0;
                                  $hal = 1;
                                  $nomor = 1;
                              }else{
                                  $posisi = ($hal-1)*$batas;
                                  $nomor = $posisi+1;
                              }
                              if($_SERVER['REQUEST_METHOD']=="POST"){
                                  $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
                                  if($pencarian != ""){
                                      $sql = "SELECT * FROM tbarsip WHERE kategori LIKE '%$pencarian%'
                                      OR no_surat LIKE '%$pencarian%'
                                      OR judul LIKE '%$pencarian%'
                                      OR tgl_arsip LIKE '%$pencarian%'";
                                      $query = $sql;
                                      $queryJml = $sql;
                                  } else{
                                      $query= "SELECT * FROM tbarsip LIMIT $posisi, $batas";
                                      $queryJml = "SELECT * FROM tbarsip";
                                      $no = $posisi * 1;
                                  }
                              }
                              else{
                                  $query = "SELECT *FROM tbarsip LIMIT $posisi, $batas";
                                  $queryJml = "SELECT *FROM tbarsip";
                                  $no = $posisi*1;
                              }
                              $q_tampil_arsip = mysqli_query($db, $query);
                              if(mysqli_num_rows($q_tampil_arsip)>0){
                                  while($r_tampil_arsip=mysqli_fetch_array($q_tampil_arsip)){
                                      if(empty($r_tampil_arsip['data_surat']) or ($r_tampil_arsip['data_surat']=='-')){
                                          $file = "-";
                                      }
                                      else{
                                          $file = $r_tampil_arsip['data_surat'];
                                      }
                          ?>
                              <tr>
                                  <td><?php echo $r_tampil_arsip['no_surat'];?></td>
                                  <td><?php echo $r_tampil_arsip['kategori'];?></td>
                                  <td><?php echo $r_tampil_arsip['judul'];?></td>
                                  <td><?php echo $r_tampil_arsip['tgl_arsip'];?></td>
                                  <td>
                                      <button type="button" class="badge badge-gradient-danger"><a href="delete.php?id=<?php echo $r_tampil_arsip['id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus arsip surat ini?')" class="tombol" style="color:white">Hapus</a></button>
                                      <button type="button" class="badge badge-gradient-warning"><a target="_blank" href="http://localhost/arsip_surat/arsip/<?php echo $file?>" class="tombol" style="color:white">Unduh</a></button>
                                      <button type="button" class="badge badge-gradient-info"><a href="read.php?id=<?php echo $r_tampil_arsip['id'];?>" class="tombol" style="color:white">Lihat >></a></button>
                                  </td>
                              </tr>
                              <?php
                              }
                          }
                          else{
                              echo "<tr><td colspan=6>Data tidak ditemukan</td></tr>";
                          }
                          ?>
                              
                        </tbody>
                      </table>
                      <br><br>
                      <button class="badge badge-gradient-info"><a href="add_surat.php" class="tombol" style="color:white">Arsipkan Surat</a></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>