<?php
$conn = new mysqli("localhost", "root", "", "pgweb7_baru");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM data_kecamatan WHERE id=$id");
}

$conn->close();
header("Location: index.php");
exit;
?> 