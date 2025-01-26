<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'nyewa');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data join
$query = "SELECT penyewaan.id_sewa, penyewaan.tgl_sewa, penyewaan.tgl_kembali, admin.nama AS admin_nama, 
kendaraan.nomor AS kendaraan_nomor, kendaraan.merek AS kendaraan_merek, kendaraan.harga AS harga,
jenis.nama AS jenis_kendaraan, detail_penyewa.nama AS penyewa_nama, detail_penyewa.alamat, detail_penyewa.kontak, 
penyewaan.jumlah, penyewaan.total_harga 
FROM penyewaan 
JOIN admin ON penyewaan.id_admin = admin.id_admin 
JOIN detail_penyewaan ON penyewaan.id_sewa = detail_penyewaan.id_sewa 
JOIN kendaraan ON detail_penyewaan.id_ken = kendaraan.id_ken 
JOIN jenis ON kendaraan.id_jenis = jenis.id_jenis 
JOIN detail_penyewa ON detail_penyewaan.id_penyewa = detail_penyewa.id_penyewa";


$result = $conn->query($query);
$kendaraanResult = $conn->query("SELECT * FROM kendaraan WHERE status = 'tersedia'");


// function formatRupiah($angka) {
//     return "Rp" . number_format($angka, 0, ',', '.');
// }

