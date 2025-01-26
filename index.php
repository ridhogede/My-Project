<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>RentDrive</title>
    <link rel="icon" href="assets/img/Logo.png" type="image/png">
    <style>
      body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
      
      /* .navbar {
        background-color:rgba(150, 150, 150, 0.97); Navbar putih
      } */
      .navbar-brand {
        font-weight: bold;
      }
      .brand-title span {
        font-weight: bold;
      }
      .brand-title .text-primary {
        color: #007bff !important;
      }
      .brand-title .text-success {
        color: #28a745 !important;
      }
      footer {
        background-color: #f1f1f1; /* Footer dengan warna abu terang */
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg shadow-sm bg-dark">
      <div class="container">
        <a class="navbar-brand brand-title" href="#">
          <img src="assets/img/Logo.png" alt="logo" width="60" class="me-2 bg-light rounded-circle">
          <span class="text-primary">Rent</span><span class="text-success">Drive</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="#homeSection">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#aboutSection">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#footer">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Home Section -->
    <section id="homeSection" class="p-5 text-center vh-100 d-flex flex-column justify-content-center shadow">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 text-start animate__animated animate__fadeInLeft">
            <h1 class="display-4 fw-bold brand-title">
              <span class="text-primary">Rent</span><span class="text-success">Drive</span>
            </h1>
            <p class="lead text-secondary">"Temukan solusi perjalanan Anda dengan layanan penyewaan kendaraan terpercaya kami!"</p>
            <a href="login.php" class="btn btn-primary btn-lg">LOGIN</a>
          </div>
          <div class="col-md-6 animate__animated animate__fadeInRight">
            <img src="assets/img/27-Ninja zx6r.png" alt="Hero Image" class="img-fluid rounded">
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="aboutSection" class="p-5 bg-white shadow">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="brand-title">
            <span class="text-primary">Rent</span><span class="text-success">Drive</span>
          </h2>
        </div>
        <div class="row align-items-center">
          <div class="col-md-6 animate__animated animate__fadeInLeft">
            <p>Kami percaya bahwa efisiensi adalah kekuatan, dan setiap pemilik bisnis rental kendaraan berhak mendapatkan alat yang memudahkan pengelolaan usaha mereka. Inilah sebabnya kami menciptakan RentDrive, sebuah sistem manajemen penyewaan kendaraan yang dirancang khusus untuk membantu pemilik atau admin bisnis rental.</p>
          </div>
          <div class="col-md-6 text-center animate__animated animate__fadeInRight">
            <img src="assets/img/Logo.png" alt="About Image" class="img-fluid" width="250">
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="py-4 text-dark shadow-lg">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-4">
            <h5>Address</h5>
            <p>JL Budi Utomo Pasar Baru Jakarta Pusat</p>
          </div>
          <div class="col-md-4">
            <h5 class="brand-title">
              <span class="text-primary">Rent</span><span class="text-success">Drive</span>
            </h5>
          </div>
          <div class="col-md-4">
            <h5>Follow Us</h5>
            <div class="d-flex justify-content-center gap-3">
              <a href="#" class="text-dark fs-4"><i class="fa-brands fa-github"></i></a>
              <a href="#" class="text-dark fs-4"><i class="fa-brands fa-telegram"></i></a>
              <a href="#" class="text-dark fs-4"><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>
        </div>
        <hr>
        <div class="text-center">
          <p class="mb-0">&copy; 2023 Mangandaralam Sakti</p>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
