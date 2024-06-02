<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

// Check if the date parameter is provided
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $tanggalFormatted = date('Y-m-d', strtotime($tanggal));

    // Prepare the SQL query with a WHERE clause to filter by the specified date
    $sql = "SELECT * FROM kegiatan WHERE tanggal_mulai = '$tanggalFormatted'";
    $result = mysqli_query($conn, $sql);

    // Check if any records are found
    if (mysqli_num_rows($result) > 0) {
        // Create an array to store the activities
        $activities = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $activity = array(
                'id' => $row['id_kegiatan'],
                'name' => $row['nama_kegiatan'],
                'startdate' => $row['tanggal_mulai'],
                'finishdate' => $row['tanggal_selesai'],
                'jamkegiatan' => $row['jam_kegiatan'],
                'durasi' => $row['durasi'],
                'lokasi' => $row['lokasi'],
                'level' => $row['level'],
                'filepath' => $row['filepath'],
            );

            // Add the activity to the array
            $activities[] = $activity;
        }

        // Return the activities as JSON
        header('Content-Type: application/json');
        echo json_encode($activities);
    } else {
        // No activities found for the specified date
        echo json_encode(array());
    }
} else {
    // No date parameter provided
    echo "No date specified.";
}
?>
