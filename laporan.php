<?php 
    require("koneksi.php");
    session_start();
    
    $data = laporanKeuangan();

    $seringDipesanRow = mysqli_fetch_assoc(mobilSeringDipesan());
    $seringDipesan = $seringDipesanRow['model_mobil'] . " (" . $seringDipesanRow['jumlah_disewa'] . " penyewaan)";
    
    $totalPesananRow = mysqli_fetch_assoc(totalPesanan());
    $totalPesanan = $totalPesananRow['total_pesanan'];
    
    $totalPemasukanRow = mysqli_fetch_assoc(totalPemasukan());
    $totalPemasukan = "Rp " . number_format($totalPemasukanRow['total_pemasukan'], 2, ',', '.');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="./CSS/laporanStyle.css">
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

    <div class="daftarTransaksi">
        <h1>Laporan</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>ID Sewa</th>
                        <th>ID Mobil</th>
                        <th>Nama Penyewa</th>
                        <th>Nama Mobil</th>
                        <th>Model Mobil</th>
                        <th>Uang Dibayar</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "
                                <tr>
                                    <td>" . $row["transaksi_id"] . "</td>
                                    <td>" . $row["sewa_id"] . "</td>
                                    <td>" . $row["mobil_id"] . "</td>
                                    <td>" . $row["nama_penyewa"] . "</td>
                                    <td>" . $row["nama_mobil"] . "</td>
                                    <td>" . $row["model_mobil"] . "</td>
                                    <td>" . $row["uang_dibayar"] . "</td>
                                    <td>" . $row["tanggal_pembayaran"] . "</td>
                                    <td>" . $row["status"] . "</td>
                                </tr>
                            ";
                        } 
                    ?>
                </tbody>
            </table>
    </div>
    
    <div class="ringkasan">
        <h1>Ringkasan</h1>
        <table >
            <tr>
                <th>Mobil Yang sering Disewa </th>
                <td><?= $seringDipesan ?></td>
            </tr>
            <tr>
                <th>Banyaknya Pesanan</th>
                <td><?= $totalPesanan ?></td>
            </tr>
            <tr>
                <th>Total Pemasukan </th>
                <td><?= $totalPemasukan ?></td>
            </tr>
        </table>
    </div>
</body>
</html>