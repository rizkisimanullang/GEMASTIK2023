<?php
// Include file koneksi ke database
include("functions.php");


// $servername = "localhost";
// $username = "u1563648_u156364";
// $password = "aca1andri2iki3";
// $dbname = "u1563648_rizkiku";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data email dan nilai baru dari permintaan POST
if (isset($_POST["id_pembayaran"])) {
    $id_pembayaran = $_POST["id_pembayaran"];
  
    // Lakukan operasi penolakan pembayaran di database sesuai dengan kebutuhan Anda
    // Misalnya, Anda dapat mengubah status_pembayaran menjadi "Ditolak" di tabel pembayaran dengan ID yang sesuai
  
    // Contoh query update
    $query = "UPDATE pembayaran SET status_pembayaran = 'Ditolak' WHERE id_pembayaran = '$id_pembayaran'";
  
    if (mysqli_query($conn, $query)) {
      // Jika query berhasil dijalankan, kirim respons sukses ke klien
      echo "Pembayaran dengan ID $id_pembayaran berhasil ditolak.";
    } else {
      // Jika terjadi kesalahan saat menjalankan query, kirim respons gagal ke klien
      echo "Terjadi kesalahan saat menolak pembayaran. Silakan coba lagi.";
    }
  } else {
    // Jika ID pembayaran tidak ditemukan, kirim respons gagal ke klien
    echo "ID pembayaran tidak ditemukan.";
  }
?>

