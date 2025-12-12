<?php
session_start();
require_once "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Ambil nama penyewa berdasarkan user_id
$query_nama_penyewa = "SELECT nama_penyewa FROM penyewaan WHERE user_id = ?";
$stmt_nama_penyewa = $con->prepare($query_nama_penyewa);
$stmt_nama_penyewa->bind_param("i", $user_id);
$stmt_nama_penyewa->execute();
$result_nama_penyewa = $stmt_nama_penyewa->get_result();
$nama_penyewa = $result_nama_penyewa->fetch_assoc()['nama_penyewa'];

// Ambil data pencarian dari form jika ada
$search = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM penyewaan WHERE user_id = ? AND nama_penyewa LIKE ?";
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
    <title>Status Penyewaan</title>
    <link rel="stylesheet" href="./CSS/statusStyle.css?v=1.0">
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
        <div class="content-wrapper">
            <h2>Status Penyewaan</h2>

            <form method="POST" action="" class="search-form">
                <input type="text" name="search" placeholder="Cari Nama Penyewa" value="<?= htmlspecialchars($search) ?>" class="search-input">
                <button type="submit" class="search-button">Cari</button>
            </form>

            <div class="card-container">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="card">
                            <h3>ID Sewa: <?= htmlspecialchars($row['sewa_id']) ?: "N/A" ?></h3>
                            <p><strong>Nama Penyewa:</strong> <?= htmlspecialchars($row['nama_penyewa']) ?: "N/A" ?></p>
                            <p><strong>Tanggal Sewa:</strong> <?= htmlspecialchars($row['tanggal_sewa']) ?: "N/A" ?></p>
                            <p><strong>Tanggal Kembali:</strong> <?= htmlspecialchars($row['tanggal_kembali']) ?: "N/A" ?></p>
                            <p class="price"><strong>Harga Total:</strong> Rp <?= number_format($row['harga_total'], 0, ',', '.') ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($row['status_sewa']) ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Anda tidak memiliki penyewaan aktif saat ini.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
