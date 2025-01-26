<?php
// database.php

$host = 'localhost';
$user = 'root';
$password = ''; // Ganti dengan password MySQL Anda jika ada
$dbname = 'nyewa';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>