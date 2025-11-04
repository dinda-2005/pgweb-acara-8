<?php
// Ambil data dari form
$id = $_POST['id'];
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb7_baru"; // pastikan sama dengan di index.php

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query update
$sql = "UPDATE data_kecamatan 
        SET kecamatan='$kecamatan', longitude='$longitude', latitude='$latitude', 
            luas='$luas', jumlah_penduduk='$jumlah_penduduk'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = 'index.php?id=$id';
          </script>";
} else {
    echo "Error saat memperbarui data: " . $conn->error;
}

$conn->close();
?>