?>


    <div class="container mt-5">
        <h1 class="mb-4" data-aos="fade-right" data-aos-delay="200">Manajemen Penyewaan</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal" data-aos="fade-right" data-aos-delay="400"><i class="bi bi-plus-lg"></i> Tambah Data</button>


        <!-- Modal Tambah Data -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Penyewaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../config/tambah.php" method="POST">
                <div class="modal-body">
                    <!-- Tanggal Sewa -->
                    <div class="mb-3">
                        <label for="tgl_sewa">Tanggal Sewa</label>
                        <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" required onchange="calculateTotal()">
                    </div>

                    <!-- Tanggal Kembali -->
                    <div class="mb-3">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required onchange="calculateTotal()">
                    </div>

                    <!-- Admin -->
                    <div class="mb-3">
                        <label for="id_admin">Admin</label>
                        <select class="form-control" id="id_admin" name="id_admin" required>
                            <?php 
                            $adminResult = $conn->query("SELECT * FROM admin");
                            while ($admin = $adminResult->fetch_assoc()) {
                                echo "<option value='" . $admin['id_admin'] . "'>" . $admin['nama'] . "</option>";
                            } 
                            ?>
                        </select>
                    </div>

                    <!-- Kendaraan -->
                    <div class="mb-3">
                        <label for="id_kendaraan">Kendaraan</label>
                        <select class="form-control" id="id_kendaraan" name="id_kendaraan" required onchange="updateHargaPerHari()">
                            <?php 
                            $kendaraanResult = $conn->query("SELECT * FROM kendaraan WHERE status = 'tersedia'");
                            if ($kendaraanResult->num_rows > 0) {
                                while ($kendaraan = $kendaraanResult->fetch_assoc()) {
                                    echo "<option value='" . $kendaraan['id_ken'] . "' data-harga='" . $kendaraan['harga'] . "'>" . $kendaraan['nomor'] . " - " . $kendaraan['merek'] . "</option>";
                                }
                            } else {
                                echo "<option disabled>Kendaraan Terpakai Semua</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Harga Per Hari -->
                    <div class="mb-3">
                        <label for="harga">Harga Per Hari</label>
                        <input type="number" class="form-control formatRupiah" id="harga" name="harga" readonly>
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                    </div>

                    <!-- Total Harga -->
                    <div class="mb-3">
                        <label for="total_harga">Total Harga</label>
                        <input type="number" class="form-control fortmatRupiah" id="total_harga" name="total_harga" readonly required>
                    </div>

                    <!-- Penyewa -->
                    <div class="mb-3">
                        <label for="id_penyewa">Penyewa</label>
                        <select class="form-control" id="id_penyewa" name="id_penyewa" required>
                            <?php 
                            $penyewaResult = $conn->query("SELECT * FROM detail_penyewa");
                            while ($penyewa = $penyewaResult->fetch_assoc()) {
                                echo "<option value='" . $penyewa['id_penyewa'] . "'>" . $penyewa['nama'] . "</option>";
                            } 
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<table class="table mt-4 table-lg table-bordered shadow table-hover">
  <thead class="bg-dark">
    <tr class="text-white text-center">
      <th style="width: 5%;">ID Sewa</th>
      <th style="width: 9%;">Tanggal Sewa</th>
      <th style="width: 9%;">Tanggal Kembali</th>
      <th style="width: 5%;">Admin</th>
      <th style="width: 15%;">Kendaraan</th>
      <th style="width: 10%;">Jenis Kendaraan</th>
      <th style="width: 15%;">Penyewa</th>
      <th style="width: 4%;">Jumlah</th>
      <th style="width: 10%;">Total Harga</th>
      <th style="width: 37%;">Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td class="text-center"><?= $row['id_sewa'] ?></td>
        <td class="text-center"><?= $row['tgl_sewa'] ?></td>
        <td class="text-center"><?= $row['tgl_kembali'] ?></td>
        <td class="text-center"><?= $row['admin_nama'] ?></td>
        <td><?= $row['kendaraan_nomor'] . " - " . $row['kendaraan_merek'] ?></td>
        <td class="text-center"><?= $row['jenis_kendaraan'] ?></td>
        <td><?= $row['penyewa_nama'] ?> (<?= $row['kontak'] ?>)</td>
        <td class="text-center"><?= $row['jumlah'] ?></td>
        <td class="text-right">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
        <td class="text-center">
          <button class="btn btn-warning btn-sm m-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_sewa'] ?>"><i class='bi bi-pencil'></i> Edit</button>
          <a href="../config/hapus.php?id=<?= $row['id_sewa'] ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Yakin ingin menghapus?')"><i class='bi bi-trash'></i> Hapus</a>
          <button class="btn btn-success btn-sm m-1" onclick="printStruk()"><i class="bi bi-printer"></i> Print Struk</button>
        </td>
      </tr>

<!-- Div ini untuk mencetak struk -->
<!-- Tampilan Struk Pembayaran -->
<div id="struk" class="struk-container">
    <div class="struk-header">
        <!-- Logo -->
        <img src="../assets/img/logo.png" alt="RentDrive Logo" class="struk-logo">
        <h3 class="struk-title">RentDrive</h3>
        <p class="struk-address">Jl. Raya No. 123, Surakarta</p>
        <p class="struk-phone">Telp: (0271) 123456</p>
    </div>
    
    <div class="struk-body">
        <hr class="struk-divider">
        
        <div class="struk-details">
            <p><strong>ID Sewa:</strong> <?= $row['id_sewa'] ?></p>
            <p><strong>Tanggal Sewa:</strong> <?= $row['tgl_sewa'] ?></p>
            <p><strong>Tanggal Kembali:</strong> <?= $row['tgl_kembali'] ?></p>
        </div>

        <div class="struk-details">
            <p><strong>Penyewa:</strong> <?= $row['penyewa_nama'] ?> (<?= $row['kontak'] ?>)</p>
            <p><strong>Kendaraan:</strong> <?= $row['kendaraan_nomor'] ?> - <?= $row['kendaraan_merek'] ?></p>
        </div>

        <div class="struk-details">
            <p><strong>Harga Per Hari:</strong> Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
            <p><strong>Jumlah Hari:</strong> <?= $row['jumlah'] ?></p>
        </div>

        <div class="struk-total">
            <p><strong>Total Harga:</strong> Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></p>
        </div>

        <hr class="struk-divider">
    </div>

    <div class="struk-footer">
        <p class="struk-thank-you">Terima kasih atas kepercayaan Anda!</p>
        <p class="struk-contact">Silakan hubungi kami jika ada pertanyaan.</p>
    </div>
</div>



<!-- Modal Edit Data -->
<div class="modal fade" id="editModal<?= $row['id_sewa'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Penyewaan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../config/edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_sewa" value="<?= $row['id_sewa'] ?>">
                    <div class="form-group">
                        <label for="tgl_sewa">Tanggal Sewa</label>
                        <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" value="<?= $row['tgl_sewa'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= $row['tgl_kembali'] ?>" required>
                    </div>
                    <div class="form-group">
    <label for="id_penyewa">Penyewa</label>
    <select class="form-control" id="id_penyewa" name="id_penyewa" required>
        <?php 
        $penyewaResult = $conn->query("SELECT * FROM detail_penyewa");
        while ($penyewa = $penyewaResult->fetch_assoc()) {
            $selected = $penyewa['id_penyewa'] == $row['id_penyewa'] ? 'selected' : '';
            echo "<option value='" . $penyewa['id_penyewa'] . "' " . $selected . ">" . $penyewa['nama'] . "</option>";
        } 
        ?>
    </select>
</div>
<div class="form-group">
    <label for="id_admin">Admin</label>
    <select class="form-control" id="id_admin" name="id_admin" required>
        <?php 
        $adminResult = $conn->query("SELECT * FROM admin");
        while ($admin = $adminResult->fetch_assoc()) {
            $selected = $admin['id_admin'] == $row['id_admin'] ? 'selected' : '';
            echo "<option value='" . $admin['id_admin'] . "' " . $selected . ">" . $admin['nama'] . "</option>";
        } 
        ?>
    </select>
</div>
<div class="form-group">
    <label for="id_kendaraan">Kendaraan</label>
    <select class="form-control" id="id_kendaraan" name="id_kendaraan" required>
        <?php 
        $kendaraanResult = $conn->query("SELECT * FROM kendaraan");
        while ($kendaraan = $kendaraanResult->fetch_assoc()) {
            $selected = $kendaraan['id_ken'] == $row['id_kendaraan'] ? 'selected' : '';
            echo "<option value='" . $kendaraan['id_ken'] . "' " . $selected . ">" . $kendaraan['nomor'] . " - " . $kendaraan['merek'] . "</option>";
        } 
        ?>
    </select>
</div>
<div class="form-group">
    <label for="jumlah">Jumlah</label>
    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $row['jumlah'] ?>" required>
</div>
<div class="form-group">
    <label for="total_harga">Total Harga</label>
    <input type="number" class="form-control" id="total_harga" name="total_harga" value="<?= $row['total_harga'] ?>" required>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</div>
</form>
</div>
</div>
</div>
<?php endwhile; ?>
</tbody>
</table>
</div>s
<?php 
$conn->close(); 
?>