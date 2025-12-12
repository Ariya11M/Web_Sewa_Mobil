<?php
session_start();
require("koneksi.php");


    $nama_penyewa = $_SESSION['nama_penyewa'];
    $tanggal_sewa = $_SESSION['tanggal_sewa'];
    $tanggal_kembali = $_SESSION['tanggal_kembali'];
    $harga_total = $_SESSION['harga_total'];
    $sewa_id = $_SESSION['sewa_id'];


if (isset($_POST["konfirmasi"])) {
    $uang_dibayar = $_POST['uang_dibayar'];
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'];


    $insert = insertTransaksi($sewa_id, $uang_dibayar, $tanggal_pembayaran);
    
    if ($insert) {

        updateStatusSewa($sewa_id);

        $_SESSION['uang_dibayar'] = $uang_dibayar;
        $_SESSION['tanggal_pembayaran'] =$tanggal_pembayaran;
        

        header("Location: struk.php");
        exit();
    } else {
        echo "Gagal.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link rel="stylesheet" href="./CSS/prosesStyle.css?v=1.0">
</head>
<body>
    <div class="container">
        <header>Konfirmasi Pembayaran</header>
        <form action="prosesTransaksi.php" method="POST">
            <div class="confirmation-box">
                <label for="nama_penyewa">Nama Penyewa:</label>
                <p id="nama_penyewa"><?php echo htmlspecialchars($_SESSION['nama_penyewa']); ?></p>
            </div>
            <div class="confirmation-box">
                <label for="tanggal_sewa">Tanggal Menyewa:</label>
                <p id="tanggal_sewa"><?php echo htmlspecialchars($_SESSION['tanggal_sewa']); ?></p>
            </div>
            <div class="confirmation-box">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <p id="tanggal_kembali"><?php echo htmlspecialchars($_SESSION['tanggal_kembali']); ?></p>
            </div>
            <div class="confirmation-box">
                <label for="harga_total">Harga Total:</label>
                <p id="harga_total"><?php echo htmlspecialchars($_SESSION['harga_total']); ?></p>
            </div>

            <div class="confirmation-box">
                <label for="uang_dibayar">Uang Dibayar:</label>
                <input type="number" id="uang_dibayar" name="uang_dibayar" value="<?php echo isset($_SESSION['harga_total']) ? $_SESSION['harga_total'] : ''; ?>" >
            </div>
            <div class="confirmation-box">
                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" required>
            </div>

            <div class="button-group">
                <button type="submit" class="button-confirm" name="konfirmasi">Konfirmasi Pembayaran</button>
                <button type="button" class="button-edit" onclick="window.location.href='kasir.php'">Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>
