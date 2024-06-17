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

    if (isset($_POST['terima'])) {
        // Panggil fungsi menerimaajuan dengan parameter ajuanId
        menerimaajuan($id_ajuan);
    }

      if (isset($_POST['submit'])) {
        // Panggil fungsi menolak ajuan di sini
        menolakajuan($id_ajuan, $_POST['alasan']);
    }


    // Query untuk mengambil data ajuan berdasarkan ID ajuan
    $query_ajuan = "SELECT * FROM ajuan WHERE id_ajuan = $id_ajuan";
    $result_ajuan = mysqli_query($conn, $query_ajuan);

    // Memeriksa apakah data ajuan ditemukan
    if (mysqli_num_rows($result_ajuan) > 0) {
        $row_ajuan = mysqli_fetch_assoc($result_ajuan);

        // Ambil data yang dibutuhkan dari hasil query
        // Ambil data yang dibutuhkan dari hasil query
        $status_ajuan = $row_ajuan['status_ajuan'];
        $detail_ajuan = $row_ajuan['detail_ajuan'];
        $tanggal_konsultasi = $row_ajuan['tanggal_konsultasi'];
        $jam_konsultasi = $row_ajuan['jam_konsultasi'];
        $topik_konsultasi = $row_ajuan['topik_konsultasi'];
        $durasi_konsultasi = $row_ajuan['durasi_konsultasi'];
        $alasan_penolakan = $row_ajuan['alasan_penolakan'];
        // $id_pembayaran = $row_ajuan['id_pembayaran'];
        $tempat_konsultasi = $row_ajuan['tempat_konsultasi'];

        // Tambahkan kode berikut di sini untuk menentukan apakah button harus dalam keadaan disabled atau tidak
    $isDisabled = ($status_ajuan === 'diterima' || $status_ajuan === 'ditolak') ? 'disabled' : '';

    // Tambahkan gaya CSS untuk mengubah gaya kursor menjadi "not-allowed" jika tombol dinonaktifkan
    $cursorStyle = ($isDisabled) ? 'style="cursor: not-allowed;"' : '';

    // Tambahkan gaya CSS untuk menyembunyikan tombol jika status_ajuan adalah 'diterima' atau 'ditolak'
    $displayStyle = ($status_ajuan === 'diterima' || $status_ajuan === 'ditolak' || $status_ajuan === 'dibatalkan') ? 'style="display: none;"' : '';

        // Lakukan query untuk mengambil detail UMKM berdasarkan ID umkm
        $id_umkm = $row_ajuan['id_umkm'];
        $query_umkm = "SELECT * FROM umkm WHERE id_umkm = $id_umkm";
        $result_umkm = mysqli_query($conn, $query_umkm);

        // Memeriksa apakah data UMKM ditemukan
        if (mysqli_num_rows($result_umkm) > 0) {
            $row_umkm = mysqli_fetch_assoc($result_umkm);

            // Ambil data detail UMKM yang dibutuhkan
            // Ambil data detail UMKM yang dibutuhkan
            $nama_umkm = $row_umkm['nama'];
            $alamat_umkm = $row_umkm['alamat'];
            $kontak_umkm = $row_umkm['kontak'];
            $email_umkm = $row_umkm['email'];
            $kota_umkm = $row_umkm['kota_umkm'];
            $informasi_bisnis = $row_umkm['informasi_bisnis'];


            // Tampilkan data ajuan dan detail UMKM
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
<br><br>
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
          <h4 class="flex-shrink-0 pr-4 text-sm font-semibold tracking-wider text-indigo-600 uppercase bg-white">Detail Pengaju</h4>
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
            <p class="ml-3 text-sm text-gray-700"><b>Nama Pengaju: </b><br><?= $nama_umkm; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Alamat Pengaju: </b><br><?= $alamat_umkm; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Kontak Pengaju: </b><br><?= $kontak_umkm; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Email Pengaju: </b><br><?= $email_umkm; ?></p>
          </li>
          <li class="flex items-start lg:col-span-1">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <p class="ml-3 text-sm text-gray-700"><b>Kota Pengaju: </b><br><?= $kota_umkm; ?></p>
          </li>
        </ul>
        <p class="mt-6 text-base text-gray-500"><b>Informasi Bisnis Pengaju</b></p>
        <p class="mt-6 text-base text-gray-500"><?= $informasi_bisnis; ?></p>
        <br><br>
        <hr>
        <p class="mt-6 text-base text-red-500">*NOTE: Anda berhak menerima atau menolak ajuan. Jika Anda menolak ajuan pastikan memberikan alasan yang jelas mengapa ajuan tersebut ditolak</p>
      </div>
      
    </div>
    <div class="px-6 py-8 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12" style="cursor: auto;">
      <div class="mt-6">
        <div class="rounded-md shadow">
            <form method="POST" action="" >
                <button id="terimaButton" <?= $displayStyle; ?>  <?= $isDisabled; ?> <?= $cursorStyle; ?>  type="submit" name="terima" class="flex items-center justify-center w-full px-5 py-3 text-base font-medium text-white bg-green-800 border border-transparent rounded-md hover:bg-gray-900" target="_blank">TERIMA</button>
            </form>
        </div>
      </div>
      <div class="mt-6">
        <div class="rounded-md shadow">
            <form method="POST" action="" >
                <button  <?= $displayStyle; ?>   id="tolakButton"   <?= $isDisabled; ?> <?= $cursorStyle; ?> type="submit" name="tolak" class="flex items-center justify-center w-full px-5 py-3 text-base font-medium text-white bg-red-800 border border-transparent rounded-md hover:bg-gray-900" target="_blank">TOLAK</button>
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
