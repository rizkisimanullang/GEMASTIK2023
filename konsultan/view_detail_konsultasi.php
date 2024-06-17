<?php
session_start();

//import database
require '../../function/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../masuk/konsultan/login.php");
    exit;
}

if (isset($_SESSION["login"])) {
    // Ambil email dari session
    $email = $_SESSION["email"];

    // Query untuk mendapatkan data pengguna
    $query = "SELECT * FROM konsultan WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ajuan UMKM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    .container {
  margin-top:5rem;
  margin-bottom:5rem;
  max-width:100%;
}

</style>

<body class="bg-gray-100">
<?php

$id_konsultasi = $_GET['idkonsultasi'];

// Mendapatkan data konsultasi berdasarkan id_konsultasi (Ubah dengan metode yang Anda gunakan untuk mendapatkan data konsultasi)
$konsultasi = getDataKonsultasi($id_konsultasi);

// Mengecek apakah data konsultasi ditemukan
if ($konsultasi) {
    $id_konsultasi = $konsultasi['id_konsultasi'];
    $id_konsultan = $konsultasi['id_konsultan'];
    $id_umkm = $konsultasi['id_umkm'];
    $tanggal_konsultasi = $konsultasi['tanggal_konsultasi'];
    $topik_konsultasi = $konsultasi['topik_konsultasi'];
    $durasi_konsultasi = $konsultasi['durasi_konsultasi'];
    $hasil_konsultasi = $konsultasi['hasil_konsultasi'];
    $status_konsultasi = $konsultasi['status_konsultasi'];
    $catatan = $konsultasi['catatan'];
    $rating = $konsultasi['rating'];
    $tanggal_rating = $konsultasi['tanggal_rating'];
    $komentar = $konsultasi['komentar'];
    $jam_konsultasi = $konsultasi['jam_konsultasi'];
    $tempat_konsultasi = $konsultasi['tempat_konsultasi'];
    

    // Mendapatkan data UMKM berdasarkan id_umkm (Ubah dengan metode yang Anda gunakan untuk mendapatkan data UMKM)
    $umkm = getDataUMKM($id_umkm);

    // Mengecek apakah data UMKM ditemukan
    if ($umkm) {
        $nama_umkm = $umkm['nama'];
 

        // Menampilkan data konsultasi dalam card
        echo '
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-4 py-2 bg-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">Detail Konsultasi</h2>
            </div>
            <div class="p-4 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">' . $topik_konsultasi . '</h3>
                    <span class="text-sm font-medium text-gray-500">ID Konsultasi: ' . $id_konsultasi . '</span>
                </div>
                <div>
                    <p class="text-sm font-medium  rounded-lg border border-gray-300 p-1"';
        if ($status_konsultasi == "akan berlangsung") {
            echo 'text-red-400';
        } elseif ($status_konsultasi == "Sedang Berlangsung") {
            echo 'text-blue-500';
        } elseif ($status_konsultasi == "Telah Berlangsung") {
            echo 'text-green-500';
        }
        echo '">' . $status_konsultasi . '</p>
                </div>
            </div>
            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-medium text-gray-500">Klien: ' . $nama_umkm . '</span>
                    <span class="text-sm font-medium text-gray-500">Tanggal Konsultasi: ' . $tanggal_konsultasi . '</span>
                </div>
                <div class="mb-4">
                <p class="text-sm text-gray-600"><i class="fas fa-clock"></i> <b>Durasi Konsultasi:</b> <span class = "rounded-lg border border-gray-300 p-1">' . $durasi_konsultasi . '</span></p><br>
                <p class="text-sm text-gray-600"><i class="fas fa-map-marker-alt"></i> <b>Tempat Konsultasi:</b> <br>' . $tempat_konsultasi . '</p><br>
                <p class="text-sm text-gray-600"><i class="far fa-clock"></i> <b>Jam Konsultasi:</b><br> ' . $jam_konsultasi . '</p>
            </div>
            

                <div class="mt-4">
                    <p class="text-xs text-gray-500">*Apabila sesi konsultasi telah selesai, maka Anda akan melihat komentar dan rating jika diberikan oleh klien Anda</p>
                </div>

 
            </div>
        </div>
        <br>
        <div class="max-w-lg mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-2 bg-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Rating dan Komentar dari <b> '. $nama_umkm .' </b> </h2>
        </div>
        <div class="p-4">
        <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-medium text-gray-500">Rating: ' . $rating . '</span>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600"><b>Komentar: </b><br>' . $komentar . '</p>
        </div>
    </div>
        </div>
        ';
    } else {
        echo '<p class="text-gray-500">Data UMKM tidak ditemukan.</p>';
    }
} else {
    echo '<p class="text-gray-500">Data konsultasi tidak ditemukan.</p>';
}
?>


 
 

</body>

</html>
