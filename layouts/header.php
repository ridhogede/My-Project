<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style//animasi.css">
    <link rel="icon" href="../assets/img/Logo.png" type="image/png">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        
        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
            background-color: #f8f9fa;
            /* text-align: center; */
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        th {
          font-weight: 520;
        }
        

        /* Struk */


        /* Container untuk Struk */
.struk-container {
  max-width: 420px;
  margin: 0 auto;
  padding: 20px;
  font-family: "Roboto", sans-serif;
  background: linear-gradient(to right, #f7f8f9, #ffffff);
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  display: none; /* Menyembunyikan struk sampai tombol print diklik */
}

/* Header Struk */
.struk-header {
  text-align: center;
  margin-bottom: 20px;
  border-bottom: 2px solid #4caf50;
  padding-bottom: 15px;
}

.struk-logo {
  width: 120px;
  margin-bottom: 10px;
}

.struk-title {
  margin: 0;
  font-size: 30px;
  font-weight: bold;
  color: #4caf50;
  text-transform: uppercase;
}

.struk-address,
.struk-phone {
  margin: 0;
  font-size: 14px;
  color: #666;
}

/* Divider Horizontal */
.struk-divider {
  border: 1px solid #ddd;
  margin: 15px 0;
}

/* Detail Struk */
.struk-details {
  margin-bottom: 15px;
  font-size: 14px;
  color: #333;
}

.struk-details p {
  margin: 5px 0;
}

/* Total Harga */
.struk-total {
  margin-top: 20px;
  font-size: 18px;
  font-weight: bold;
  color: #333;
}

/* Footer Struk */
.struk-footer {
  text-align: center;
  margin-top: 30px;
}

.struk-thank-you,
.struk-contact {
  font-size: 12px;
  color: #555;
}

/* Efek Hover untuk Struk */
.struk-container:hover {
  transform: scale(1.02);
  transition: all 0.3s ease-in-out;
}

@media print {
  body * {
    visibility: hidden; /* Menyembunyikan semua elemen lain saat print */
  }

  .struk-container,
  .struk-container * {
    visibility: visible; /* Menampilkan hanya elemen struk */
  }

  .struk-container {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    max-width: 1280px;
    padding: 10px;
    margin: 0;
    background-color: white;
    border: none;
    box-shadow: none;
  }

  .struk-details {
    font-size: 14px;
  }

  .struk-footer {
    margin-top: 20px;
    font-size: 12px;
    text-align: center;
  }

  /* Pastikan tidak ada yang tersembunyi */
  .struk-details p,
  .struk-footer p {
    visibility: visible;
    margin: 5px 0;
  }
}


        /* Animasi Zoom-In */
.zoom-in {
  animation-delay: 800;
  opacity: 0;
  transform: scale(0.8);
  animation: zoomIn 0.7s cubic-bezier(0.25, 1, 0.5, 1) forwards;
}

@keyframes zoomIn {
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Animasi Swipe In (Dari Kiri) */
.swipe-in {
  opacity: 0;
  transform: translateX(-100%);
  animation: swipeIn 0.8s ease-out forwards;
}

@keyframes swipeIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Animasi Bounce-In */
.bounce-in {
  animation: bounceIn 1s ease forwards;
}

@keyframes bounceIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  50% {
    opacity: 0.9;
    transform: scale(1.1);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

/* Animasi Modal */
@keyframes modalBounce {
  0% {
    transform: translateY(-200px) scale(0.8);
    opacity: 0;
  }
  50% {
    transform: translateY(20px) scale(1.1);
    opacity: 0.9;
  }
  100% {
    transform: translateY(0) scale(1);
    opacity: 1;
  }
}

.modal.fade .modal-dialog {
  animation: modalBounce 0.6s ease-out;
}

/* Pagination Transition */
.pagination .page-link {
  transition: transform 0.3s, background-color 0.3s;
}

.pagination .page-link:hover {
  transform: scale(1.2);
  background-color: #007bff;
  color: white;
}

/* Tombol dengan efek hover */
.btn-primary,
.btn-warning,
.btn-danger {
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.btn-primary::before,
.btn-warning::before,
.btn-danger::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 200%;
  height: 100%;
  background: rgba(255, 255, 255, 0.2);
  transform: skewX(-30deg);
  transition: all 0.5s ease-in-out;
  z-index: -1;
}

.btn-primary:hover::before,
.btn-warning:hover::before,
.btn-danger:hover::before {
  left: 100%;
}



    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">
        <img src="../assets/img/Logo.png" alt="logo" width="60" class="me-2 bg-light rounded-circle">
        <h2 class="fw-bold text-success"><span class="text-primary">Rent</span>Drive</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link mx-1 m-2" data-aos="fade-down" data-aos-delay="50" href="index.php?page=dashboard"><i class="bi bi-house-door" data-aos="fade-down" data-aos-delay="50"></i> Dashboard</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link mx-1 m-2" data-aos="fade-down" data-aos-delay="60" href="index.php?page=kendaraan"><i class="bi bi-car-front" data-aos="fade-down" data-aos-delay="60"></i> Data Kendaraan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 m-2" data-aos="fade-down" data-aos-delay="70" href="index.php?page=penyewa"><i class="bi bi-person" data-aos="fade-down" data-aos-delay="70"></i> Data Penyewa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 m-2" data-aos="fade-down" data-aos-delay="80" href="index.php?page=penyewaan"><i class="bi bi-folder" data-aos="fade-down" data-aos-delay="80"></i> Data Penyewaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 m-2" data-aos="fade-down" data-aos-delay="90" href="index.php?page=histori"><i class="bi bi-clock-history" data-aos="fade-down" data-aos-delay="90"></i> Histori Penyewaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger mx-1 m-2" data-aos="fade-left" data-aos-delay="100" href="../config/logout.php"> <i class="bi bi-box-arrow-right" data-aos="fade-right" data-aos-delay="100"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 text-center">
        <h1 class="bounce-in">Selamat Datang, <?php echo $_SESSION['admin']; ?> ｡^‿^｡</h1>
        <p class="bounce-in">Gunakan menu di atas untuk mengelola data penyewaan kendaraan.</p>
    </div>