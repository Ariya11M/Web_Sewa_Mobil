<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobil_id = $_POST['mobil_id'];
    $status = $_POST['status'];

    $query = "UPDATE mobil SET status_ketersediaan = '$status' WHERE mobil_id = '$mobil_id'";
    if (mysqli_query($con, $query)) {
        header("Location: adminKelola.php"); // Redirect kembali ke halaman kelola
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
}
?>
