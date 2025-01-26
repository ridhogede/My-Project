<!-- dashboard.php -->
<?php
// Halaman dashboard admin
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require '../config/koneksi.php';
include '../layouts/header.php';

    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'dashboard':
                include 'home.php';
                break;
            case 'kendaraan':
                include 'kendaraan.php';
                break;
            case 'penyewa':
                include 'penyewa.php';
                break;
            case 'penyewaan':
                include 'penyewaan.php';
                break;
            case 'histori':
                include 'histori.php';
                break;
            default:
                echo "Halaman Tidak Tersedia";
                break;
        }
    } else {
        include 'home.php';
    }
    include '../layouts/footer.php'

?>

</body>
</html>