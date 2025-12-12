<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

$search = isset($_POST['search']) ? $_POST['search'] : '';

$query = "
    SELECT sewa_id, mobil_id, nama_penyewa, tanggal_sewa, tanggal_kembali, harga_total, status_sewa
    FROM penyewaan
    WHERE status_sewa = 'sudah_dikembalikan' AND user_id = ? AND nama_penyewa LIKE ?
";
$stmt = $con->prepare($query);
$search_term = "%" . $search . "%";
$stmt->bind_param("is", $user_id, $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyewaan</title>
    <link rel="stylesheet" href="./CSS/riwayatStyle.css?v=1.0">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>LOGO</h1>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="sewa.php">Sewa</a>
                <a href="status.php">Status</a>
                <a href="riwayat.php">Riwayat</a>
                <?php if (isset($_SESSION["login"])): ?>
                    <a href="logout.php" class="login">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="login">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main>
        <h2>Riwayat Penyewaan</h2>
        <form method="POST" action="" class="search-form">
            <input type="text" name="search" placeholder="Cari Nama Penyewa" value="<?= htmlspecialchars($search) ?>" class="search-input">
            <button type="submit" class="search-button">Cari</button>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Sewa</th>
                        <th>ID Mobil</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Harga Total</th>
                        <th>Status Sewa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['sewa_id']) ?></td>
                            <td><?= htmlspecialchars($row['mobil_id']) ?></td>
                            <td><?= htmlspecialchars($row['nama_penyewa']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_sewa']) ?></td>
                            <td><?= htmlspecialchars($row['tanggal_kembali']) ?></td>
                            <td>Rp <?= number_format($row['harga_total'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($row['status_sewa']) ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada riwayat penyewaan yang ditemukan.</p>
        <?php endif; ?>
    </main>
</body>
</html>
