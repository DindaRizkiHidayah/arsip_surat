<?php
    include 'connection.php';

    $id = $_GET['id'];

    mysqli_query($db, "DELETE FROM tbarsip WHERE id= '$id'") or die(mysql_error());

    header("location:index.php");
?>