<?php
// Membaca data histori dari file JSON
$file = '../config/history_log.json'; // Nama file JSON
$history = [];
$total_pendapatan = 0;
$kendaraan_disewa = [];
$penyewa_unik = [];

// Periksa apakah file historis ada
if (file_exists($file)) {
    // Membaca file dan mendekode data JSON
    $history = json_decode(file_get_contents($file), true);

    // Menghitung pendapatan bulan ini, kendaraan yang disewa, dan penyewa unik
    $current_month = date('m');
    $current_year = date('Y');

    foreach ($history as $entry) {
        // Filter data untuk bulan ini
        $entry_date = date('Y-m', strtotime($entry['tgl_sewa']));
        if ($entry_date === "$current_year-$current_month") {
            $total_pendapatan += $entry['total_harga'];
            // Menambahkan kendaraan yang disewa
            $kendaraan_disewa[$entry['kendaraan_nomor']] = true;
            // Menambahkan penyewa unik
            $penyewa_unik[$entry['penyewa_nama']] = true;
        }
    }
}
$jumlah_transaksi = count($history); // Menghitung jumlah histori transaksi
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-4">
        <h2>Histori Penyewaan</h2>

        <div class="row">
    <!-- Info Jumlah Histori Transaksi -->
    <div class="col-md-3 mb-4" data-aos="fade-up">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-file-earmark-text"></i> Jumlah Histori Transaksi</h5>
                <p class="card-text"><?php echo $jumlah_transaksi; ?> transaksi</p>
            </div>
        </div>
    </div>

    <!-- Info Pendapatan Bulan Ini -->
    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cash"></i> Pendapatan Bulan Ini</h5>
                <p class="card-text">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></p>
            </div>
        </div>
    </div>

    <!-- Info Kendaraan yang Disewa -->
    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-car-front"></i> Kendaraan yang Disewa</h5>
                <p class="card-text"><?php echo count($kendaraan_disewa); ?> kendaraan</p>
            </div>
        </div>
    </div>

    <!-- Info Total Penyewa -->
    <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="600">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-person-fill"></i> Total Penyewa</h5>
                <p class="card-text"><?php echo count($penyewa_unik); ?> penyewa</p>
            </div>
        </div>
    </div>
</div>



        <?php if (count($history) > 0): ?>
            <table class="table mt-4 table-lg table-bordered shadow table-hover">
                <thead class="bg-dark">
                    <tr class="text-white">
                        <th>ID Sewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Admin</th>
                        <th>Nomor Kendaraan</th>
                        <th>Merek Kendaraan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Penyewa</th>
                        <th>Kontak Penyewa</th>
                        <th>Status Kendaraan</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Timestamp</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $entry): ?>
                        <tr>
                            <td><?php echo $entry['id_sewa']; ?></td>
                            <td><?php echo $entry['tgl_sewa']; ?></td>
                            <td><?php echo $entry['tgl_kembali']; ?></td>
                            <td><?php echo $entry['admin_nama']; ?></td>
                            <td><?php echo $entry['kendaraan_nomor']; ?></td>
                            <td><?php echo $entry['kendaraan_merek']; ?></td>
                            <td><?php echo $entry['jenis_kendaraan']; ?></td>
                            <td><?php echo $entry['penyewa_nama']; ?></td>
                            <td><?php echo $entry['penyewa_kontak']; ?></td>
                            <td><?php echo $entry['kendaraan_status']; ?></td>
                            <td><?php echo $entry['jumlah']; ?></td>
                            <td>Rp <?php echo number_format($entry['total_harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $entry['timestamp']; ?></td>
                            <td>
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?php echo $entry['id_sewa']; ?>">Lihat Detail <i class="bi bi-info-circle"></i></button>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal<?php echo $entry['id_sewa']; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?php echo $entry['id_sewa']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel<?php echo $entry['id_sewa']; ?>">Detail Penyewaan ID: <?php echo $entry['id_sewa']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <li><strong>ID Sewa:</strong> <?php echo $entry['id_sewa']; ?></li>
                                            <li><strong>Tanggal Sewa:</strong> <?php echo $entry['tgl_sewa']; ?></li>
                                            <li><strong>Tanggal Kembali:</strong> <?php echo $entry['tgl_kembali']; ?></li>
                                            <li><strong>Admin:</strong> <?php echo $entry['admin_nama']; ?></li>
                                            <li><strong>Nomor Kendaraan:</strong> <?php echo $entry['kendaraan_nomor']; ?></li>
                                            <li><strong>Merek Kendaraan:</strong> <?php echo $entry['kendaraan_merek']; ?></li>
                                            <li><strong>Jenis Kendaraan:</strong> <?php echo $entry['jenis_kendaraan']; ?></li>
                                            <li><strong>Penyewa:</strong> <?php echo $entry['penyewa_nama']; ?></li>
                                            <li><strong>Kontak Penyewa:</strong> <?php echo $entry['penyewa_kontak']; ?></li>
                                            <li><strong>Status Kendaraan:</strong> <?php echo $entry['kendaraan_status']; ?></li>
                                            <li><strong>Jumlah:</strong> <?php echo $entry['jumlah']; ?></li>
                                            <li><strong>Total Harga:</strong> Rp <?php echo number_format($entry['total_harga'], 0, ',', '.'); ?></li>
                                            <li><strong>Timestamp:</strong> <?php echo $entry['timestamp']; ?></li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada histori untuk ditampilkan.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init({
    duration: 1000, // Durasi animasi dalam milidetik
    delay: 200, // Delay sebelum animasi dimulai
    once: true // Animasi hanya terjadi sekali
    });
    </script>

</body>
</html>
