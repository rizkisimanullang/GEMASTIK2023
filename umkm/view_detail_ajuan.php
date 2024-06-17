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

$id_ajuan = $_GET['id'];

$sql = "SELECT status_pembayaran, jumlah_pembayaran FROM pembayaran WHERE id_ajuan = '$id_ajuan'";
$resultPembayaran = $conn->query($sql);

if ($resultPembayaran->num_rows > 0) {
    // Output data dari setiap baris
    $row = $resultPembayaran->fetch_assoc() ;
    $statusPembayaran = $row["status_pembayaran"];
    $jumlahPembayaran = $row["jumlah_pembayaran"];

    
    }
 else {
    echo "";
}



if (isset($_POST['submit'])) {
    // Panggil fungsi menolak ajuan di sini
    menolakajuan($id_ajuan, $_POST['alasan']);
}

// Query untuk mengambil data ajuan berdasarkan ID ajuan
$query_ajuan = "SELECT * FROM ajuan WHERE id_ajuan = $id_ajuan";
$result_ajuan = mysqli_query($conn, $query_ajuan);

if (isset($_POST['batalkan'])) {
 
  $query = "UPDATE ajuan SET status_ajuan = 'dibatalkan' WHERE id_ajuan = $id_ajuan";

  // Eksekusi query
  if (mysqli_query($conn, $query)) {
      // Menggunakan JavaScript alert untuk menampilkan pesan
      echo "<script>alert('Ajuan berhasil dibatalkan.');</script>";
  } else {
      echo "Terjadi kesalahan: " . mysqli_error($conn);
  }
  
}

