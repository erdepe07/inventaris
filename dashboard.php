<?php
    session_start();

    // --- PROTEKSI HALAMAN ---
    // Jika tidak ada session login, tendang balik ke halaman login
    if (!isset($_SESSION["is_login"])) {
        header("location: login.php");
        exit();
    }

    // Logika Logout
    if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header('location: index.php');
        exit();            
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventaris System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .dashboard-hero {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .stats-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.3s;
        }
        .stats-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <?php include "layout/header.php" ?>

    <div class="container py-5">
        <div class="dashboard-hero d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">Selamat Datang, <?= $_SESSION["username"] ?>! 👋</h2>
                <p class="text-muted mb-0">Hari ini adalah waktu yang tepat untuk mengecek stok barang.</p>
            </div>
            <form action="dashboard.php" method="POST">
                <button type="submit" name="logout" class="btn btn-outline-danger d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stats-card bg-primary text-white p-3">
                    <div class="card-body">
                        <h6 class="text-uppercase small fw-bold">Total Barang</h6>
                        <h2 class="mb-0">124</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-success text-white p-3">
                    <div class="card-body">
                        <h6 class="text-uppercase small fw-bold">Barang Masuk</h6>
                        <h2 class="mb-0">12</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card bg-warning text-dark p-3">
                    <div class="card-body">
                        <h6 class="text-uppercase small fw-bold">Stok Menipis</h6>
                        <h2 class="mb-0">5</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary">Daftar Inventaris Terkini</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">ID</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4">#001</td>
                                <td class="fw-semibold">Macbook Pro M2</td>
                                <td>Elektronik</td>
                                <td><span class="badge bg-success">15 Unit</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4">#002</td>
                                <td class="fw-semibold">Kursi Kerja Ergonamik</td>
                                <td>Furniture</td>
                                <td><span class="badge bg-warning text-dark">3 Unit</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <a href="#" class="btn btn-primary btn-sm">Lihat Semua Data</a>
            </div>
        </div>
    </div>

    <?php include "layout/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>