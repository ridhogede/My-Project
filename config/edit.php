<?php
$conn = new mysqli('localhost', 'root', '', 'nyewa');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_sewa = $_POST['id_sewa'];
$tgl_sewa = $_POST['tgl_sewa'];
$tgl_kembali = $_POST['tgl_kembali'];
$id_admin = $_POST['id_admin'];
$id_penyewa = $_POST['id_penyewa'];
$id_kendaraan = $_POST['id_kendaraan'];
$jumlah = $_POST['jumlah'];
$total_harga = $_POST['total_harga'];

$queryPenyewaan = "UPDATE penyewaan SET tgl_sewa='$tgl_sewa', tgl_kembali='$tgl_kembali', id_admin='$id_admin', jumlah='$jumlah', total_harga='$total_harga' WHERE id_sewa='$id_sewa'";

if ($conn->query($queryPenyewaan) === TRUE) {
    $queryDetail = "UPDATE detail_penyewaan SET id_penyewa='$id_penyewa', id_ken='$id_kendaraan' WHERE id_sewa='$id_sewa'";
    
    if ($conn->query($queryDetail) === TRUE) {
        echo "Data berhasil diupdate.";
        header("Location: ../admin/index.php?page=penyewaan");
    } else {
        echo "Error: " . $queryDetail . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $queryPenyewaan . "<br>" . $conn->error;
}

$conn->close();
?>