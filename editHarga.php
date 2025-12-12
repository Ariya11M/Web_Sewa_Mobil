<?php
include 'koneksi.php';

if (isset($_GET['mobil_id'])) {
    $mobil_id = $_GET['mobil_id'];
    $result = mysqli_query($con, "SELECT * FROM mobil WHERE mobil_id = '$mobil_id'");
    $data = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobil_id = $_POST['mobil_id'];
    $harga = $_POST['harga'];

    $query = "UPDATE mobil SET harga_perhari = '$harga' WHERE mobil_id = '$mobil_id'";
    if (mysqli_query($con, $query)) {
        header("Location: adminKelola.php");
    } else {
        echo "Error updating price: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Harga</title>
    <link rel="stylesheet" href="./CSS/editHarga.css?v=1.0">
    <script>
        function formatHarga(input) {
            const formatted = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(input.value);
            document.getElementById('harga-display').innerText = formatted.replace("IDR", "Rp");
        }

        function confirmSave(event) {
            const confirmed = confirm("Apakah Anda yakin ingin menyimpan perubahan?");
            if (!confirmed) event.preventDefault();
        }
    </script>
</head>
<body>
    <div class="edit-harga-container">
        <h1 class="header">Edit Harga Mobil</h1>
        <div class="details">
            <img src="<?php echo $data['gambar']; ?>" alt="Gambar Mobil" class="mobil-image">
            <h2><?php echo $data['nama_mobil']; ?></h2>
            <p>Model: <?php echo $data['model_mobil']; ?></p>
        </div>
        <form action="editHarga.php" method="POST" onsubmit="confirmSave(event)">
            <input type="hidden" name="mobil_id" value="<?php echo $data['mobil_id']; ?>">
            <label for="harga">Harga Per Hari (Rp)</label>
            <input 
                type="number" 
                name="harga" 
                value="<?php echo $data['harga_perhari']; ?>" 
                required 
                oninput="formatHarga(this)">
            <p id="harga-display">Rp <?php echo number_format($data['harga_perhari'], 0, ',', '.'); ?></p>
            <div class="button-group">
                <button class="action-button" type="submit">Simpan</button>
                <a href="adminKelola.php" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
