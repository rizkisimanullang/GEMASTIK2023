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


// Jika tombol "Submit" diklik
if(isset($_POST['kirim'])) {
    // Ambil nilai inputan
    $komentar = $_POST['komentar'];
    $rating = $_POST['rating'];

    // Panggil fungsi komentarDanRating untuk mengupdate kolom komentar dan rating
    $result = komentarDanRating($id_konsultasi, $komentar, $rating);

    // Cek hasil update
    if($result) {
        // Update berhasil
        echo "Komentar dan rating berhasil diperbarui.";
    } else {
        // Update gagal
        echo "Gagal memperbarui komentar dan rating.";
    }
}

// Jika tombol "Submit" diklik
// Jika tombol "Submit" diklik
if (isset($_POST['tombolSelesai'])) {
    // Panggil fungsi selesaiKonsultasi untuk mengubah status_konsultasi
    $result = selesaiKonsultasi($id_konsultasi);

    // Cek hasil update
    if ($result) {
        // Update berhasil
        echo '<script>alert("Status konsultasi berhasil diubah menjadi \'Telah Berlangsung\'");</script>';
    } else {
        // Update gagal
        echo '<script>alert("Gagal mengubah status konsultasi");</script>';
    }
}



// Mendapatkan data konsultasi berdasarkan id_konsultasi // Mengganti dengan cara Anda mendapatkan id_konsultasi
$konsultasi = getDataKonsultasi($id_konsultasi); // Ganti getDataKonsultasi() dengan metode yang Anda gunakan untuk mendapatkan data konsultasi
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
            <p class="text-sm font-medium ';
if ($status_konsultasi == "Akan Berlangsung") {
    echo 'text-gray-400';
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
            <span class="text-sm font-medium text-gray-500">Konsultan: ' . $id_konsultan . '</span>
            <span class="text-sm font-medium text-gray-500">Tanggal Konsultasi: ' . $tanggal_konsultasi . '</span>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600"><b>Durasi Konsultasi: </b> ' . $durasi_konsultasi . '</p>
            <p class="text-sm text-gray-600"><b>Hasil Konsultasi: </b>' . $hasil_konsultasi . '</p>
            
            <p class="text-sm text-gray-600"><b>Jam Konsultasi: </b>' . $jam_konsultasi . '</p>
            <p class="text-sm text-gray-600"><b>Tempat Konsultasi: </b>' . $tempat_konsultasi . '</p>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500">*Tekan tombol selesai apabila konsultasi telah selesai diadakan dan kemudian berikan feedback dan rating kepada konsultan</p>
        </div>

        <div class="mt-4">
            <form action=" " method="POST" onsubmit="return confirm(\'Apakah Anda yakin ingin mengubah status konsultasi?\')">
                <input type="hidden" name="id_konsultasi" value="' . $id_konsultasi . '">
                <button type="submit" name="tombolSelesai" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Selesai</button>
            </form>
        </div>
        <br /><br /><br />
        <hr>
        <br>
        <div class="px-4 py-2 bg-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Kolom Komentar dan Rating</h2>
        </div>
        <!-- Form Komentar dan Rating -->
        <form action="" method="POST">
            <input type="hidden" name="id_konsultasi" value="' . $id_konsultasi . '">
            <div class="mt-4">
                <label for="komentar" class="block text-sm font-medium text-gray-700">Komentar:</label>
                <textarea id="komentar" name="komentar" rows="4" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
            <div class="mt-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                <input type="number" id="rating" name="rating" min="1" max="5" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mt-4">
                <button name= "kirim" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>';





    
} else {
    echo '<p class="text-gray-500">Data konsultasi tidak ditemukan.</p>';
}
?>

 
 

</body>

</html>
