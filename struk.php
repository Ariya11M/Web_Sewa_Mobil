<?php
session_start();
require("koneksi.php");


    $nama_penyewa = $_SESSION['nama_penyewa'];
    $tanggal_sewa = $_SESSION['tanggal_sewa'];
    $tanggal_kembali = $_SESSION['tanggal_kembali'];
    $harga_total = $_SESSION['harga_total'];
    $sewa_id = $_SESSION['sewa_id'];
    $uang_dibayar = $_SESSION['uang_dibayar'];
    $tanggal_pembayaran = $_SESSION['tanggal_pembayaran'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <link rel="stylesheet" href="./CSS/struk.css?v=1.0">
</head>
<body>
    <div class="container">
        <header>Struk</header>
            <div class="confirmation-box">
                <label for="nama_penyewa">Nama Penyewa:</label>
                <p id="nama_penyewa"><?php echo  $nama_penyewa; ?></p>
            </div>
            <div class="confirmation-box">
                <label for="tanggal_sewa">Tanggal Menyewa:</label>
                <p id="tanggal_sewa"><?php echo  $tanggal_sewa; ?></p>
            </div>
            <div class="confirmation-box">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <p id="tanggal_kembali"><?php echo $tanggal_kembali; ?></p>
            </div>
            <div class="confirmation-box">
                <label for="harga_total">Harga Total:</label>
                <p id="harga_total"><?php echo $harga_total; ?></p>
            </div>
            <div class="confirmation-box">
                <label for="dibayar">Uang yang Dibayarkan :</label>
                <p id="dibayar"><?php echo $uang_dibayar; ?></p>
            </div>
            <div class="confirmation-box">
                <label for="harga_total">Harga Total:</label>
                <p id="harga_total"><?php echo $tanggal_pembayaran; ?></p>
            </div>
            <div class="button-group">
                <button type="button" class="button-edit" onclick="window.location.href='kasir.php'">Kembali Kasir</button>
                <button type="button" class="button-print" onclick="window.print()">Cetak Struk</button>
            </div>
    </div>
</body>
</html>
