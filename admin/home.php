<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'nyewa');

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data untuk filter jenis kendaraan
$jenisQuery = "SELECT * FROM jenis";
$jenisResult = $conn->query($jenisQuery);

// Mendapatkan parameter filter
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$jenisFilter = isset($_GET['jenis']) ? $_GET['jenis'] : '';

// Pagination
$dataPerPage = isset($_GET['dataPerPage']) && is_numeric($_GET['dataPerPage']) ? (int)$_GET['dataPerPage'] : 10; // Jumlah data per halaman
$page = isset($_GET['page_num']) && is_numeric($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
$offset = ($page - 1) * $dataPerPage;

// Query untuk menghitung total data
$countQuery = "SELECT COUNT(*) AS total FROM kendaraan 
               LEFT JOIN jenis ON kendaraan.id_jenis = jenis.id_jenis
               WHERE (kendaraan.status LIKE '%$statusFilter%' OR '$statusFilter' = '')
               AND (jenis.id_jenis LIKE '%$jenisFilter%' OR '$jenisFilter' = '')";
$countResult = $conn->query($countQuery);
$totalData = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $dataPerPage);

// Query utama dengan LIMIT dan OFFSET
$query = "SELECT penyewaan.id_sewa, penyewaan.tgl_sewa, penyewaan.tgl_kembali, 
                 admin.nama AS admin_nama, 
                 kendaraan.nomor AS kendaraan_nomor, kendaraan.merek AS kendaraan_merek, 
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
          WHERE (kendaraan.status LIKE '%$statusFilter%' OR '$statusFilter' = '')
          AND (jenis.id_jenis LIKE '%$jenisFilter%' OR '$jenisFilter' = '')
          LIMIT $dataPerPage OFFSET $offset";

$result = $conn->query($query);
?>

