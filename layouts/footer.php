<footer id="footer" class="text-center text-white bg-dark shadow-sm" style="transform: translateY(100%); transition: transform 0.5s ease;">
    <div class="container p-4">
        <div class="row">
            <div class="col-md-6 mb-3">
                <h5 class="text-uppercase fw-bold text-success"> <span class="text-primary">Rent</span> Drive</h5>
                <p class="text-muted">
                    Solusi penyewaan kendaraan yang mudah dan efisien untuk kebutuhan Anda.
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <h5 class="text-uppercase fw-bold text-primary">Hubungi Kami</h5>
                <p>
                    <i class="bi bi-envelope"></i> support@rentdrive.com<br>
                    <i class="bi bi-telephone"></i> +62 812-3456-7890
                </p>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center mt-3">
            <p class="mb-0">&copy; 2025 RentDrive. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>


const footer = document.getElementById("footer");
let lastScrollTop = 0;

window.addEventListener("scroll", () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // Saat scroll ke bawah, footer muncul
    footer.style.transform = "translateY(0)";
  } else {
    // Saat scroll ke atas, footer tersembunyi
    footer.style.transform = "translateY(100%)";
  }
  lastScrollTop = scrollTop;
});
</script>
<script>
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
  return prefix === undefined ? rupiah : rupiah ? prefix + rupiah : "";
}

document.addEventListener("DOMContentLoaded", function () {
  const hargaInputs = document.querySelectorAll(".rupiah-input");
  hargaInputs.forEach((input) => {
    input.addEventListener("input", function (e) {
      this.value = formatRupiah(this.value, "Rp");
    });
  });
});
</script>
<script>

// Fungsi untuk menghitung total harga
function calculateTotal() {
  // Ambil nilai tanggal sewa dan tanggal kembali
  const tglSewa = document.getElementById("tgl_sewa").value;
  const tglKembali = document.getElementById("tgl_kembali").value;
  const hargaPerHari = document.getElementById("harga").value;

  // Cek jika kedua tanggal sudah dipilih dan harga per hari valid
  if (tglSewa && tglKembali && hargaPerHari) {
    // Konversi tanggal ke objek Date
    const sewaDate = new Date(tglSewa);
    const kembaliDate = new Date(tglKembali);

    // Hitung selisih tanggal dalam hari
    const diffTime = kembaliDate - sewaDate;
    const lamaSewa = diffTime / (1000 * 3600 * 24); // Menghitung selisih dalam hari

    // Jika lama sewa valid, hitung total harga
    if (lamaSewa > 0) {
      const totalHarga = lamaSewa * hargaPerHari;
      document.getElementById("total_harga").value = totalHarga;
      formatRupiah(); // Format total harga dengan format rupiah
    } else {
      // Jika lama sewa tidak valid, kosongkan total harga
      document.getElementById("total_harga").value = "";
    }
  }
}

// Fungsi untuk update harga per hari saat memilih kendaraan
function updateHargaPerHari() {
  const kendaraan = document.getElementById("id_kendaraan");
  const selectedOption = kendaraan.options[kendaraan.selectedIndex];
  const harga = selectedOption.getAttribute("data-harga");
  document.getElementById("harga").value = harga;
  calculateTotal(); // Update total harga saat harga per hari diubah
}

// Fungsi untuk format input rupiah
function formatRupiah() {
  const totalHargaInput = document.getElementById("total_harga");
  let value = totalHargaInput.value;

  // Hapus semua karakter yang bukan angka
  value = value.replace(/[^0-9]/g, "");

  // Format menjadi format rupiah
  const rupiah = new Intl.NumberFormat("id-ID").format(value);

  // Tampilkan dalam input (format rupiah)
  totalHargaInput.value = rupiah;
}

// Fungsi untuk memastikan nilai input tetap angka biasa saat form disubmit
document.querySelector("form").addEventListener("submit", function (event) {
  const totalHargaInput = document.getElementById("total_harga");
  // Hapus format rupiah sebelum submit
  totalHargaInput.value = totalHargaInput.value.replace(/[^0-9]/g, "");
});

// Format input harga per hari dengan format rupiah saat input berubah
document.getElementById("harga").addEventListener("input", function () {
  formatRupiah(); // Format harga per hari dengan format rupiah
});


document.querySelector("form").onsubmit = function () {
  var hargaInput = document.getElementById("harga");
  var harga = hargaInput.value.replace(/[^0-9]/g, ""); // Hapus karakter selain angka
  hargaInput.value = harga; // Update nilai harga
};
</script>
<script>
function printStruk() {
  var struk = document.getElementById("struk");
  struk.style.display = "block"; // Menampilkan struk
  window.print(); // Memanggil print dialog
  struk.style.display = "none"; // Menyembunyikan kembali struk setelah print
}

</script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const table = document.querySelector("table");

  // Tabel dengan efek Zoom-In hanya jika bukan karena pagination
  if (!sessionStorage.getItem("paginationTriggered")) {
    if (table) {
      table.classList.add("zoom-in");
    }
  } else {
    sessionStorage.removeItem("paginationTriggered");
  }

  // Pagination Swipe-Out Animation
  document.querySelectorAll(".page-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetURL = e.target.href;

      // Tandai bahwa pagination telah dipicu
      sessionStorage.setItem("paginationTriggered", "true");

      // Swipe-Out Table
      if (table) {
        table.classList.add("swipe-in");
      }

      // Tunggu animasi selesai sebelum pindah halaman
      setTimeout(() => {
        window.location.href = targetURL;
      }, 800);
    });
  });
});
</script>
    <script src="../assets/js/bootstrap.min.js"></script>

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