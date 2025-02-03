<?php
include '../koneksi/koneksi.php';

// Menangani pengiriman form untuk "Create"
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['action'])) {
    // Pastikan semua field ada
    if (isset($_POST['nama_produk'], $_POST['deskripsi'], $_POST['harga'], $_POST['stok']) && isset($_FILES['gambar'])) {
        $nama_produk = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Mengelola upload gambar
        $target_dir = "../img/produk/";
        $gambar = $_FILES['gambar']['name'];
        $target_file = $target_dir . basename($gambar);

        // Periksa apakah gambar berhasil di-upload
        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                // Query untuk menambah data
                $query = "INSERT INTO tb_produk (nama_produk, deskripsi, harga, stok, gambar) 
                          VALUES ('$nama_produk', '$deskripsi', $harga, $stok, '$gambar')";

                if (mysqli_query($koneksi, $query)) {
                    echo "Sukses menambahkan data produk!";
                    // Redirect setelah berhasil menambah data
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Terjadi kesalahan saat mengupload gambar.";
        }
    } else {
        echo "Semua field harus diisi!";
    }
}


// Menangani pengiriman form untuk "Edit"
// Menangani pengiriman form untuk "Edit"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produk'])) {
    // Memeriksa apakah data lainnya ada
    if (isset($_POST['nama_produk'], $_POST['deskripsi'], $_POST['harga'], $_POST['stok'], $_FILES['gambar'])) {
        $id = $_POST['id_produk'];
        $nama_produk = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $gambar = $_FILES['gambar']['name'];

        // Validasi harga dan stok harus berupa angka
        if (!is_numeric($harga) || !is_numeric($stok)) {
            echo "Harga dan stok harus berupa angka.";
            exit();
        }

        // Jika gambar diubah
        if (!empty($gambar)) {
            $target_dir = "../img/produk/";
            $target_file = $target_dir . basename($gambar);

            // Validasi file gambar
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $allowedTypes)) {
                // Upload gambar
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                    // Siapkan query untuk mengupdate data produk dengan gambar
                    $query = "UPDATE tb_produk SET nama_produk=?, deskripsi=?, harga=?, stok=?, gambar=? WHERE id_produk=?";
                    if ($stmt = mysqli_prepare($koneksi, $query)) {
                        // Mengikat parameter ke statement
                        mysqli_stmt_bind_param($stmt, "ssdiis", $nama_produk, $deskripsi, $harga, $stok, $gambar, $id);

                        // Menjalankan statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Redirect setelah berhasil mengedit data
                            header("Location: " . $_SERVER['PHP_SELF']);
                            exit();
                        } else {
                            echo "Gagal memperbarui data produk.";
                        }

                        // Menutup statement
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    echo "Gagal mengunggah gambar.";
                }
            } else {
                echo "Hanya file gambar yang diizinkan (jpg, jpeg, png, gif).";
            }
        } else {
            // Jika gambar tidak diubah
            $query = "UPDATE tb_produk SET nama_produk=?, deskripsi=?, harga=?, stok=? WHERE id_produk=?";
            if ($stmt = mysqli_prepare($koneksi, $query)) {
                // Mengikat parameter ke statement
                mysqli_stmt_bind_param($stmt, "ssdis", $nama_produk, $deskripsi, $harga, $stok, $id);

                // Menjalankan statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect setelah berhasil mengedit data
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Gagal memperbarui data produk.";
                }

                // Menutup statement
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        echo "Data form tidak lengkap.";
    }
}

 
// Menangani pengiriman form untuk "Delete" 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'delete') {
    // Validasi dan sanitasi input ID produk
    $id = isset($_POST['id_produk']) ? (int) $_POST['id_produk'] : 0;

    if ($id > 0) {
        // Menyiapkan query untuk menghapus data berdasarkan id_produk
        $query = "DELETE FROM tb_produk WHERE id_produk = ?";

        // Menyiapkan statement
        if ($stmt = mysqli_prepare($koneksi, $query)) {
            // Mengikat parameter ke statement
            mysqli_stmt_bind_param($stmt, "i", $id);  // "i" untuk integer

            // Menjalankan statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect setelah berhasil menghapus data
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                // Menampilkan pesan kesalahan jika query gagal
                echo "Gagal menghapus produk. Error: " . mysqli_stmt_error($stmt);
            }

            // Menutup statement
            mysqli_stmt_close($stmt);
        } else {
            // Menampilkan pesan kesalahan jika query prepare gagal
            echo "Gagal menyiapkan query. Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "ID produk tidak valid.";
    }
}

