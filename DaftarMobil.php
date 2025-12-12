<?php 
session_start();
require 'koneksi.php';

$query = " SELECT mobil.mobil_id, mobil.nama_mobil, mobil.model_mobil, COUNT(penyewaan.mobil_id) AS jumlah_disewa
    FROM mobil
    LEFT JOIN penyewaan ON mobil.mobil_id = penyewaan.mobil_id
    GROUP BY mobil.mobil_id, mobil.nama_mobil, mobil.model_mobil
    ORDER BY jumlah_disewa DESC;
";

global $con;

$data = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>
    <link rel="stylesheet" href="./CSS/DaftarMobil.css">
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
    <header>
        <div class="daftar">
            <h1>Daftar Mobil yang Sering Disewa</h1>
        </div>
    </header>
    <main>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Mobil ID</th>
                <th>Nama Mobil</th>
                <th>Model Mobil</th>
                <th>Jumlah Disewa</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo $row['mobil_id']; ?></td>
                    <td><?php echo $row['nama_mobil']; ?></td>
                    <td><?php echo $row['model_mobil']; ?></td>
                    <td><?php echo $row['jumlah_disewa'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>
