<?php
$conn = new mysqli("localhost", "root", "", "pgweb7_baru");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

// Ambil data koordinat untuk peta
$petaData = [];
$petaResult = $conn->query("SELECT kecamatan, latitude, longitude FROM data_kecamatan");
while ($row = $petaResult->fetch_assoc()) {
    $petaData[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peta dan Data Kabupaten Sleman</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Lottie Animation -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<!-- LeafletJS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

    #map {
    width: 85%;
    height: 300px; /* 🔽 dari 400px jadi 300px */
    margin: 15px auto 25px auto;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(78,158,255,0.25), 0 0 40px rgba(78,158,255,0.1);
    border: 1px solid rgba(78,158,255,0.15);
}

/* Efek bayangan elegan di sekitar tabel */
table {
    width: 90%;
    margin: 0 auto 40px auto;
    border-collapse: collapse;
    background-color: #252540;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(78,158,255,0.25), 0 0 40px rgba(78,158,255,0.1);
    border: 1px solid rgba(78,158,255,0.15);
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

<!-- ✅ PETA DITAMBAHKAN DI SINI -->
<div id="map"></div>
<script>
    var map = L.map('map').setView([-7.75, 110.36], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var data = <?php echo json_encode($petaData); ?>;
    data.forEach(function (item) {
        if (item.latitude && item.longitude) {
            L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup("<b>" + item.kecamatan + "</b><br>Lat: " + item.latitude + "<br>Lon: " + item.longitude);
        }
    });
</script>
<!-- ✅ PETA SAMPAI SINI -->

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
          <a href="edit/index.php?id=<?= $row['id']; ?>" 
          style="color:white; background:#00b894; padding:5px 10px; border-radius:5px; text-decoration:none; margin-right:5px;">
          ✏️ Edit
         </a>
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