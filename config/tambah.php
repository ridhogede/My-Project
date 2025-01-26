<?php
$conn = new mysqli('localhost', 'root', '', 'nyewa');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$tgl_sewa = $_POST['tgl_sewa'];
$tgl_kembali = $_POST['tgl_kembali'];
$id_admin = $_POST['id_admin'];
$id_penyewa = $_POST['id_penyewa'];
$id_kendaraan = $_POST['id_kendaraan'];
$jumlah = $_POST['jumlah'];
$total_harga = $_POST['total_harga'];


// Update status kendaraan menjadi 'Disewa'
$updateKendaraanQuery = "UPDATE kendaraan SET status = 'Disewa' WHERE id_ken = '$id_kendaraan'";
$conn->query($updateKendaraanQuery);
// Query Menyimpan Data
$queryPenyewaan = "INSERT INTO penyewaan (tgl_sewa, tgl_kembali, id_admin, jumlah, total_harga) VALUES ('$tgl_sewa', '$tgl_kembali', '$id_admin', '$jumlah', '$total_harga')";

if ($conn->query($queryPenyewaan) === TRUE) {
    $id_sewa = $conn->insert_id;
    
    $queryDetail = "INSERT INTO detail_penyewaan (id_sewa, id_penyewa, id_ken) VALUES ('$id_sewa', '$id_penyewa', '$id_kendaraan')";

if ($conn->query($queryDetail) === TRUE) {
    echo "Data berhasil disimpan.";
    header("Location: ../admin/index.php?page=penyewaan");
} else {
    echo "Error: " . $queryDetail . "<br>" . $conn->error;
}

$conn->close();
}
?>