// Memeriksa apakah data ajuan ditemukan
if (mysqli_num_rows($result_ajuan) > 0) {
    $row_ajuan = mysqli_fetch_assoc($result_ajuan);

    // Ambil data yang dibutuhkan dari hasil query
    $status_ajuan = $row_ajuan['status_ajuan'];
    $detail_ajuan = $row_ajuan['detail_ajuan'];
    $tanggal_konsultasi = $row_ajuan['tanggal_konsultasi'];
    $jam_konsultasi = $row_ajuan['jam_konsultasi'];
    $topik_konsultasi = $row_ajuan['topik_konsultasi'];
    $durasi_konsultasi = $row_ajuan['durasi_konsultasi'];
    $alasan_penolakan = $row_ajuan['alasan_penolakan'];
    $tempat_konsultasi = $row_ajuan['tempat_konsultasi'];

    // Lakukan query untuk mengambil detail Konsultan berdasarkan ID konsultan
    $id_konsultan = $row_ajuan['id_konsultan'];
    $query_konsultan = "SELECT * FROM konsultan WHERE ID_Konsultan = $id_konsultan";
    $result_konsultan = mysqli_query($conn, $query_konsultan);

    // Memeriksa apakah data Konsultan ditemukan
    if (mysqli_num_rows($result_konsultan) > 0) {
        $row_konsultan = mysqli_fetch_assoc($result_konsultan);

        // Ambil data detail Konsultan yang dibutuhkan
        $nama_konsultan = $row_konsultan['Nama'];
        $alamat_konsultan = $row_konsultan['Alamat'];
        $kontak_konsultan = $row_konsultan['Kontak'];
        $email_konsultan = $row_konsultan['Email'];
        $kota_konsultan = $row_konsultan['kota_konsultan'];
        $deskripsi_konsultan = $row_konsultan['Deskripsi'];
        $biaya_konsultan = $row_konsultan['Biaya_Konsultasi'];
        $jumlahPembayaran = $biaya_konsultan * $durasi_konsultasi;

// Tambahkan kode berikut di sini untuk menentukan apakah button harus dalam keadaan disabled atau tidak
$isDisabled = ($status_ajuan === 'diterima' || $status_ajuan === 'ditolak') ? 'disabled' : '';

// Tambahkan gaya CSS untuk mengubah gaya kursor menjadi "not-allowed" jika tombol dinonaktifkan
$cursorStyle = ($isDisabled) ? 'style="cursor: not-allowed;"' : '';

// Tambahkan gaya CSS untuk menyembunyikan tombol jika status_ajuan adalah 'ditolak', 'dibatalkan', 'menunggu', atau 'disetujui'
$displayStyle = ($status_ajuan === 'ditolak' || $status_ajuan === 'dibatalkan' || $status_ajuan === 'menunggu' || (isset($statusPembayaran) && ($statusPembayaran === 'disetujui' || $statusPembayaran === 'Menunggu'))) ? 'style="display: none;"' : '';


        // Tampilkan data ajuan dan detail Konsultan
        ?>
<div class="container mx-auto px-20">
<div>
<div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-8" style="cursor: auto;">
  <div class="max-w-lg mx-auto overflow-hidden rounded-lg shadow-lg lg:max-w-none lg:flex">
    <div class="flex-1 px-6 py-8 bg-white lg:p-12" style="cursor: auto;">
      <h3 class="text-2xl font-extrabold text-gray-900 sm:text-3xl" style="cursor: auto;">Detail Ajuan</h3>
      <h3 class="text-2xl font-extrabold text-white sm:text-3xl mb-15" style="cursor: auto; background-color:
<?php
if ($status_ajuan == 'ditolak') {
    echo 'red';
} elseif ($status_ajuan == 'diterima') {
    echo 'green';
} else {
    echo 'gray';
}
?>;">
    Status Ajuan: <?= $status_ajuan; ?>
</h3>
<br>


<h3 class="text-2xl font-extrabold text-white sm:text-3xl mb-15" style="cursor: auto; background-color:
<?php
if ($status_ajuan == 'ditolak') {
    echo 'red';
} elseif ($status_ajuan == 'diterima') {
    echo 'green';
} else {
    echo 'gray';
}
?>;">
    Status Pembayaran:
    <?php
    if (isset($statusPembayaran)) {
        echo $statusPembayaran;
    } else {
        echo 'belum dibayar';
    }
    ?>
</h3>

<br>
<h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white">Total Bayar</h4>
<p class="text-lg mt-6 text-base text-gray-500">     
<span class="text-xl text-gray-400 rounded-lg border border-gray-300 p-1"><?= formatCurrency($jumlahPembayaran);  ?> </span></p>

</span>
<br>
<div class="flex items-center">
          <h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white">Rencana Konsultasi</h4>
          <div class="flex-1 border-t-2 border-gray-200"></div>
        </div>
      <p class="mt-6 text-base text-gray-500"><?= $detail_ajuan; ?></p>
      <div class="mt-8">
        <div class="flex items-center">
          <h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white">Rencana Konsultasi</h4>
          <div class="flex-1 border-t-2 border-gray-200"></div>
        </div>
        <ul class="mt-8 space-y-5 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Tanggal Konsultasi: </b><br><?= $tanggal_konsultasi; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Jam Konsultasi: </b><br><?= $jam_konsultasi; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Topik Konsultasi: </b><br><?= $topik_konsultasi; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Durasi Konsultasi: </b><br><?= $durasi_konsultasi; ?> Jam</p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Tempat Konsultasi: </b><br><?= $tempat_konsultasi; ?></p>
          </li>
        </ul>
      </div>

      <div class="mt-8">
        <div class="flex items-center">
          <h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white">Detail Konsultan</h4>
          <div class="flex-1 border-t-2 border-gray-200"></div>
        </div>
        <ul class="mt-8 space-y-5 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700">id_umkm</p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Nama Konsultan: </b><br><?= $nama_konsultan; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Alamat Konsultan: </b><br><?= $alamat_konsultan; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Kontak Konsultan: </b><br><?= $kontak_konsultan; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Email Konsultan: </b><br><?= $email_konsultan; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Kota Konsultan: </b><br><?= $kota_konsultan; ?></p>
          </li>
        </ul>
        <p class="mt-6 text-base text-gray-500"><b>Deskripsi Singkat Konsultan</b></p>
        <p class="mt-6 text-base text-gray-500"><?= $deskripsi_konsultan; ?></p>
        <br><br>
        <hr>
        <p class="mt-6 text-base text-red-500">*NOTE: Anda dapat melakukan pembayaran jika konsultan menyetujui ajuan permohonan konsultasi Anda</p>
      </div>
      
    </div>
    <div class="px-6 py-8 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12" style="cursor: auto;">
    <div class="mt-6">
    <div class="rounded-md shadow">
    <form method="POST" action="halaman_pembayaran.php?id_ajuan=<?php echo $id_ajuan; ?>">
      <input type="hidden" name="jumlahPembayaran" value="<?php echo $jumlahPembayaran; ?>">
  <button <?= $displayStyle; ?> id="bayarButton" type="submit" name="lakukanBayar" class="flex items-center justify-center w-full px-5 py-3 text-base font-medium text-white bg-green-800 border border-transparent rounded-md hover:bg-gray-900" target="_blank">LAKUKAN PEMBAYARAN</button>
</form>

</div>

</div>
      <div class="mt-6">
        <div class="rounded-md shadow">
            <form method="POST" action="" >
            <button <?= $displayStyle; ?> id="terimaButton" type="submit" name="batalkan" class="flex items-center justify-center w-full px-5 py-3 text-base font-medium text-white bg-red-800 border border-transparent rounded-md hover:bg-gray-900" target="_blank">BATALKAN PERMINTAAN</button>

            </form>
        </div>
      </div>
      <!-- <div class="mt-4 text-sm">
        <a href="https://stackdiary.com/" class="font-medium text-gray-700 hover:text-gray-900" target="_blank">Or pick a 
          <span class="font-bold">lifetime</span> plan
        </a>
      </div> -->
    </div>
  </div>
  <?php
if (isset($_POST['tolak'])) {
    echo '
    <div id ="alasan" class="mt-6">
        <form method="POST" action="">
            <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
            <textarea name="alasan" rows="4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
            <button type="submit" name="submit" class="mt-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Kirim</button>
            <button type="button" id="batal" class="mt-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Batal</button>
        </form>
    </div>
    ';

    
}
?>
<script>
document.getElementById("batal").addEventListener("click", function() {
    document.getElementById("alasan").style.display = "none";
});

function disableButton() {
        // Mengambil tombol 'terima' dan 'submit' berdasarkan ID atau class
        var terimaButton = document.getElementById('terimaButton');
        var submitButton = document.getElementById('submitButton');

        // Menonaktifkan tombol
        terimaButton.disabled = true;
        submitButton.disabled = true;

        // Menampilkan pesan notifikasi
        alert("Tombol telah dinonaktifkan.");
    }
</script>

</div>
</div>
</div>

        <?php
        } else {
            // Data UMKM tidak ditemukan
            echo "Data UMKM tidak ditemukan.";
        }
    } else {
        // Data ajuan tidak ditemukan
        echo "Data ajuan tidak ditemukan.";
    }

    ?>

</body>

</html>
