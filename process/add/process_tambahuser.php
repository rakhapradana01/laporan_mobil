<?php
require_once('../../function/helper.php');
require_once('../../function/koneksi.php');


$id = $_POST['id'];
$nik = $_POST['Nik'];
$password = $_POST['Password'];
$role = $_POST['role'];

$query = mysqli_query($koneksi, "insert into user values('','$nik','$password','$role')
    ");
$_SESSION['status'] = 'Data Berhasil ditambahkan';
header("location:" . BASE_URL . "user.php");
