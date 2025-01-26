
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/Logo.png" type="image/png">
    <style>

@keyframes falling {
      0% {
        opacity: 0;
        transform: translateY(-100px) scale(0.8);
      }
      60% {
        opacity: 0.8;
        transform: translateY(20px) scale(1.02);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
      }

      .falling-animation {
        animation: falling 1s ease-out;
      }   
      body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
      }

      .gradient-custom-2 {
        background: linear-gradient(to right, #5d6d7e, rgb(124, 168, 212), rgb(130, 211, 160));
      }

      @media (min-width: 768px) {
        .gradient-form {
          height: 100vh !important;
        }
      }

      .btn-back {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: rgba(0, 0, 0, 0.2);
        color: #fff;
        border-radius: 25px;
        padding: 10px 15px;
        font-weight: bold;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
      }

      .btn-back:hover {
        background-color: #555;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }

      .btn-back i {
        margin-right: 8px;
      }

      .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
      }

      .btn-primary {
        background: linear-gradient(135deg, rgb(86, 109, 133), rgb(159, 187, 214));
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: bold;
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background: linear-gradient(135deg, rgb(147, 179, 209), rgb(78, 104, 131));
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
      }

      .password-container {
        position: relative;
      }

      .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
      }

      .toggle-password:hover {
        color: #0d6efd;
      }
      .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
      }
    </style>
  </head>
  <body>
    <!-- Back Button -->
    <a href="index.php" class="btn-back"><i class="fas fa-arrow-left"></i>Back to Home</a>

    <section class="h-100 gradient-form" style="background-color: #eee">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black falling-animation">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
                    <div class="text-center">
                      <img src="assets/img/Logo.png" style="width: 185px" alt="logo" />
                      <h4 class="mt-1 mb-5 pb-1">We are The RentDrive Team</h4>
                    </div>

                    <!-- Tampilkan notifikasi error jika ada -->
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] == 1) {
                        echo '<div class="alert-danger text-center">Username atau password salah!</div>';
                    }
                    ?>

                    <form action="config/process_login.php" method="POST">
                      <p>Please login to your account</p>

                      <!-- Input Username -->
                      <div class="form-outline mb-4">
                        <label class="form-label" for="username">Username</label>
                        <input
                          type="text"
                          class="form-control"
                          id="username"
                          name="username"
                          placeholder="Username Anda"
                          required
                        />
                      </div>

                      <!-- Input Password -->
                      <div class="form-outline mb-4 password-container">
  <label class="form-label" for="password">Password</label>
  <div class="input-group">
    <input
      type="password"
      class="form-control"
      id="password"
      name="password"
      placeholder="Password Anda"
      required
    />
    <span class="input-group-text">
      <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
    </span>
  </div>
</div>

                      <!-- Button Login -->
                      <div class="d-grid pt-1 mb-4">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                      </div>

                      <!-- Create New Account -->
                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <a href="register.php" class="btn btn-outline-danger">Create new</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4 text-white fw-bold">We are more than just a company</h4>
                    <p class="small mb-0 text-white fw-semibold">
                    Rentdrive hadir untuk membantu Anda mengelola penyewaan kendaraan dengan mudah dan efisien. Dengan fitur-fitur yang dirancang khusus untuk pemilik usaha, Rentdrive memastikan pembukuan menjadi rapi dan terorganisir, sehingga Anda dapat fokus pada pengembangan bisnis Anda.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Add FontAwesome for Icon -->
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>

    <!-- JavaScript for Toggle Password Visibility -->
    <script>
      function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          toggleIcon.classList.remove('fa-eye');
          toggleIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          toggleIcon.classList.remove('fa-eye-slash');
          toggleIcon.classList.add('fa-eye');
        }
      }
    </script>
  </body>
</html>