<body>
    <div class="container mt-4">
        <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Dashboard Kendaraan</h1>

        <!-- Form untuk filter -->
        <form class="mb-4" method="GET" action="">
            <div class="row">
                <!-- Filter Status -->
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <select class="form-select" name="status">
                        <option value="">Semua Status</option>
                        <option value="Tersedia" <?= $statusFilter == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Disewa" <?= $statusFilter == 'Disewa' ? 'selected' : '' ?>>Disewa</option>
                    </select>
                </div>
                <!-- Filter Jenis Kendaraan -->
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <select class="form-select" name="jenis">
                        <option value="">Semua Jenis Kendaraan</option>
                        <?php while ($jenisRow = $jenisResult->fetch_assoc()) { ?>
                            <option value="<?= $jenisRow['id_jenis'] ?>" <?= $jenisFilter == $jenisRow['id_jenis'] ? 'selected' : '' ?>>
                                <?= $jenisRow['nama'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Tombol Submit -->
                <div class="col-md-2" data-aos="fade-up" data-aos-delay="600">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <form method="GET" class="d-flex align-items-center mb-3" data-aos="fade-up" data-aos-delay="700">
    <label for="dataPerPage" class="me-2">Data per Halaman:</label>
    <select name="dataPerPage" id="dataPerPage" class="form-select w-auto" onchange="this.form.submit()">
        <option value="5" <?= $dataPerPage == 5 ? 'selected' : '' ?>>5</option>
        <option value="10" <?= $dataPerPage == 10 ? 'selected' : '' ?>>10</option>
        <option value="20" <?= $dataPerPage == 20 ? 'selected' : '' ?>>20</option>
    </select>
</form>


        <table class="table table-bordered shadow table-hover shadow-lg">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>Nomor Kendaraan</th>
                    <th>Merek</th>
                    <th>Jenis Kendaraan</th>
                    <th>Status</th>
                    <th>Penyewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total Harga</th>
                    <th>Tersisa Hari</th>
                    <th>Detail</th> <!-- Kolom untuk tombol Detail -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['kendaraan_nomor'] ?></td>
                        <td><?= $row['kendaraan_merek'] ?></td>
                        <td><?= $row['jenis_kendaraan'] ?></td>
                        <td>
                            <?php
                            if ($row['kendaraan_status'] == 'Tersedia') {
                                echo '<span class="badge bg-success">Tersedia</span>';
                            } else {
                                echo '<span class="badge bg-danger">Disewa</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['kendaraan_status'] == 'Disewa') {
                                echo $row['penyewa_nama'] . " (" . $row['penyewa_kontak'] . ")";
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <?php if ($row['kendaraan_status'] == 'Disewa') {
                                echo $row['tgl_sewa'];
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <?php if ($row['kendaraan_status'] == 'Disewa') {
                                echo $row['tgl_kembali'];
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                            <?php if ($row['kendaraan_status'] == 'Disewa') {
                                echo "Rp " . number_format($row['total_harga'], 0, ',', '.');
                            } else {
                                echo "-";
                            } ?>
                        </td>
                        <td>
                        <?php 
                            if ($row['kendaraan_status'] == 'Disewa') {
                            $tgl_kembali = new DateTime($row['tgl_kembali']);
                            $today = new DateTime();
                            $interval = $today->diff($tgl_kembali);
                            $remainingDays = $interval->format('%a');
            
                            if ($remainingDays >= 0) {
                            // Jika sisa hari lebih dari atau sama dengan 0, tampilkan sisa hari
                             echo $remainingDays . " Hari";
                            // Jika kurang dari 3 hari, beri notifikasi
                            if ($remainingDays <= 3) {
                             echo ' <span class="badge bg-warning">Akan Kembali</span>';
                            }
                            } else {
                            // Jika tanggal pengembalian sudah lewat
                             echo "Sewa Tamat <span class='badge bg-danger'>Terlambat</span>";
                            }
                            } else {
                             echo "-";
                            }
                        ?>
                        </td>
                        <td>
                            <?php if ($row['kendaraan_status'] == 'Disewa') { ?>
                                <!-- Tombol untuk membuka modal dengan data ID Sewa -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail<?= $row['id_sewa'] ?>">
                                    Lihat Detail <i class="bi bi-info-circle"></i>
                                </button>
                            <?php } else { ?>
                                <!-- Tidak ada tombol Detail jika kendaraan tersedia -->
                                -
                            <?php } ?>
                        </td>
                    </tr>


                    <!-- Modal untuk menampilkan detail transaksi -->
                    <?php if ($row['kendaraan_status'] == 'Disewa') { ?>
                        <div class="modal fade" id="modalDetail<?= $row['id_sewa'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['id_sewa'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel<?= $row['id_sewa'] ?>">Detail Transaksi ID Sewa: <?= $row['id_sewa'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Admin:</strong> <?= $row['admin_nama'] ?></p>
                                        <p><strong>Penyewa:</strong> <?= $row['penyewa_nama'] ?> (<?= $row['penyewa_kontak'] ?>)</p>
                                        <p><strong>Tanggal Sewa:</strong> <?= $row['tgl_sewa'] ?></p>
                                        <p><strong>Tanggal Kembali:</strong> <?= $row['tgl_kembali'] ?></p>
                                        <p><strong>Kendaraan:</strong> <?= $row['kendaraan_nomor'] ?> - <?= $row['kendaraan_merek'] ?></p>
                                        <p><strong>Jenis Kendaraan:</strong> <?= $row['jenis_kendaraan'] ?></p>
                                        <p><strong>Status Kendaraan:</strong> <?= $row['kendaraan_status'] ?></p>
                                        <p><strong>Total Harga:</strong> Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="mt-4">
    <nav data-aos="fade-up" data-aos-delay="200">
        <ul class="pagination justify-content-center">
            <!-- Tombol Previous -->
            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?status=<?= $statusFilter ?>&jenis=<?= $jenisFilter ?>&page_num=<?= $page - 1 ?>">Previous</a>
            </li>

            <!-- Tombol Angka Halaman -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?status=<?= $statusFilter ?>&jenis=<?= $jenisFilter ?>&page_num=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Tombol Next -->
            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                <a class="page-link" href="?status=<?= $statusFilter ?>&jenis=<?= $jenisFilter ?>&page_num=<?= $page + 1 ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
    </div>
</body>

<?php 
$conn->close(); 
?>
