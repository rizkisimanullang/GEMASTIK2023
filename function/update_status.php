<?php
// Include file koneksi ke database
include("functions.php");

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data email dan nilai baru dari permintaan POST
// Ambil data email dan nilai baru dari permintaan POST
$email = $_POST['email'];
$newStatus = $_POST['status'];

// Query untuk memperbarui status konsultan
$query = "UPDATE konsultan SET Status = '$newStatus' WHERE Email = '$email'";
$updateResult = mysqli_query($conn, $query);

if ($updateResult) {
    echo $newStatus;
} else {
    // Mengembalikan respons gagal ke klien
    echo 'error';
}
?>