<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "sewamobil";


    $con = mysqli_connect($hostname, $username, $password, $database);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Buat Insert ke Tabel Mobil
    function insertMobil($namaMobil, $model, $harga, $gambar) {
        global $con;

    
        $query = "INSERT INTO mobil (nama_mobil, model_mobil, harga_perhari, gambar) 
                  VALUES ('$namaMobil', '$model', '$harga', '$gambar')";
        $result = mysqli_query($con, $query);
    
        return $result;
    }

    //Buat ambil semua data dari tabel user
    function readAllUser(){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM users");
        return $result;
    }

    //Buat ambil semua data dari tabel mobil
    function readAllMobil(){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM mobil");
        return $result;
    }

    //Buat insert ke tabel sewa
    function insertSewa($user_id, $mobil_id, $tanggal_sewa, $tanggal_kembali, $harga_total,$alamat,$namaLengkap){
        global $con;
    
        $query = "INSERT INTO penyewaan (user_id, mobil_id, tanggal_sewa, tanggal_kembali, harga_total, alamat, nama_penyewa) 
                  VALUES ('$user_id', '$mobil_id', '$tanggal_sewa', '$tanggal_kembali', '$harga_total', '$alamat', '$namaLengkap')";
        $result = mysqli_query($con, $query);
    
        return $result;
    }

    //Buat ambil semua data penyewaan
    function readAllPenyewaan(){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM penyewaan");
        return $result;
    }

    //Buat ambil semua data penyewaan berdasarkan id
    function readPenyewaanByIdDetail($sewa_id){
        global $con;
        $query = "
        SELECT 
            penyewaan.nama_penyewa, 
            penyewaan.tanggal_sewa, 
            penyewaan.tanggal_kembali, 
            penyewaan.harga_total, 
            transaksi.uang_dibayar, 
            transaksi.tanggal_pembayaran, 
            transaksi.status 
        FROM penyewaan 
        JOIN transaksi ON penyewaan.sewa_id = transaksi.sewa_id
        WHERE penyewaan.sewa_id = '$sewa_id'"; 
        
        $result = mysqli_query($con, $query);
        return $result;
    }

    function readPenyewaanById($sewa_id){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM penyewaan WHERE sewa_id='$sewa_id'");
        return $result;
    }

    //Buat insert ke tabel Transaksi
    function insertTransaksi($sewa_id, $uang_dibayar, $tanggalpembayaran){
        global $con;
    
        $query = "INSERT INTO transaksi (sewa_id, uang_dibayar, tanggal_pembayaran, status) 
                  VALUES ('$sewa_id', '$uang_dibayar', '$tanggalpembayaran', 'LUNAS')";
        $result = mysqli_query($con, $query);
    
        return $result;
    }

    //Mengupdate Status Sewa
    function updateStatusSewa($sewa_id){
        global $con;
        $query = "UPDATE penyewaan SET status_sewa='sedang_disewa' WHERE sewa_id='$sewa_id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    function updateStatusKembali($sewa_id){
        global $con;
        $query = "UPDATE penyewaan SET status_sewa='sudah_dikembalikan' WHERE sewa_id='$sewa_id'";
        $result = mysqli_query($con, $query);
        return $result;
    }

    //Ambil data berdasatkan status
    function readPenyewaanByStatus($status_sewa){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM penyewaan WHERE status_sewa='$status_sewa'");
        return $result;
    }


    //Ambil semua data dari tabel transaksi
    function readAllTransaksi(){
        global $con;
        $result = mysqli_query($con, "SELECT * FROM transaksi");
        return $result;
    }

    //ambil data dari tabel tranasaksi dan sewa 
    function readTransaksiWithDetails(){
        global $con;
        $query = "
            SELECT 
                t.transaksi_id, 
                t.sewa_id, 
                t.uang_dibayar, 
                t.tanggal_pembayaran, 
                t.status, 
                p.nama_penyewa, 
                p.tanggal_sewa, 
                p.tanggal_kembali, 
                p.harga_total 
            FROM transaksi t
            INNER JOIN penyewaan p ON t.sewa_id = p.sewa_id
        ";
        $result = mysqli_query($con, $query);
        return $result;
    }

    //Laporan Keuangan
    function laporanKeuangan() {
        global $con;

        $query = "
            SELECT 
                t.transaksi_id,
                p.sewa_id,
                m.mobil_id,
                p.nama_penyewa,
                m.nama_mobil,
                m.model_mobil,
                t.uang_dibayar,
                t.tanggal_pembayaran,
                t.status
            FROM 
                transaksi t
            JOIN 
                penyewaan p ON t.sewa_id = p.sewa_id
            JOIN 
                mobil m ON p.mobil_id = m.mobil_id
            ORDER BY 
                t.tanggal_pembayaran DESC
        ";


        $result = mysqli_query($con, $query);


        if (!$result) {
            die("Query Salah: " . mysqli_error($con));
        }
        return $result;
    }

    //Mencari Mobil Yang Sering Dipesan
    function mobilSeringDipesan(){
        global $con;
        $query = 
        "
        SELECT 
            m.model_mobil, COUNT(*) AS jumlah_disewa 
            FROM penyewaan p
            JOIN mobil m ON p.mobil_id = m.mobil_id
            GROUP BY m.model_mobil 
            ORDER BY jumlah_disewa DESC 
            LIMIT 1
        ";
        $result = mysqli_query($con, $query);
        return $result;
    }

    //Mencari Total Pesanan
    function totalPesanan(){
        global $con;
        $query = "SELECT COUNT(*) AS total_pesanan FROM penyewaan";
        $result = mysqli_query($con, $query);
        return $result;
    }

    //Mencari Total Pemasukan
    function totalPemasukan(){
        global $con;
        $query = 
         "
            SELECT SUM(uang_dibayar) AS total_pemasukan 
            FROM transaksi 
            WHERE status = 'Lunas'
        ";
        $result = mysqli_query($con, $query);
        return $result;
    }


?>
