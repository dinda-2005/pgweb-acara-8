<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb7_baru";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT kecamatan, latitude, longitude FROM data_kecamatan";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Peta Kecamatan Sleman</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script>
        var map = L.map('map').setView([-7.75, 110.36], 11);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var data = <?php echo json_encode($data); ?>;
        data.forEach(function (item) {
            L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup("<b>" + item.kecamatan + "</b><br>Lat: " + item.latitude + "<br>Lon: " + item.longitude);
        });
    </script>
</body>

</html>