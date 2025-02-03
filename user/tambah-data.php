<?php
// Memasukkan koneksi ke database
include('../koneksi/koneksi.php');

// ** PROSES EDIT GAMBAR (Update) **  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_update'])) {
    $foto_id = $_POST['foto_id'];
    $judul = trim($_POST["judul"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $album = $_POST["album"];

    // Validasi apakah semua field telah diisi
    if (empty($judul) || empty($deskripsi) || empty($album)) {
        die("Semua field harus diisi.");
    }

    // Update database
    $stmt = $conn->prepare("UPDATE gallery_foto SET JudulFoto = ?, DeskripsiFoto = ?, AlbumID = ? WHERE FotoID = ?");
    $stmt->bind_param("ssii", $judul, $deskripsi, $album, $foto_id);
    $stmt->execute();

    // Proses upload gambar baru jika ada
    if (!empty($_FILES["image"]["name"])) {
        $image_name = basename($_FILES["image"]["name"]);
        $image_type = $_FILES["image"]["type"];
        $image_size = $_FILES["image"]["size"];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        // Validasi jenis dan ukuran file gambar
        if (!in_array($image_type, $allowed_types)) {
            die("Jenis file tidak didukung. Hanya file JPG, PNG, atau GIF yang diperbolehkan.");
        }

        if ($image_size > $max_size) {
            die("Ukuran file terlalu besar. Maksimal 5MB.");
        }

        // Upload gambar baru
        $target_dir = "../img/produk/";
        $image_file_name = time() . "_" . $image_name; // Nama file gambar yang unik
        $target_file = $target_dir . $image_file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update lokasi file gambar
            $stmt = $conn->prepare("UPDATE gallery_foto SET LokasiFile = ? WHERE FotoID = ?");
            $stmt->bind_param("si", $image_file_name, $foto_id);
            $stmt->execute();
        } else {
            die("Gagal mengunggah gambar.");
        }
    }

    header("Location: tambah-data.php"); // Setelah berhasil, arahkan kembali ke halaman utama
    exit();
}

// ** PROSES UPLOAD GAMBAR (Create) **  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_create'])) {
    $judul = trim($_POST["judul"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $album = $_POST["album"];
    $user_id = 1; // Ganti dengan ID pengguna yang valid

    // Validasi apakah semua field telah diisi
    if (empty($judul) || empty($deskripsi) || empty($album) || empty($_FILES["image"]["name"])) {
        die("Semua field harus diisi.");
    }

    // Folder penyimpanan gambar
    $target_dir = "../img/produk/";
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0777, true)) {
            die("Gagal membuat folder untuk gambar.");
        }
    }

    // Validasi jenis dan ukuran file gambar
    $image_name = basename($_FILES["image"]["name"]);
    $image_type = $_FILES["image"]["type"];
    $image_size = $_FILES["image"]["size"];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (!in_array($image_type, $allowed_types)) {
        die("Jenis file tidak didukung. Hanya file JPG, PNG, atau GIF yang diperbolehkan.");
    }

    if ($image_size > $max_size) {
        die("Ukuran file terlalu besar. Maksimal 5MB.");
    }

    // Mengelola file upload
    $image_file_name = time() . "_" . $image_name; // Tambah timestamp agar unik
    $target_file = $target_dir . $image_file_name; // Nama file untuk disimpan di server

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Gunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("INSERT INTO gallery_foto (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, AlbumID, UserID) VALUES (?, ?, NOW(), ?, ?, ?)");
        $stmt->bind_param("sssii", $judul, $deskripsi, $image_file_name, $album, $user_id);
        $stmt->execute();

        // Cek apakah data berhasil disimpan
        if ($stmt->affected_rows > 0) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Gagal menyimpan data.";
        }

        $stmt->close();
    } else {
        die("Gagal mengunggah gambar.");
    }
}

// ** AMBIL DATA GALERI DENGAN ALBUM **  
$sql = "
    SELECT g.FotoID, g.JudulFoto, g.DeskripsiFoto, g.TanggalUnggah, g.LokasiFile, a.NamaAlbum 
    FROM gallery_foto g
    LEFT JOIN gallery_album a ON g.AlbumID = a.AlbumID
    ORDER BY g.TanggalUnggah DESC
";
$result = $conn->query($sql);

