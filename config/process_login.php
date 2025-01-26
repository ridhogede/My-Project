<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE nama = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Verifikasi password menggunakan password_verify()
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['nama'];
            echo "<script>alert('Berhasil Login'); window.location.href='../admin';</script>";
            exit();
        } else {
            // Password salah
            header('Location: ../login.php?error=1');
            exit();
        }
    } else {
        // Username tidak ditemukan
        header('Location: ../login.php?error=1');
        exit();
    }
}
?>