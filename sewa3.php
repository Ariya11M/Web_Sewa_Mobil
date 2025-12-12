<?php
    session_start();
    require("koneksi.php");

    if (!isset($_SESSION['namaLengkap'])) {
        
        header("Location: sewa2.php");
        exit();
    }

    $namaLengkap = $_SESSION['namaLengkap'];
    $mobil = $_SESSION['mobil'];
    $mobil_id = $_SESSION['mobil_id'];
    $alamat = $_SESSION['alamat'];
    $tanggal_sewa = $_SESSION['tanggalSewa'];
    $tanggal_kembali = $_SESSION['tanggalKembali'];
    $harga_total = $_SESSION['hargaTotal'];

    $user_id = $_SESSION['user_id'];

    if(isset($_POST["sewa"])){
        insertSewa($user_id, $mobil_id, $tanggal_sewa, $tanggal_kembali, $harga_total,$alamat,$namaLengkap);
        header("Location: status.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Sewa</title>
    <link rel="stylesheet" href="./CSS/sewa3Style.css?v=1.0">
</head>
<body>
    <div class="container">
        <header>Konfirmasi Sewa</header>

        <form action="sewa3.php" method="post">
            <div class="confirmation-box">
                <label for="NamaLengkap">Nama Lengkap:</label>
                <p><?php echo $namaLengkap; ?></p>
            </div>

            <div class="confirmation-box">
                <label for="Mobil">Mobil Disewa:</label>
                <p><?php echo $mobil; ?></p>
            </div>

            <div class="confirmation-box">
                <label for="Alamat">Alamat:</label>
                <p><?php echo $alamat; ?></p>
            </div>

            <div class="confirmation-box">
                <label for="TanggalSewa">Tanggal Sewa:</label>
                <p><?php echo $tanggal_sewa; ?></p>
            </div>

            <div class="confirmation-box">
                <label for="TanggalKembali">Tanggal Kembali:</label>
                <p><?php echo $tanggal_kembali; ?></p>
            </div>

            <div class="confirmation-box">
                <label for="HargaTotal">Harga Total:</label>
                <p><?php echo "Rp " . number_format($harga_total, 0, ',', '.'); ?></p>
            </div>

            <div class="button-group">
                <button type="submit" name="sewa">Sewa</button>
                <button type="button" onclick="window.history.back()">Edit</button>
            </div>
        </form>
    </div>
</body>
</html>
