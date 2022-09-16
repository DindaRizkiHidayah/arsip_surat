<?php
include 'connection.php';
date_default_timezone_set("Asia/Jakarta");
    $id = $_POST['id'];
    $no_surat = $_POST['no_surat'];
    $kategori = $_POST['kategori'];
    $judul = $_POST['judul'];
    $tgl_arsip = date("Y-m-d h:i:sa");

if(isset($_POST['edit'])){
    extract($_POST);
    $nama_file = $_FILES['data_surat']['name'];

    if(!empty($nama_file)){
        $lokasi_file = $_FILES['data_surat']['tmp_name'];
        $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
        $file = $judul.".".$tipe_file;

        $folder = "arsip/$file";
        move_uploaded_file($lokasi_file,"$folder");
    }else{
        $file="-";
    }
    
    $sql = "UPDATE tbarsip SET('$id','$no_surat','$kategori','$judul','$tgl_arsip','$file')";
    $query = mysqli_query($db, $sql);

    header("location:index.php");
}
?>