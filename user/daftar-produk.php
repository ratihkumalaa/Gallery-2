<?php
session_start(); // Memulai session

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Fungsi Logout (jika tombol logout diklik)
if (isset($_GET['logout']) && isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); // Hapus session user_id
    session_destroy(); // Hancurkan semua session
    session_write_close(); // Pastikan tidak ada modifikasi lebih lanjut
    header("Location: login.php"); // Redirect ke halaman login
    exit();
}

// Koneksi database
include('../koneksi/koneksi.php');
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="../Bootstrap 5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Subrayada:wght@400;700&family=Poppins:wght@100;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand me-3" href="#">
                <img src="../img/logoanjai.png" alt="Logo Situs" height="40">
            </a>
            <form class="d-flex flex-grow-1" method="GET">
                <div class="input-group w-100">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 shadow-none" name="search" placeholder="Cari gambar..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
                <ul class="navbar-nav">
                    <li class="nav-item me-3"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#why-us-section">Gallery</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#testimony-section">Testimonial</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#faq-section">FAQ</a></li>

                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark" href="login.php">Login</a>
                            <a class="btn btn-dark ms-2" href="register.php">Sign Up</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="?logout=true">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        <section id="why-us-section">
            <h2>Gallery</h2>
            <div class="row">
                <?php
                // Mencegah SQL Injection dengan prepared statement
                $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                $query = "SELECT FotoID, JudulFoto, LokasiFile FROM gallery_foto WHERE DeskripsiFoto LIKE ?";
                
                $stmt = mysqli_prepare($conn, $query);
                $like_search = "%{$search_query}%";
                mysqli_stmt_bind_param($stmt, "s", $like_search);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-lg-3 col-md-6 col-sm-12 mb-4'>
                            <div class='card'> 
                                <a href='detail.php?FotoID=" . $row['FotoID'] . "'>
                                    <img src='../img/produk/" . htmlspecialchars($row['LokasiFile']) . "' class='img-fluid rounded-top' alt='" . htmlspecialchars($row['JudulFoto']) . "'>
                                </a>
                                <div class='card-body text-center'>
                                    <h4>" . htmlspecialchars($row['JudulFoto']) . "</h4>
                                    <a href='https://wa.me/6281234567890?text=Halo!%20Saya%20tertarik%20dengan%20gambar%20ini.' target='_blank' class='btn btn-primary mt-3'>
                                        <i class='fab fa-whatsapp'></i> Hubungi Kami
                                    </a>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p class='text-center'>Tidak ada gambar ditemukan.</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <section class="footer-section text-dark py-3 text-center">
        <hr>
        <div class="container">
            <p>&copy; <?= date("Y"); ?> Nurul Khoiriyah</p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7441451cf7.js" crossorigin="anonymous"></script>
</body>
</html>
