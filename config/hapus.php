<?php
$conn = new mysqli('localhost', 'root', '', 'nyewa');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_sewa = $_GET['id'];

// Query untuk mendapatkan detail penyewaan yang terlibat
$query = "SELECT penyewaan.id_sewa, penyewaan.tgl_sewa, penyewaan.tgl_kembali, 
                 admin.nama AS admin_nama, 
                 kendaraan.nomor AS kendaraan_nomor, kendaraan.merek AS kendaraan_merek, 
                 kendaraan.id_ken,  -- Tambahkan kolom id_ken
                 jenis.nama AS jenis_kendaraan, 
                 detail_penyewa.nama AS penyewa_nama, detail_penyewa.kontak AS penyewa_kontak,
                 kendaraan.status AS kendaraan_status, 
                 penyewaan.jumlah, penyewaan.total_harga
          FROM kendaraan
          LEFT JOIN detail_penyewaan ON kendaraan.id_ken = detail_penyewaan.id_ken
          LEFT JOIN penyewaan ON detail_penyewaan.id_sewa = penyewaan.id_sewa
          LEFT JOIN admin ON penyewaan.id_admin = admin.id_admin
          LEFT JOIN jenis ON kendaraan.id_jenis = jenis.id_jenis
          LEFT JOIN detail_penyewa ON detail_penyewaan.id_penyewa = detail_penyewa.id_penyewa
          WHERE penyewaan.id_sewa = '$id_sewa'";



// Eksekusi query
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ambil data penyewaan dan kendaraan
    $row = $result->fetch_assoc();
    
    // Simpan data ke file log atau file JSON
    saveToHistory($row);

    // Mendapatkan id kendaraan yang terlibat
    $id_kendaraan = $row['id_ken'];

    // Query untuk mengupdate status kendaraan menjadi 'Tersedia'
    $updateKendaraanQuery = "UPDATE kendaraan SET status = 'Tersedia' WHERE id_ken = '$id_kendaraan'";
    if ($conn->query($updateKendaraanQuery) === TRUE) {
        
        // Hapus data dari detail_penyewaan
        $deleteDetailQuery = "DELETE FROM detail_penyewaan WHERE id_sewa='$id_sewa'";
        if ($conn->query($deleteDetailQuery) === TRUE) {
            
            // Hapus data dari penyewaan
            $deletePenyewaanQuery = "DELETE FROM penyewaan WHERE id_sewa='$id_sewa'";
            if ($conn->query($deletePenyewaanQuery) === TRUE) {
                echo "Data berhasil dihapus dan kendaraan diperbarui.";
                header("Location: ../admin/index.php?page=penyewaan");
            } else {
                echo "Error: " . $deletePenyewaanQuery . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $deleteDetailQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Error updating kendaraan: " . $conn->error;
    }
} else {
    echo "Penyewaan tidak ditemukan.";
}

$conn->close();

// Fungsi untuk mencatat data ke file log atau JSON
function saveToHistory($data) {
    $file = 'history_log.json'; // Nama file untuk menyimpan histori
    $currentDate = date('Y-m-d H:i:s'); // Waktu saat data disimpan
    $data['timestamp'] = $currentDate; // Menambahkan timestamp ke data

    // Membaca data lama dari file JSON (jika ada)
    $history = [];
    if (file_exists($file)) {
        $history = json_decode(file_get_contents($file), true);
    }

    // Menambahkan data baru ke dalam array histori
    $history[] = $data;

    // Menyimpan kembali ke file JSON
    file_put_contents($file, json_encode($history, JSON_PRETTY_PRINT));
}
?>
