<?php
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/homeStyle.css?v=1.0">
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
        <div class="text">
            <h2>Perjalanan Nyaman Dimulai di Sini </h2>
            <p>Sewa mobil dengan harga terjangkau, layanan terpercaya, dan pilihan kendaraan yang lengkap. Siap menemani perjalanan Anda kapan saja!</p>
        </div>
        <div class="imgContainer">
            <img src="./images/Mobil.png" alt="">
        </div>
    </main>

</body>
</html>