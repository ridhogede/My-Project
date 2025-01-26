<?php
require '../config/koneksi.php';

// Logika untuk CRUD penyewa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_renter'])) {
        // Tambah Penyewa
        $id_penyewa = $_POST['id_penyewa']; // NIK sebagai ID
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $kontak = $_POST['kontak'];

        $stmt = $conn->prepare("INSERT INTO detail_penyewa (id_penyewa, nama, alamat, kontak) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $id_penyewa, $nama, $alamat, $kontak);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan!'); window.location.href='';</script>";
        }
    } elseif (isset($_POST['edit_renter'])) {
        // Edit Penyewa
        $id_penyewa = $_POST['id_penyewa']; // NIK tetap sebagai ID
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $kontak = $_POST['kontak'];

        $stmt = $conn->prepare("UPDATE detail_penyewa SET nama = ?, alamat = ?, kontak = ? WHERE id_penyewa = ?");
        $stmt->bind_param('ssss', $nama, $alamat, $kontak, $id_penyewa);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil diubah!'); window.location.href='';</script>";
        } else {
            echo "<script>alert('Data gagal diubah!'); window.location.href='';</script>";
        }
    }
}

if (isset($_POST['delete_penyewa'])) {
    $id_penyewa = $_POST['id_penyewa'];

    $stmt = $conn->prepare("DELETE FROM detail_penyewa WHERE id_penyewa = ?");
    $stmt->bind_param('i', $id_penyewa);
    if ($stmt->execute()) {
        echo "<script>alert('Penyewa berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Gagal menghapus Penyewa: {$stmt->error}');</script>";
    }
    $stmt->close();
}

// Pagination
$perhalaman = 5; // Menentukan jumlah data per halaman
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$start = ($halamanAktif - 1) * $perhalaman; // Menentukan offset untuk query

// Query untuk mengambil data penyewa dengan pagination
$query = "SELECT * FROM detail_penyewa LIMIT $start, $perhalaman";
$result = $conn->query($query);


// Menghitung total data untuk pagination
$totalQuery = "SELECT COUNT(*) AS total FROM detail_penyewa";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total'];
$totalHalaman = ceil($totalData / $perhalaman);


?>


<div class="container mt-5">
    <h1 data-aos="fade-right" data-aos-delay="100">Data Penyewa</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRenterModal" data-aos="fade-right" data-aos-delay="200"><i class="bi bi-plus-lg"></i> Tambah Penyewa</button>

    <!-- Modal Tambah Penyewa -->
    <div class="modal fade" id="addRenterModal" tabindex="-1" aria-labelledby="addRenterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRenterModalLabel">Tambah Data Penyewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_penyewa" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="id_penyewa" name="id_penyewa" maxlength="16" placeholder="Isikan NIK Penyewa" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Isikan Nama Penyewa" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isikan Alamat Lengkap Penyewa" required>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="kontak" name="kontak" placeholder="Isikan No Handphone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="add_renter" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Daftar Penyewa -->
    <table class="table mt-4 table-striped table-bordered shadow">
        <thead class="bg-dark">
            <tr class="text-white text-center">
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['id_penyewa'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['kontak'] . "</td>";
                echo "<td>
                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editRenterModal" . $row['id_penyewa'] . "'><i class='bi bi-pencil'></i> Edit</button>
                    <form action='' method='POST' class='d-inline'>
                <input type='hidden' name='id_penyewa' value='" . $row['id_penyewa'] . "'>
                <button type='submit' name='delete_penyewa' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'><i class='bi bi-trash'></i> Hapus</button>
                </form>
                </td>";
                echo "</tr>";
            ?>
                <!-- Modal Edit Penyewa -->
                <div class="modal fade" id="editRenterModal<?php echo $row['id_penyewa']; ?>" tabindex="-1" aria-labelledby="editRenterModalLabel<?php echo $row['id_penyewa']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRenterModalLabel<?php echo $row['id_penyewa']; ?>">Edit Penyewa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="id_penyewa" class="form-label">NIK</label>
                                        <input type="text" class="form-control" id="id_penyewa" name="id_penyewa" value="<?php echo $row['id_penyewa']; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kontak" class="form-label">Kontak</label>
                                        <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $row['kontak']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="edit_renter" class="btn btn-primary">Simpan</button>
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
    <nav>
    <ul class="pagination justify-content-center">
        <!-- Tombol Previous -->
        <li class="page-item <?= $halamanAktif == 1 ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=penyewa&halaman=<?= $halamanAktif - 1 ?>">Previous</a>
        </li>

        <!-- Nomor Halaman -->
        <?php for ($i = 1; $i <= $totalHalaman; $i++) : ?>
            <li class="page-item <?= $halamanAktif == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=penyewa&halaman=<?= $i; ?>"><?= $i; ?></a>
            </li>
        <?php endfor; ?>

        <!-- Tombol Next -->
        <li class="page-item <?= $halamanAktif == $totalHalaman ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=penyewa&halaman=<?= $halamanAktif + 1 ?>">Next</a>
        </li>
    </ul>
</nav>

</div>