// Mengambil data untuk "Read"
$result = mysqli_query($koneksi, "SELECT * FROM tb_produk");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bening - Tables</title>
    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .center{
        text-align: center;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bening <sup>Laundry</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

             <!-- Nav Item - Dashboard -->
             <li class="nav-item ">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item  active">
                <a class="nav-link" href="produk.php">
                    <i class="fas fa fa-folder"></i>
                    <span>Produk</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="paket.php"> 
                    <i class="fas fa-fw fa-laptop"></i>
                    <span>Paket</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="transaksi.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Transaksi</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="komentar.php"> 
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Komentar</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user.php"> 
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="setting.php"> 
                    <i class="fas fa-cogs fa-sm fa-fw mr-2"></i>
                    <span>Setting</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading --> 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Data Laundry</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="center">
                                            <th>No</th>  
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- Pengambilan data dari database-->
                                    <tbody> 
                                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $no++; ?></td> 
                                        <td><?= $row['nama_produk']; ?></td>
                                        <td><?= $row['deskripsi']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td><?= $row['stok']; ?></td>
                                        <td><img src="../img/produk/<?= $row['gambar']; ?>" alt="<?= $row['nama_produk']; ?>" width="100"></td>
                                        <td >
                                            <!-- Detail Button -->
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button> <br>

                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm mt-2" onclick="openEditModal(
                                                <?php echo $row['id_produk']; ?>, 
                                                '<?php echo addslashes($row['nama_produk']); ?>', 
                                                '<?php echo addslashes($row['deskripsi']); ?>', 
                                                <?php echo $row['harga']; ?>, 
                                                <?php echo $row['stok']; ?>, 
                                                '<?php echo addslashes($row['gambar']); ?>'
                                            )">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button> <br>

                                            <!-- Delete Button --> 
                                            <button class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteId(<?php echo $row['id_produk']; ?>)">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>  
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Tambah Data Produk -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Data Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form Tambah Data Produk dengan method POST dan enctype untuk upload file -->
                            <form id="formTambah" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="namaProduk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" id="namaProduk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control" name="stok" id="stok" required>
                                </div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Data end -->
 
            <!-- Modal Edit --> 
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <!-- Form Edit Data Produk -->
                            <form id="formEdit" method="POST" enctype="multipart/form-data">

                                <!-- Input Hidden untuk ID Produk -->
                                <input type="hidden" id="edit_id" name="id_produk">

                                <!-- Nama Produk -->
                                <div class="mb-3">
                                    <label for="edit_nama" class="form-label">Nama Produk</label>
                                    <input class="form-control" id="edit_nama" name="nama_produk" required>
                                </div>

                                <!-- Deskripsi Produk -->
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="edit_description" name="deskripsi" rows="3" required></textarea>
                                </div>

                                <!-- Gambar Produk -->
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Gambar Produk</label>
                                    <input type="file" class="form-control" id="edit_image" name="gambar">
                                    <!-- Menampilkan gambar yang ada (jika ada) -->
                                    <img id="current_image" src="#" alt="Gambar Saat Ini" style="width: 100px; display: none; margin-top: 10px;">
                                </div>

                                <!-- Harga Produk -->
                                <div class="mb-3">
                                    <label for="edit_price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="edit_price" name="harga" required>
                                </div>

                                <!-- Stok Produk -->
                                <div class="mb-3">
                                    <label for="edit_stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="edit_stock" name="stok" required>
                                </div>

                                <!-- Tombol Simpan Perubahan -->
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit End -->  
 
            <!-- Modal Konfirmasi Hapus -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus produk ini?
                        </div>
                        <div class="modal-footer">
                            <form method="POST" action="">
                                <input type="hidden" id="deleteId" name="id_produk">
                                <input type="hidden" name="action" value="delete">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- Modal Konfirmasi Hapus End -->


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Bening Laundry</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

 
    <!-- Script tambah data dengan fetch -->
    <script>
        // Fungsi untuk menambah data produk menggunakan fetch API
        document.getElementById("formTambah").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah form untuk reload halaman saat disubmit

            const form = document.getElementById('formTambah');
            const formData = new FormData(form);

            // Kirim data menggunakan fetch API untuk menambah produk
            fetch('', { // Form ini mengarah ke file yang sama untuk menangani form
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Tampilkan respon dari server
                if (data.includes("Sukses")) { // Menyaring pesan sukses
                    // Jika sukses, tutup modal dan reload halaman untuk menampilkan data terbaru
                    const addModal = new bootstrap.Modal(document.getElementById('addModal'));
                    addModal.hide(); // Tutup modal
                    location.reload(); // Refresh halaman
                } else {
                    alert("Terjadi kesalahan, silakan coba lagi.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat mengirim data.");
            });
        });
    </script>
    <!-- script tambah data end-->

    <!-- script edit -->
    <script>
        function openEditModal(id_produk, nama_produk, deskripsi, harga, stok, gambar) {
            // Mengisi nilai input dalam modal edit untuk produk
            document.getElementById('edit_id').value = id_produk;
            document.getElementById('edit_nama').value = nama_produk;
            document.getElementById('edit_description').value = deskripsi;
            document.getElementById('edit_price').value = harga;
            document.getElementById('edit_stock').value = stok;

            // Menampilkan gambar yang ada (jika ada)
            const currentImage = document.getElementById('current_image');
            currentImage.src = gambar ? '../img/produk/' + gambar : '#';
            currentImage.style.display = gambar ? 'block' : 'none';

            // Menampilkan modal edit produk
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        } 
    </script> 
    <!-- script edit end-->

    <!-- script untuk hapus data -->
    <script>
        function setDeleteId(id_produk) {
            document.getElementById('deleteId').value = id_produk;
        }
    </script>
    <!-- script untuk hapus data end-->


</body>

</html>