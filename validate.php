<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "miniproject";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

$username = $_POST['username'];  
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";  
$result = mysqli_query($conn, $sql);  
$count = mysqli_num_rows($result);

//validasi login dengan php
if ($count > 0) {  
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("Location:index.php");
    exit();
}
else {  
    echo "<h1>Login failed. Invalid username or password.</h1>";  
}
?>