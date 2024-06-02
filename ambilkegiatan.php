<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

//Ambil kegiatan dari database
$sql = "SELECT * FROM kegiatan";
$result = mysqli_query($conn, $sql);

// Buat associative array untuk simpan kegiatan
$activities = array();

while ($row = mysqli_fetch_assoc($result)) {
    $activity = array(
        'id' => $row['id_kegiatan'],
        'name' => $row['nama_kegiatan'],
        'date' => $row['tanggal_mulai']
    );

    // Add the activity to the array
    $activities[] = $activity;
}

// Return the activities as JSON
header('Content-Type: application/json');
echo json_encode($activities);
?>
