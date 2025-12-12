<?php
include 'koneksi.php';

if (isset($_GET['mobil_id'])) {
    $mobil_id = $_GET['mobil_id'];
    $result = mysqli_query($con, "SELECT * FROM mobil WHERE mobil_id = '$mobil_id'");
    $data = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobil_id = $_POST['mobil_id'];

    // Periksa apakah ada relasi di tabel penyewaan
    $checkRelasi = "SELECT * FROM penyewaan WHERE mobil_id = '$mobil_id'";
    $result = mysqli_query($con, $checkRelasi);

    if (mysqli_num_rows($result) > 0) {
        // Jika ada relasi, tampilkan pesan error dan jangan hapus mobil
        echo "Mobil ini tidak dapat dihapus karena masih terkait dengan penyewaan.";
    } else {
        // Hapus data di tabel penyewaan yang terkait dengan mobil_id
        $deletePenyewaan = "DELETE FROM penyewaan WHERE mobil_id = '$mobil_id'";
        if (!mysqli_query($con, $deletePenyewaan)) {
            echo "Error deleting related data in penyewaan: " . mysqli_error($con);
            exit;
        }

        // Hapus data di tabel mobil setelah relasi dihapus
        $query = "DELETE FROM mobil WHERE mobil_id = '$mobil_id'";
        if (mysqli_query($con, $query)) {
            // Redirect ke halaman kelola mobil setelah berhasil menghapus
            header("Location: adminKelola.php");
            exit;
        } else {
            echo "Error deleting data: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Mobil</title>
    <link rel="stylesheet" href="./CSS/editHarga.css?v=1.0">
    <script>
        function confirmDelete(event) {
            const confirmed = confirm("Apakah Anda yakin ingin menghapus mobil ini?");
            if (!confirmed) event.preventDefault();
        }
    </script>
</head>
<body>
    <div class="edit-harga-container">
        <h1 class="header">Konfirmasi Hapus Mobil</h1>
        <div class="details">
            <img src="<?php echo $data['gambar']; ?>" alt="Gambar Mobil" class="mobil-image">
            <h2><?php echo $data['nama_mobil']; ?></h2>
            <p>Model: <?php echo $data['model_mobil']; ?></p>
        </div>
        <form action="adminKelola.php" method="POST" onsubmit="confirmDelete(event)">
            <input type="hidden" name="mobil_id" value="<?php echo $data['mobil_id']; ?>">
            <div class="button-group">
                <button class="action-button" type="submit">Hapus</button>
                <a href="adminKelola.php" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
