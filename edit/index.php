<!DOCTYPE html>
<html>
<head>
    <title>Form Edit</title>
</head>
<body>
<h2>Form Edit</h2>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb7_baru"; // pastikan sesuai nama database kamu

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan ada ID di URL
if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan di URL.";
    exit;
}

$id = intval($_GET['id']); // amankan ID dari URL

// Ambil data berdasarkan ID
$sql = "SELECT * FROM data_kecamatan WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <form action="edit.php" method="post" onsubmit="return validateForm(event)">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="kecamatan">Kecamatan:</label><br>
        <input type="text" id="kec" name="kecamatan" value="<?php echo $row['kecamatan']; ?>"><br>

        <label for="longitude">Longitude:</label><br>
        <input type="text" id="long" name="longitude" value="<?php echo $row['longitude']; ?>"><br>

        <label for="latitude">Latitude:</label><br>
        <input type="text" id="lat" name="latitude" value="<?php echo $row['latitude']; ?>"><br>

        <label for="luas">Luas:</label><br>
        <input type="text" id="luas" name="luas" value="<?php echo $row['luas']; ?>"><br>

        <label for="jumlah_penduduk">Jumlah Penduduk:</label><br>
        <input type="text" id="jml_pddk" name="jumlah_penduduk" value="<?php echo $row['jumlah_penduduk']; ?>"><br><br>

        <input type="submit" value="Simpan">
    </form>

    <p id="informasi"></p>

    <script>
    function validateForm(event) {
        let luas = document.getElementById("luas").value;
        let text = "";
        if (isNaN(luas) || luas < 1) {
            text = "Data luas harus berupa angka dan tidak boleh negatif.";
            document.getElementById("informasi").innerHTML = text;
            event.preventDefault();
            return false;
        }
        return true;
    }
    </script>
<?php
} else {
    echo "Data dengan ID tersebut tidak ditemukan.";
}

$conn->close();
?>

</body>
</html>
