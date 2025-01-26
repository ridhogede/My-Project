<?php
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_vehicle'])) {
        $nomor = $_POST['nomor'];
        $merek = $_POST['merek'];
        $id_jenis = $_POST['id_jenis'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];

        $stmt = $conn->prepare("INSERT INTO kendaraan (nomor, merek, id_jenis, jumlah, harga) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssiii', $nomor, $merek, $id_jenis, $jumlah, $harga);
        if ($stmt->execute()) {
            // Notify success
            echo "<script>alert('Terbaru: Data berhasil ditambahkan!'); window.location.href='';</script>";
        } else {
            // Notify failure
            echo "<script>alert('Terbaru: Gagal menambahkan data!');</script>";
        }
        $stmt->close();
    } elseif (isset($_POST['edit_kendaraan'])) {
        $id_ken = $_POST['id_ken'];
        $nomor = $_POST['nomor'];
        $merek = $_POST['merek'];
        $id_jenis = $_POST['id_jenis'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];

        $stmt = $conn->prepare("UPDATE kendaraan SET nomor = ?, merek = ?, id_jenis = ?, jumlah = ?, harga = ? WHERE id_ken = ?");
        $stmt->bind_param('ssiiii', $nomor, $merek, $id_jenis, $jumlah, $harga, $id_ken);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil diubah!'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Data gagal diubah!'); window.location.href='';</script>";
        }
        $stmt->close();
    } elseif (isset($_POST['delete_vehicle'])) {
        $id_ken = $_POST['id_ken'];

        $stmt = $conn->prepare("DELETE FROM kendaraan WHERE id_ken = ?");
        $stmt->bind_param('i', $id_ken);

        if ($stmt->execute()) {
            echo "<script>alert('Kendaraan berhasil dihapus.');</script>";
        } else {
            echo "<div>alert('Gagal menghapus kendaraan: {$stmt->error}');</script>";
        }
        $stmt->close();
    }
}
function formatRupiah($angka) {
    return "Rp" . number_format($angka, 0, ',', '.');
}

// Konfigurasi Pagination
$limit = 5; // Jumlah data per halaman
$page = max(1, (isset($_GET['page']) && $_GET['page'] > 0) ? (int)$_GET['page'] : 1);

// Konfigurasi Pagination
$limit = 5; // Jumlah data per halaman
$halamanAktif = isset($_GET['halaman']) && $_GET['halaman'] > 0 ? (int)$_GET['halaman'] : 1;
$start = ($halamanAktif - 1) * $limit; // Data awal untuk query

// Hitung total data dan total halaman
$totalDataQuery = $conn->query("SELECT COUNT(*) AS total FROM kendaraan");
$totalData = $totalDataQuery->fetch_assoc()['total'];
$totalHalaman = ceil($totalData / $limit);

// Query untuk mengambil data kendaraan
$result = $conn->query("SELECT kendaraan.*, jenis.nama 
                        FROM kendaraan 
                        JOIN jenis ON kendaraan.id_jenis = jenis.id_jenis 
                        LIMIT $start, $limit");

?>
<div class="container mt-5">
    <h1 data-aos="fade-right" data-aos-delay="100">Data Kendaraan</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal" data-aos="fade-right" data-aos-delay="200"><i class="bi bi-plus-lg"></i> Tambah Kendaraan</button>

    <!-- Modal Tambah Kendaraan -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Tambah Kendaraan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nomor" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Masukan No Polisi Kendaraan" required>
                        </div>
                        <div class="mb-3">
                            <label for="merek" class="form-label">Merek Kendaraan</label>
                            <input type="text" class="form-control" id="merek" name="merek" placeholder="Masukan Merk Kendaraan" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_jenis" class="form-label">Jenis Kendaraan</label>
                            <select class="form-select" id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Kendaraan</option>
                                <?php
                                $jenisResult = $conn->query("SELECT * FROM jenis");
                                while ($jenis = $jenisResult->fetch_assoc()) {
                                    echo "<option value='" . $jenis['id_jenis'] . "'>" . $jenis['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Kendaraan</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukan Jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Per Hari</label>
                            <input type="text" class="form-control rupiah-input" id="harga" name="harga" placeholder="Masukan Harga Per Hari" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="add_vehicle" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Kendaraan -->
    <table class="table mt-4 table-striped table-bordered shadow">
        <thead class="bg-dark">
            <tr class="text-white text-center">
                <th>No</th>
                <th>Plat Nomor</th>
                <th>Merek</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Harga Per Hari</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
           
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['nomor'] . "</td>";
                echo "<td>" . $row['merek'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . formatRupiah($row['harga']) . "</td>";
                echo "<td>
                        <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editVehicleModal" . $row['id_ken'] . "'><i class='bi bi-pencil'></i> Edit</button>
                        <form action='' method='POST' class='d-inline'>
                            <input type='hidden' name='id_ken' value='" . $row['id_ken'] . "'>
                            <button type='submit' name='delete_vehicle' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='bi bi-trash'></i> Hapus</button>
                        </form>
                </td>";
                echo "</tr>";
            
            ?>

            <!-- Modal Edit -->
            <div class="modal fade" id="editVehicleModal<?php echo $row['id_ken']; ?>" tabindex="-1" aria-labelledby="editVehicleModalLabel<?php echo $row['id_ken']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editVehicleModalLabel<?php echo $row['id_ken']; ?>">Edit Kendaraan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <input type="hidden" name="id_ken" value="<?php echo $row['id_ken']; ?>">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nomor" class="form-label">Plat Nomor</label>
                                        <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $row['nomor']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="merek" class="form-label">Merek Kendaraan</label>
                                        <input type="text" class="form-control" id="merek" name="merek" value="<?php echo $row['merek']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_jenis" class="form-label">Jenis Kendaraan</label>
                                        <select class="form-select" id="id_jenis" name="id_jenis" required>
                                            <?php
                                            $jenisResult = $conn->query("SELECT * FROM jenis");
                                            while ($jenis = $jenisResult->fetch_assoc()) {
                                                $selected = $jenis['id_jenis'] == $row['id_jenis'] ? "selected" : "";
                                                echo "<option value='" . $jenis['id_jenis'] . "' $selected>" . $jenis['nama'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah Kendaraan</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label ">Harga Per Hari</label>
                                        <input type="text" class="form-control rupiah-input" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="edit_kendaraan" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>
<!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center">
        <!-- Tombol Previous -->
        <li class="page-item <?= $halamanAktif == 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=kendaraan&halaman=<?= $halamanAktif - 1 ?>">Previous</a>
        </li>

        <!-- Nomor Halaman -->
        <?php for ($i = 1; $i <= $totalHalaman; $i++) : ?>
            <li class="page-item <?= $halamanAktif == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=kendaraan&halaman=<?= $i; ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Tombol Next -->
        <li class="page-item <?= $halamanAktif == $totalHalaman ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=kendaraan&halaman=<?= $halamanAktif + 1 ?>">Next</a>
        </li>
    </ul>
</nav>

</div>
