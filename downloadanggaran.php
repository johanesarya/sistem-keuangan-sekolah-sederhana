<?php
session_start();
include 'conn.php';
if (!isset($_SESSION["user"]) || !isset($_SESSION["jenjang"])) {
    // echo $_SESSION["jenjang"];
    header("Location: login.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    
<body>
    <h3><p class="text-center mt-4">Data Pemasukan Anggaran</p></h3>
    <center><table class=" mt-4" width="1000px" border="1">
        <tr>
            <td><center>No</td>
            <td><center>Agenda</td>
            <td><center>Jumlah Pemasukan</td>
            <td><center>Tanggal</td>
        </tr>
            
        <?php
        $query = mysqli_query($conn, "SELECT * FROM tbl_anggaran");
        while($row = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><center><?php echo $row['id_anggaran'] ?></td>
                <td><center><?php echo $row['keterangan'] ?></td>
                <td><center><?php echo $row['nilai'] ?></td>
                <td><center><?php echo $row['tanggal'] ?></td>
            </tr>
            <?php } ?>
                
            <?php
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename= Data_anggaran.xls");
                ?>
    </body>
</html>
