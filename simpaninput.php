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

//query insert data ke dalam database
mysqli_query($conn, "INSERT INTO tbl_anggaran (keterangan, nilai, tanggal, jenjang) VALUES ('$keterangan', '$nilai', '$tanggal', '$jenjang')");

    //redirect ke halaman index.php 
    header("location: input.php");
?>