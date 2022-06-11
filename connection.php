<?php
$servername = "localhost";
$database = "bisindo";
$username = "root";
$password = "";
 
$connect = mysqli_connect($servername, $username, $password, $database);
if (!$connect) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}

