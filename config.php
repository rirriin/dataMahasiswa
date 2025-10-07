<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = ""; // sesuaikan password
$dbname = "db_mahasiswa";

// Buat koneksi
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
