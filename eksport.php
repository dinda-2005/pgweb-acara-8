<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pgweb7_baru");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data
$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>📊 Data Kecamatan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        background-color: #1e1e2f;
        color: #e0e0e0;
        font-family: 'Consolas', monospace;
        margin: 0;
        padding: 0;
    }
    header {
        text-align: center;
        padding: 25px;
        background-color: #252540;
        box-shadow: 0 2px 8px rgba(78,158,255,0.15);
    }
    header h2 {
        margin: 0;
        color: #4e9eff;
    }
    .container {
        width: 90%;
        margin: 30px auto;
        background-color: #2a2a40;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(78,158,255,0.15);
        padding: 20px;
    }
    .btn-group {
        text-align: center;
        margin-bottom: 20px;
    }
    a {
        display: inline-block;
        padding: 10px 18px;
        margin: 5px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        color: white;
        transition: 0.3s;
    }
    .btn-home {
        background-color: #ff5b5b;
    }
    .btn-home:hover {
        background-color: #ff2f2f;
    }
    .btn-export {
        background-color: #4e9eff;
    }
    .btn-export:hover {
        background-color: #1a73e8;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #4e9eff;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #24243a;
    }
    tr:hover {
        background-color: #303052;
    }
</style>
</head>
<body>

<header>
    <h2><i class="fa-solid fa-database"></i> Data Kecamatan</h2>
</header>

<div class="container">
    <div class="btn-group">
        <a href="index.php" class="btn-home"><i class="fa-solid fa-house"></i> Halaman Utama</a>
        <a href="export_csv.php" class="btn-export"><i class="fa-solid fa-file-export"></i> Export ke CSV</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Kecamatan</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Luas (km²)</th>
            <th>Jumlah Penduduk</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['kecamatan']; ?></td>
                <td><?= $row['longitude']; ?></td>
                <td><?= $row['latitude']; ?></td>
                <td><?= $row['luas']; ?></td>
                <td><?= $row['jumlah_penduduk']; ?></td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">Belum ada data.</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
<?php $conn->close(); ?>