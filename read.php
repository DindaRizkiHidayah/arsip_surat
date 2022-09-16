<?php
    include ("connection.php");
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
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      
                    <?php
                        include 'connection.php';
                    ?>
                    <div id="content" class="p-4 p-md-5 pt-5">
                        <div id="label-page"><h3><b>Arsip Surat >> Lihat</b></h3></div>
                        <?php 
                            $id = $_GET['id'];
                            $q_tampil_arsip = mysqli_query($db, "SELECT * FROM tbarsip WHERE id = '$id'");
                            $r_tampil_arsip = mysqli_fetch_array($q_tampil_arsip);
                            if(empty($r_tampil_arsip['data_surat']) or ($r_tampil_arsip['data_surat']=='-')){
                                $file = "-";
                            }
                            else{
                                $file = $r_tampil_arsip['data_surat'];
                            }
                        ?>
                        <hr>
                        <table>
                            <tr>
                                <td>Nomor</td>
                                <td> : </td>
                                <td><?php echo $r_tampil_arsip['no_surat'];?></td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td> : </td>
                                <td><?php echo $r_tampil_arsip['kategori'];?></td>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td> : </td>
                                <td><?php echo $r_tampil_arsip['judul'];?></td>
                            </tr>
                            <tr>
                                <td>Waktu Unggah</td>
                                <td> : </td>
                                <td><?php echo $r_tampil_arsip['tgl_arsip'];?></td>
                            </tr>
                        </table>
                        <hr>
                        <iframe src="arsip/<?php echo $r_tampil_arsip['data_surat'];; ?>" style="width: 100%;height: 500px;"></iframe>
                        <br><br><br><br>
                        <button type="button" class="badge badge-gradient-danger"><a href="index.php" style="color:white"><< Kembali</a></button>
                        <button type="button" class="badge badge-gradient-warning"><a href="http://localhost/arsip_surat/arsip/<?php echo $file?>" style="color:white">Unduh</a></button>
                        <button type="button" class="badge badge-gradient-info"><a href="edit_surat.php" style="color:white">Edit/Ganti File</a></button>

            
                    </div>

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




