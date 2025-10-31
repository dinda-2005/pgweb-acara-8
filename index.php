<?php
$conn = new mysqli("localhost", "root", "", "pgweb7_baru");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Kecamatan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Lottie Animation -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<style>
    body {
        font-family: 'Consolas', monospace;
        background-color: #1e1e2f;
        color: #ffffff;
        margin: 0;
        padding: 0;
    }
    h2 {
        text-align: center;
        color: #4e9eff;
        margin-top: 10px;
    }
    .nav {
        text-align: center;
        margin-bottom: 20px;
    }
    .nav a {
        background-color: #4e9eff;
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        margin: 5px;
        border-radius: 5px;
        transition: 0.3s;
    }
    .nav a:hover { background-color: #1a73e8; }

    table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
        background-color: #252540;
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        border: 1px solid #3a3a5a;
        padding: 10px;
        text-align: center;
        color: #e0e0e0;
    }
    th {
        background-color: #333357;
        color: #4e9eff;
    }
    tr:hover {
        background-color: #2e2e4e;
        transition: 0.3s;
    }
    .animation {
        text-align: center;
        margin-top: 20px;
    }
</style>
</head>
<body>

<div class="animation">
  <lottie-player 
      src="https://assets10.lottiefiles.com/packages/lf20_ydo1amjm.json"
      background="transparent"  
      speed="1"  
      style="width: 120px; height: 120px;"  
      loop  
      autoplay>
  </lottie-player>
</div>

<h2>📊 Data Kecamatan</h2>
<div class="nav">
    <a href="input/index.html"><i class="fa-solid fa-plus"></i> Tambah Data</a>
    <a href="eksport.php"><i class="fa-solid fa-file-export"></i> Export CSV</a>
</div>

<table>
  <tr>
    <th>ID</th>
    <th>Kecamatan</th>
    <th>Longitude</th>
    <th>Latitude</th>
    <th>Luas (km²)</th>
    <th>Jumlah Penduduk</th>
    <th>Aksi</th>
  </tr>

  <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row["id"]; ?></td>
        <td><?= $row["kecamatan"]; ?></td>
        <td><?= $row["longitude"]; ?></td>
        <td><?= $row["latitude"]; ?></td>
        <td><?= $row["luas"]; ?></td>
        <td><?= $row["jumlah_penduduk"]; ?></td>
        <td>
          <a href="hapus_data.php?id=<?= $row['id']; ?>"
             onclick="return confirm('Yakin ingin menghapus data ini?')"
             style="color:white; background:#ff4d6d; padding:5px 10px; border-radius:5px; text-decoration:none;">
             🗑️ Hapus
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="7">Belum ada data.</td></tr>
  <?php endif; ?>
</table>

<?php $conn->close(); ?>
</body>
</html>
