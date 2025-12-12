<?php 
    session_start();
    require("./koneksi.php");

    if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
        header('Location: login.php');
        exit;
    }

    $hargaTotal = 0;
    $hargaPerhari = isset($_SESSION['harga_perhari']) ? $_SESSION['harga_perhari'] : 0;
    $tanggalSewa = '';
    $tanggalKembali = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $namaLengkap = $_POST['namaLengkap'];
        $mobil = $_POST['mobil'];
        $alamat = $_POST['alamat'];
        $tanggalSewa = $_POST['tanggalSewa'];
        $tanggalKembali = $_POST['tanggalKembali'];

        if ($tanggalSewa && $tanggalKembali && $hargaPerhari > 0) {
            $date1 = new DateTime($tanggalSewa);
            $date2 = new DateTime($tanggalKembali);
            $diff = $date1->diff($date2);
            $lamanyaSewa = $diff->days + 1;

            $hargaTotal = $lamanyaSewa * $hargaPerhari;
        }

        $_SESSION['namaLengkap'] = $namaLengkap;
        $_SESSION['mobil'] = $mobil;
        $_SESSION['alamat'] = $alamat;
        $_SESSION['tanggalSewa'] = $tanggalSewa;
        $_SESSION['tanggalKembali'] = $tanggalKembali;
        $_SESSION['hargaTotal'] = $hargaTotal;
        header("Location: sewa3.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa2</title>
    <link rel="stylesheet" href="./CSS/sewa2Style.css?v=1.0">
</head>
<body>
    <div class="container">
        <header>Formulir Sewa</header>
        
        <form action="" method="post">
            <div class="input-box">
                <label for="NamaLengkap">Nama Lengkap</label>
                <input type="text" placeholder="Masukan Nama" name="namaLengkap" required>
            </div>

            <div class="input-box">
                <label for="MobilDisewa">Mobil Disewa</label>
                <input 
                    type="text" 
                    name="mobil" 
                    value="<?php echo isset($_SESSION['nama_mobil']) ? $_SESSION['nama_mobil'] . ' ' . $_SESSION['model_mobil'] : ''; ?>" 
                    readonly 
                    required
                >
            </div>

            <div class="input-box">
                <label for="HargaPerhari">Harga Perhari</label>
                <input 
                    type="number" 
                    name="harga" 
                    value="<?php echo isset($_SESSION['harga_perhari']) ? $_SESSION['harga_perhari'] : ''; ?>" 
                    readonly 
                    required
                >
            </div>

            <div class="input-box">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="column">
                <div class="input-box">
                    <label for="TanggalSewa">Tanggal Sewa</label>
                    <input type="date" name="tanggalSewa" required value="<?php echo $tanggalSewa; ?>">
                </div>
                <div class="input-box">
                    <label for="TanggalKembali">Tanggal Kembali</label>
                    <input type="date" name="tanggalKembali" required value="<?php echo $tanggalKembali; ?>">
                </div>
            </div>

            <div class="input-box">
                <button type="submit">Sewa</button>
                <button class="back-button" onclick="history.back()">Kembali</button>
            </div>
        </form>
    </div>
</body>
</html>
