<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "reservasi_uniska";

$koneksi = mysqli_connect($server, $username, $password, $dbname) or die("Koneksi database gagal");
session_start();
