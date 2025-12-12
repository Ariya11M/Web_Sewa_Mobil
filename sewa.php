<?php 
    session_start();
    require("koneksi.php");

    if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
        header('Location: login.php');
        exit;
    }

    $data = readAllMobil();

    if(isset($_POST["sewa"])){
        $_SESSION["mobil_id"] = $_POST["mobil_id"];
        $_SESSION["nama_mobil"] = $_POST["nama_mobil"];
        $_SESSION["model_mobil"] = $_POST["model_mobil"];
        $_SESSION["harga_perhari"] = $_POST["harga_perhari"];

        header("Location: sewa2.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa</title>
    <link rel="stylesheet" href="./CSS/sewaStyle.css?v=1.0">
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
        <div class="imageAndText">
            <h1>Mobil Sewa, Mudah & Terjangkau</h1>
        </div class="imageAndText">
        <div class="container">
            <div class="gridContainer">
            <?php
                while ($row = mysqli_fetch_assoc($data)) {
                    $warna = ($row["status_ketersediaan"] == "Available") ? 'green' : 'red';
                    $isAvailable = ($row["status_ketersediaan"] == "Available");

                    echo "
                        <div class='gridItems'>
                            <div class='cardImg'>
                                <img src='" . $row["gambar"] . "' alt=''>
                            </div>
                            <div class='description'>
                                <p style='font-weight:700'>" . $row["nama_mobil"] . " " . $row["model_mobil"] . "</p>
                                <p>Rp " . number_format($row['harga_perhari'], 0, ',', '.') . "</p>
                                <p style='color: $warna'>" . $row["status_ketersediaan"] . "</p>
                            </div>
                            <form action='sewa.php' method='post'>
                                <input type='hidden' name='mobil_id' value='" . $row["mobil_id"] . "'>
                                <input type='hidden' name='nama_mobil' value='" . $row["nama_mobil"] . "'>
                                <input type='hidden' name='model_mobil' value='" . $row["model_mobil"] . "'>
                                <input type='hidden' name='harga_perhari' value='" . $row["harga_perhari"] . "'>
                                <input type='submit' value='Sewa' name='sewa' " . ($isAvailable ? "" : "disabled") . " 
                                style='" . ($isAvailable ? "" : "background-color: gray; cursor: not-allowed;") . "'>
                            </form>
                        </div>
                    ";
                }
            ?>

                
            </div>
        </div>
    </main>

</body>
</html>