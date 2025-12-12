<?php 
session_start();
require("koneksi.php");

$data = readPenyewaanByStatus('Menunggu Pembayaran');


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["proses"])) {
    $sewa_id = $_POST["sewa_id"];

    $dataPenyewaan = mysqli_fetch_assoc(readPenyewaanById($sewa_id));


    $_SESSION['sewa_id'] = $dataPenyewaan['sewa_id'];
    $_SESSION['nama_penyewa'] = $dataPenyewaan['nama_penyewa'];
    $_SESSION['tanggal_sewa'] = $dataPenyewaan['tanggal_sewa'];
    $_SESSION['tanggal_kembali'] = $dataPenyewaan['tanggal_kembali'];
    $_SESSION['harga_total'] = $dataPenyewaan['harga_total'];

    echo $_SESSION['nama_penyewa'];
    header("Location: prosesTransaksi.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="./CSS/kasir.css?v=1.0">
</head>
<body>
    <div class="sidebar">
        <header>Kasir</header>
        <ul>
            <li><a href="kasir.php">Pembayaran</a></li>
            <li><a href="pengembalian.php">Pengembalian</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="daftarTransaksi">
        <h1>Daftar Transaksi</h1>
        <form action="kasir.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Menyewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Harga Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "
                                <tr>
                                    <td>" . $row["nama_penyewa"] . "</td>
                                    <td>" . $row["tanggal_sewa"] . "</td>
                                    <td>" . $row["tanggal_kembali"] . "</td>
                                    <td>" . $row["harga_total"] . "</td>
                                    <td>
                                        <input type='hidden' name='sewa_id' value='" . $row["sewa_id"] . "'>
                                        <button type='submit' class='tombolProses' name='proses'>Proses</button>
                                    </td>
                                </tr>
                            ";
                        } 
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
