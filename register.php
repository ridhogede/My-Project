<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="assets/img/Logo.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 12px 15px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #0d6efd);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .logo img {
            width: 100px;
            margin-bottom: 20px;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            border-radius: 15px;
        }

        .text-center h3 {
            font-weight: bold;
            color: #343a40;
        }

        .footer-link {
            color: #0056b3;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        /* Keyframes untuk animasi slide dari bawah */
        @keyframes slideUp {
            0% {
                transform: translateY(100px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Kelas untuk mengaktifkan animasi */
        .slide-up-animation {
            animation: slideUp 0.8s ease-out;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Tambahkan kelas animasi -->
            <div class="card gradient-bg p-4 slide-up-animation">
                <div class="text-center logo">
                    <img src="assets/img/Logo.png" alt="Logo">
                </div>
                <h3 class="text-center mb-4">Create Your Account</h3>
                <form action="config/register.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukan Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password" required>
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" id="contact" name="contact" class="form-control" placeholder="Masukan Konta Anda" required>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <p class="text-center text-muted">Already have an account? <a href="login.php" class="footer-link">Login here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
</html>
