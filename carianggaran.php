<?php
session_start();
include 'conn.php';
if (!isset($_SESSION["user"]) || !isset($_SESSION["jenjang"])) {
    // echo $_SESSION["jenjang"];
}
$cari=$_GET['cari'];
header("location: laporan.php?cari=$cari");
?>
