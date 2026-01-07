<?php
    include "services/database.php";
    session_start();
    $register_message = "";

    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
        exit();
    }

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validasi: Cek apakah input kosong atau hanya spasi
        if (trim($username) == "" || trim($password) == "") {
            $register_message = "Username dan password tidak boleh kosong!";
        } else {
            $hash_password = hash("sha256", $password);

            try {
                // Menggunakan Prepared Statement agar AMAN
                $stmt = $db->prepare("INSERT INTO 01_tms_users (username, `password`) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $hash_password);

                if($stmt->execute()){
                    $register_message = "Daftar akun berhasil, silahkan login";
                } else {
                    $register_message = "Daftar akun gagal, silahkan coba lagi";
                }
                $stmt->close();
            } catch (mysqli_sql_exception $e) {
                // Cek jika errornya karena username sudah ada (Duplicate Entry)
                if ($e->getCode() == 1062) {
                    $register_message = "Username sudah terdaftar, cari yang lain";
                } else {
                    $register_message = "Terjadi kesalahan sistem";
                }
            }
        }
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Inventaris System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            margin-top: 80px;
            max-width: 400px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background: #198754; /* Warna hijau agar beda sedikit dengan login (biru) */
            color: white;
            border-radius: 15px 15px 0 0 !important;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

    <?php include "layout/header.php" ?>

    <div class="container d-flex justify-content-center">
        <div class="register-container w-100">
            
            <?php if($register_message): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= $register_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">DAFTAR AKUN</h4>
                    <small>Buat akun baru untuk mengelola inventaris</small>
                </div>
                <div class="card-body p-4">
                    <form action="register.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username Baru</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Buat password minimal 6 karakter" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="register" class="btn btn-success btn-lg">Daftar Sekarang</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <p class="mb-0">Sudah punya akun? <a href="login.php" class="text-decoration-none">Login di sini</a></p>
                </div>
            </div>
            
            <div class="text-center mt-3 text-muted">
                <small>&copy; 2025 Inventaris App</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php include "layout/footer.php" ?>
</body>
</html>