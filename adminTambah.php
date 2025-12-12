<?php
    session_start();
    require_once "koneksi.php";
    
    if (isset($_POST["tambah"])) {
        $namaMobil = $_POST["namaMobil"];
        $model = $_POST["model"];
        $harga = $_POST["harga"];

        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
            $fileTmpPath = $_FILES["foto"]["tmp_name"];
            $fileName = $_FILES["foto"]["name"];
            $fileSize = $_FILES["foto"]["size"];
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedTypes = ["jpg", "jpeg", "png", "gif", "webp"];
            if (!in_array($fileType, $allowedTypes)) {
                echo "Only JPG, JPEG, PNG, WEBP, and GIF files are allowed.";
                exit;
            }

            $uploadDir = './uploads/';
            $destinationPath = $uploadDir . $fileName;


            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                
                $gambar = $destinationPath; 

  
                $query = "INSERT INTO mobil (nama_mobil, model_mobil, harga_perhari, gambar) 
                        VALUES ('$namaMobil', '$model', '$harga', '$gambar')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    echo "Data added successfully.";
                    
                    header("Location: adminTambah.php");
                    exit;
                } else {
                    echo "Error menambahkan data: " . mysqli_error($con);
                }
            } else {
                echo "Error memindahkan file";
            }
        } else {
            echo "tidak ada file terupload";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - TAMBAH</title>
    <link rel="stylesheet" href="./CSS/adminTambah.css?v=1.0">
</head>
<body>
    <div class="sidebar">
        <header>Admin</header>
        <ul>
            <li><a href="adminKelola.php">Kelola</a></li>
            <li><a href="adminTambah.php">Tambah</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li><a href="DaftarMobil.php">Daftar Mobil</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="tambah">
        <form action="adminTambah.php" method="post" enctype="multipart/form-data">
            <h1 class="header">Tambah Mobil</h1>
            <label for="namaMobil">Nama Mobil</label>
            <input type="text" name ="namaMobil" class="namaMobilField" placeholder="Masukan Nama Mobil" required>
            <label for="model">Model Mobil</label>
            <input type="text" name ="model" class="modelField" placeholder="Masukan model" required>
            <label for="harga">Harga Per Hari</label>
            <input type="number" name ="harga" class="hargaField" placeholder="Masukan Harga" required>
            <label for="foto">Gambar</label>
            <input type="file" id="foto" name="foto" class="fotoField" accept="image/*" required>
            <input type="submit" value="Tambah" class="tombolTambah" name="tambah">
        </form>
    </div>
</body>
</html>