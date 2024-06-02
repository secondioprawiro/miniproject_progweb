<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

if(isset($_POST['submit'])){
    $namakegiatan = $_POST['namakegiatan'];
    $tanggalmulai = $_POST['tanggalmulai'];
    $tanggalselesai = $_POST['tanggalselesai'];
    $jamkegiatan = $_POST['jamkegiatan'];
    $durasi = $_POST['durasi'];
    $lokasi = $_POST['lokasi'];
    $level = $_POST['level'];
    
    if(isset($_FILES['gambar']['name'])){
        $uploadfile = "imagefolder/".$_FILES["gambar"]['name'];
        $tipefile = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));
        if($tipefile != "jpg" && $tipefile != "png" && $tipefile != "jpeg"){
            echo "Hanya bisa JPG,PNG, dan JPEG";
        }else{
            if(move_uploaded_file($_FILES['gambar']['tmp_name'],$uploadfile)){
                $sql = "INSERT INTO kegiatan (id_kegiatan, id, nama_kegiatan, tanggal_mulai, tanggal_selesai, jam_kegiatan, durasi, lokasi, level, filepath) 
                VALUES ('', 1, '$namakegiatan', '$tanggalmulai', '$tanggalselesai', '$jamkegiatan', '$durasi', '$lokasi', '$level' ,'$uploadfile')";

                if (mysqli_query($conn, $sql)) {
                    // Insert success
                    header("Location:berhasiladd.html");
                } else {
                    // Error
                    echo "Error tambah data";
                }
            }
        }

    }
}
?>