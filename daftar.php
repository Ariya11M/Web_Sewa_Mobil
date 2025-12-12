<?php 
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $role = 'user';

    if (insertAkun($user_id, $username, $email, $password, $first_name, $last_name, $phone_number, $role)) {
        echo "<script>alert('Akun berhasil ditambahkan'); window.location.href = 'login.php';</script>";
    } else {
        alert();
    }
}

function insertAkun($user_id, $username, $email, $password, $first_name, $last_name, $phone_number, $role) {
    global $con;
    $sql = "INSERT INTO users (user_id, username, email, password, first_name, last_name, phone_number, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssss", $user_id, $username, $email, $password, $first_name, $last_name, $phone_number, $role);
    return $stmt->execute();
}

function alert() {
    echo "<script>alert('Data gagal disimpan'); window.location.href = 'daftar.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAFTAR</title>

    <link rel="stylesheet" href="./CSS/loginStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
        <div class="box">
            <form action="" method="POST">
                <h1 class="loginHeader">Daftar</h1>
                <input type="hidden" name="user_id">
                <label for="username">Username</label>
                <input type="text" name="username" class="usernameField" placeholder="Masukan Username" required id="username">
                <label for="email">Email</label>
                <input type="email" name="email" class="emailField" placeholder="Masukkan Email" required id="email">
                <label for="password">Password</label>
                <input type="password" name="password" class="passwordField" placeholder="Masukan Password" required id="password">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="first_nameField" placeholder="Masukkan Nama Depan" id="first_name" required>
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="last_nameField" placeholder="Masukkan Nama Belakang" id="last_name" required>
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="phone_numberField" id="phone_number" placeholder="Masukkan Nomor HP" required>
                <input type="submit" value="Daftar" class="tombolLogin" name="Daftar">
            </form>
        </div>
    </div>
</body>
</html>
