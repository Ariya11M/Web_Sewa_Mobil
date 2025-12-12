<?php 
session_start();
require("koneksi.php");

if(isset($_SESSION["login"]) && $_SESSION["role"] == 'admin'){
    $_SESSION["login"] = true;
    header("LocationL: adminKelola.php");
    exit;
}

if(isset($_SESSION["login"]) && $_SESSION["role"] == 'user'){
    $_SESSION["login"] = true;
    header("Location: index.php");
    exit;
}

if(isset($_SESSION["login"]) && $_SESSION["role"] == 'kasir'){
    $_SESSION["login"] = true;
    header("Location: kasir.php");
    exit;
}

if (isset($_POST["login"])) {
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    $data = readAllUser();
    $loginSuccess = false;  // Tambahkan variabel untuk menandai keberhasilan login

    while ($row = mysqli_fetch_assoc($data)) {
        $user_id = $row["user_id"];
        $username = $row["username"];
        $password = $row["password"];
        $role = $row["role"];

        if ($inputUsername == $username && $inputPassword == $password) {
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $user_id;
            $_SESSION["role"] = $role;
            $_SESSION["login"] = true;  // Set session login

            if($role == 'admin'){
                header("Location: adminKelola.php");
            }else if($role == 'user'){
                header("Location: index.php");
            }else{
                header("Location: kasir.php");
            }
        }
    }

    if (!$loginSuccess) {  // Jika login tidak berhasil
        echo "<script>alert('Username atau Password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link rel="stylesheet" href="./CSS/loginStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="box">
            <form action="" method="POST">
                <h1 class="loginHeader">Login</h1>
                <label for="username">Username</label>
                <input type="text" name="username" class="usernameField" placeholder="Masukan Username" required>
                <label for="password">Password</label>
                <input type="password" name="password" class="passwordField" placeholder="Masukan Password" required>
                <label for="role">Role</label>
                <select name="role" id="role" required >
                    <option value="" name="" ></option>
                    <option value="admin" name="admin" >ADMIN</option>
                    <option value="user" name="user" >USER</option>
                    <option value="kasir" name="kasir" >KASIR</option>
                </select>
                <input type="submit" value="Login" class="tombolLogin" name="login">
            </form>
            <p>Belum memiliki akun? silahkan <a href="daftar.php">daftar disini</a></p>
        </div>
    </div>
</body>
</html>
