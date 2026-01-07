<?php
    session_start();
    // Jika user sudah login, arahkan langsung ke dashboard
    if(isset($_SESSION["is_login"])){
        header("location: dashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris System - Kelola Barang Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 80vh;
            display: flex;
            align-items: center;
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
    </style>
</head>
<body>

    <?php include "layout/header.php" ?>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-dark mb-3">
                        Kelola Inventaris Jadi Lebih Mudah
                    </h1>
                    <p class="lead text-muted mb-4">
                        Sistem manajemen barang modern untuk membantu Anda memantau stok, lokasi barang, dan laporan secara real-time.
                    </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="login.php" class="btn btn-primary btn-lg px-4 me-md-2">Masuk Sekarang</a>
                        <a href="register.php" class="btn btn-outline-success btn-lg px-4">Daftar Akun</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://img.freepik.com/free-vector/warehouse-logistics-concept-illustration_114360-1594.jpg" 
                         alt="Inventaris Ilustrasi" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon mx-auto">1</div>
                    <h4>Mudah Digunakan</h4>
                    <p class="text-muted">Tampilan antarmuka yang simpel dan intuitif bagi pemula sekalipun.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon mx-auto bg-success">2</div>
                    <h4>Keamanan Data</h4>
                    <p class="text-muted">Password dienkripsi dengan standar keamanan tinggi dan aman dari peretasan.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon mx-auto bg-info">3</div>
                    <h4>Akses di Mana Saja</h4>
                    <p class="text-muted">Responsif dan dapat diakses dengan nyaman melalui HP, Tablet, maupun PC.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <hr class="my-5">
    </div>

    <?php include "layout/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>