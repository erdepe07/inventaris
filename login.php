<?php
    include "services/database.php";
    session_start();
    $login_message = "";

    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
        exit();
    }

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);

        // --- BAGIAN YANG DIUBAH (PREPARED STATEMENT) ---
        // 1. Siapkan template query dengan (?) sebagai placeholder
        $stmt = $db->prepare("SELECT * FROM 01_tms_users WHERE username = ? AND password = ?");
        
        // 2. Masukkan data ke dalam template ( "ss" berarti ada 2 data bertipe String )
        $stmt->bind_param("ss", $username, $hash_password);
        
        // 3. Jalankan perintahnya
        $stmt->execute();
        
        // 4. Ambil hasilnya
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["is_login"] = true;
            
            header("location: dashboard.php");
            exit();
        } else {
            $login_message = "Username atau password salah!";
        }
        
        // 5. Tutup statement dan database
        $stmt->close();
        $db->close();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventaris System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-header { background: #0d6efd; color: white; border-radius: 15px 15px 0 0 !important; text-align: center; padding: 20px; }
    </style>
</head>
<body>

    <?php include "layout/header.php" ?>

    <div class="container d-flex justify-content-center">
        <div class="login-container w-100">
            
            <?php if($login_message): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $login_message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">MASUK AKUN</h4>
                    <small>Silahkan login untuk melanjutkan</small>
                </div>
                <div class="card-body p-4">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary btn-lg">Masuk Sekarang</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <p class="mb-0">Belum punya akun? <a href="register.php" class="text-decoration-none">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include "layout/footer.php" ?>
</body>
</html>