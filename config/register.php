<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    // Validasi input
    if (!empty($username) && !empty($password) && !empty($contact)) {
        // Hash password sebelum disimpan ke database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $stmt = $conn->prepare("INSERT INTO admin (nama, password, kontak) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $username, $hashedPassword, $contact);

        if ($stmt->execute()) {
            echo "<script>alert('Berhasil Registrasi Silahkan Login'); window.location.href='../login.php';</script>";
            exit();
        } else {
            header('Location: register.php?error=1');
            exit();
        }
    } else {
        header('Location: register.php?error=1');
        exit();
    }
}
?>