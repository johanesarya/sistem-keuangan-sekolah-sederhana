<?php
session_start();
include 'conn.php';
if (!isset($_SESSION["user"]) || !isset($_SESSION["jenjang"])) {
}

//include koneksi database
include('conn.php');

//get data dari form
$keterangan = $_POST['keterangan'];
$nilai = $_POST['nilai'];
$tanggal = $_POST['tanggal'];
$jenjang = $_SESSION['jenjang'];
$unit = $_POST['unit'];

//query insert data ke dalam database
mysqli_query($conn, "INSERT INTO tbl_realisasi (keterangan, nilai, tanggal, jenjang, unit) VALUES ('$keterangan', '$nilai', '$tanggal', '$jenjang', '$unit')");

    //redirect ke halaman index.php 
    header("location: output.php");
?>