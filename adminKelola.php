<?php
    session_start();
    require_once "koneksi.php";

    
    $dataMobil = readAllMobil();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mobil_id = $_POST['mobil_id'];

        $query = "DELETE FROM mobil WHERE mobil_id = '$mobil_id'";
        if (mysqli_query($con, $query)) {
            header("Location: adminKelola.php");
        } else {
            echo "Error Menghapus Data: " . mysqli_error($con);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - KELOLA</title>
    <link rel="stylesheet" href="./CSS/adminKelola.css?v=1.0">
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

    <div class="kelola">
        <h1 class="header">Kelola Mobil</h1>
        <table class="mobilTable">
            <thead>
                <tr>
                    <th>ID Mobil</th>
                    <th>Nama Mobil</th>
                    <th>Model Mobil</th>
                    <th>Harga Per Hari</th>
                    <th>Status Ketersediaan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($dataMobil)) {
                    echo "<tr>";
                    echo "<td>{$row['mobil_id']}</td>";
                    echo "<td>{$row['nama_mobil']}</td>";
                    echo "<td>{$row['model_mobil']}</td>";
                    echo "<td><span>Rp " . number_format($row['harga_perhari'], 0, ',', '.') . "</span></td>";

                    
                    // Dropdown untuk status ketersediaan
                    echo "<td>
                        <form action='updateStatus.php' method='POST'>
                            <input type='hidden' name='mobil_id' value='{$row['mobil_id']}'>
                            <select name='status' onchange='this.form.submit()'>
                                <option value='Available'" . ($row['status_ketersediaan'] == 'Available' ? ' selected' : '') . ">Available</option>
                                <option value='Unavailable'" . ($row['status_ketersediaan'] == 'Unavailable' ? ' selected' : '') . ">Unavailable</option>
                            </select>
                        </form>
                    </td>";

                    // Tampilkan gambar
                    echo "<td><img src='{$row['gambar']}' alt='Gambar Mobil' width='100'></td>";

                    // Tombol untuk edit harga dan hapus mobil
                    echo "<td>
                            <div class='action-buttons'>
                                <a href='editHarga.php?mobil_id={$row['mobil_id']}'>
                                    <button class='action-button'>Edit Harga</button>
                                </a>
                                <a href='konfirmDelete.php?mobil_id={$row['mobil_id']}'>
                                    <button class='action-button delete-button'>Hapus</button>
                                </a>
                             </div>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
