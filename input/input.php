<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pgweb7_baru");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude  = $_POST['latitude'];
$luas      = $_POST['luas'];
$penduduk  = $_POST['penduduk'];

// Query untuk memasukkan data ke tabel
$sql = "INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk) 
        VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$penduduk')";

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hasil Input Data</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        font-family: 'Consolas', monospace;
        background-color: #1e1e2f;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .card {
        background-color: #252540;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(78,158,255,0.2);
        text-align: center;
        width: 420px;
    }
    h2 {
        color: #4e9eff;
        margin-bottom: 15px;
    }
    p {
        font-size: 14px;
        color: #ccc;
    }
    .success {
        color: #4e9eff;
        font-weight: bold;
        margin-top: 15px;
    }
    .error {
        color: #ff5b5b;
        font-weight: bold;
        margin-top: 15px;
    }
    a {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: white;
        background-color: #4e9eff;
        padding: 10px 20px;
        border-radius: 6px;
        transition: 0.3s;
    }
    a:hover {
        background-color: #1a73e8;
    }
</style>
</head>
<body>
<div class="card">
    <h2><i class="fa-solid fa-database"></i> Simpan Data</h2>
    <?php
    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'><i class='fa-solid fa-circle-check'></i> Data berhasil disimpan!</p>";
    } else {
        echo "<p class='error'><i class='fa-solid fa-triangle-exclamation'></i> Gagal menyimpan data: " . $conn->error . "</p>";
    }
    ?>
    <a href="../index.php"><i class="fa-solid fa-house"></i> Kembali ke Data</a>
</div>
</body>
</html>

<?php
$conn->close();
?>