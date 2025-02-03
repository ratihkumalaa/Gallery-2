<!DOCTYPE html>
<html lang="en">
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
                <img src="img/logo.png" alt="Logo" height="40">
            </a>
            <form class="d-flex flex-grow-1" method="GET" action="">
                <div class="input-group w-100">
                    <span class="input-group-text bg-light border-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 shadow-none" name="search" placeholder="Search images..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
                <ul class="navbar-nav">
                    <li class="nav-item me-3"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#why-us-section">Gallery</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#testimony-section">Testimonial</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="#faq-section">FAQ</a></li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark" href="#">Login</a>
                        <a class="btn btn-dark ms-2" href="#">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-4">
        <section id="why-us-section">
            <h2>Gallery</h2>
            <div class="row">
                <?php
                include('../koneksi/koneksi.php');
                $search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                $query = "SELECT * FROM gallery_foto WHERE DeskripsiFoto LIKE '%$search_query%'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='col-lg-3 col-md-6 col-sm-12 mb-4'>
                            <div class='card'> 
                                <a href='detail.php?FotoID=" . $row['FotoID'] . "'>
                                    <img src='../img/produk/" . $row['LokasiFile'] . "' class='img-fluid rounded-top' alt='Gambar Gallery'>
                                </a>
                                <div class='card-body text-center'>
                                    <h4>" . $row['JudulFoto'] . "</h4>
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
            <p>&copy; <?php echo date("Y"); ?> Nurul Khoiriyah</p>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7441451cf7.js" crossorigin="anonymous"></script>
</body>
</html>