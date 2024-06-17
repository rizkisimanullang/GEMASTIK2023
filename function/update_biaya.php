<?php
// Include file koneksi ke database
include("functions.php");



// Ambil data email dan nilai baru dari permintaan POST
$email = $_POST['email'];
$newBiaya = $_POST['biaya'];

// Query untuk memperbarui harga konsultasi
$query = "UPDATE konsultan SET Biaya_Konsultasi = '$newBiaya' WHERE Email = '$email'";
$updateResult = mysqli_query($conn, $query);

if ($updateResult) {
    // Mengembalikan respons sukses ke klien
    echo $newBiaya;
   
} else {
    // Mengembalikan respons gagal ke klien
    echo 'error';
}
?>