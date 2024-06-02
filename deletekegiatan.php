<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

if (isset($_POST['id_kegiatan'])) {
    $id_kegiatan = $_POST['id_kegiatan'];
    $sql = "SELECT filepath FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $filepath = $row['filepath'];

    // HAPUS IMG DARI FOLDER imagefolder
    if (file_exists($filepath)) {
        unlink($filepath);
    }

    // HAPUS DATA DARI DB
    $sql = "DELETE FROM kegiatan WHERE id_kegiatan = '$id_kegiatan'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Activity deleted successfully.";
    } else {
        echo "Error deleting activity: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