// Ambil data untuk edit jika ada FotoID di URL
$edit_data = null;
if (isset($_GET['id'])) {
    $foto_id = $_GET['id'];
    $sql_edit = "SELECT * FROM gallery_foto WHERE FotoID = ?";
    $stmt_edit = $conn->prepare($sql_edit);
    $stmt_edit->bind_param("i", $foto_id);
    $stmt_edit->execute();
    $result_edit = $stmt_edit->get_result();
    $edit_data = $result_edit->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Subrayada:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style> 
        /* Gaya umum untuk body */
        body {
            font-family: "Poppins", serif; 
            font-style: normal; 
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Gaya untuk container utama */
        .container {
            width: 70%; /* Sesuaikan lebar dengan kebutuhan */
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        /* Gaya untuk elemen input, textarea, select, dan button */
        input, textarea, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box; /* Pastikan padding tidak mempengaruhi lebar */
        }

        /* Tombol dengan warna hijau */
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            padding: 12px;
            margin-top: 15px;
            border-radius: 5px;
        }

        /* Hover effect untuk tombol */
        button:hover {
            background: #218838;
        }

        /* Grid layout untuk galeri foto */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Desain untuk pin (foto) dalam galeri */
        .pin {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        /* Menyesuaikan ukuran gambar */
        img {
            width: 100%;
            height:100px;
            border-radius: 10px;
        }

        /* Tombol untuk Edit dan Delete pada galeri */
        .crud-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .delete-btn {
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 5px;
        }

        /* Container untuk form input dan preview gambar */
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        /* Kolom untuk inputan form */
        .form-inputs {
            flex: 1;
            max-width: 50%;
            text-align: left; /* Menjaga teks input tetap rata kiri */
        }

        /* Kolom untuk preview gambar */
        .image-preview {
            flex: 1;
            max-width: 45%;
        }

        /* Gaya untuk preview gambar */
        #image-preview-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Preview gambar */
        #image-preview {
            display: none;
            max-width: 100%;
            max-height: 300px;
            object-fit: cover; /* Menyesuaikan gambar */
            border-radius: 10px;
        }

        /* Gaya untuk label */
        label {
            text-align: left;
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        /* Styling untuk form input (input, textarea, select) */
        input, textarea, select {
            background: #f9f9f9;
            border: 1px solid #ccc;
        }

        /* Gaya tambahan untuk tombol unggah */
        button[type="submit"] {
            width: auto;
            margin-top: 20px;
            background-color: #28a745;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Hover effect untuk button submit */
        button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Mengatur jarak antar elemen */
        .form-container label,
        .form-container input,
        .form-container textarea,
        .form-container select {
            margin-bottom: 15px; /* Memberikan jarak antar elemen form */
        }

        /* Memberikan margin bawah pada input dan textarea */
        input, select, textarea {
            box-sizing: border-box; /* Pastikan padding tidak mempengaruhi ukuran elemen */
        }
        h1{
            text-align: center;
        }
        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 8px 12px;
            border-radius: 50%;
            text-decoration: none;
            font-size: 20px;
            transition: background 0.3s;
        }

        .back-button:hover {
            background: rgba(0, 0, 0, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1><?php echo $edit_data ? 'Edit Foto' : 'Unggah Gambar'; ?></h1>
        <form action="tambah-data.php" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-inputs">
                    <label for="judul">Judul Foto:</label>
                    <input type="text" name="judul" id="judul" value="<?= $edit_data ? htmlspecialchars($edit_data['JudulFoto']) : '' ?>" required>

                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required><?= $edit_data ? htmlspecialchars($edit_data['DeskripsiFoto']) : '' ?></textarea>

                    <label for="album">Pilih Album:</label>
                    <select name="album" id="album" required>
                        <option value="">Pilih Album</option>
                        <?php
                        // Ambil album dari database
                        $album_sql = "SELECT * FROM gallery_album";
                        $album_result = $conn->query($album_sql);
                        while ($album_row = $album_result->fetch_assoc()):
                            $selected = $edit_data && $album_row['AlbumID'] == $edit_data['AlbumID'] ? 'selected' : '';
                        ?>
                            <option value="<?= $album_row['AlbumID'] ?>" <?= $selected ?>><?= $album_row['NamaAlbum'] ?></option>
                        <?php endwhile; ?>
                    </select>

                    <label for="image">Pilih Gambar:</label>
                    <input type="file" name="image" id="image" accept="image/*" onchange="previewImage()">

                    <button type="submit" name="<?= $edit_data ? 'submit_update' : 'submit_create' ?>">
                        <?= $edit_data ? 'Simpan Perubahan' : 'Unggah' ?>
                    </button>
                </div>

                <div class="image-preview" id="image-preview-container" style="display:none;">
                    <img id="image-preview" alt="Preview Gambar" style="max-width: 100%; margin-top: 10px; border-radius: 10px;">
                </div>
            </div>

            <?php if ($edit_data): ?>
            <input type="hidden" name="foto_id" value="<?= $edit_data['FotoID'] ?>">
            <?php endif; ?>
        </form>
    </div>

    <h1>Galeri Foto</h1>
    <div class="gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="pin">
                <img src="../img/produk/<?= $row['LokasiFile'] ?>" alt="<?= htmlspecialchars($row['JudulFoto']) ?>">
                <h3><?= htmlspecialchars($row['JudulFoto']) ?></h3> 
                <p><strong>Album: </strong><?= htmlspecialchars($row['NamaAlbum']) ?></p>
                <div class="crud-buttons">
                    <a href="tambah-data.php?id=<?= $row['FotoID'] ?>"><button>Edit</button></a>
                    <a href="tambah-data.php?hapus=<?= $row['FotoID'] ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <button class="delete-btn">Hapus</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        // Fungsi untuk menampilkan preview gambar
        function previewImage() {
            const file = document.getElementById("image").files[0];
            const preview = document.getElementById("image-preview");
            const previewContainer = document.getElementById("image-preview-container");

            // Jika ada file yang dipilih
            if (file) {
                const reader = new FileReader();
                
                // Set function ketika file dibaca
                reader.onload = function(e) {
                    // Set gambar preview
                    preview.src = e.target.result;
                    preview.style.display = "block"; // Menampilkan gambar
                    previewContainer.style.display = "block"; // Menampilkan container preview
                }

                // Membaca file yang dipilih
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file yang dipilih, sembunyikan preview
                preview.style.display = "none";
                previewContainer.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
