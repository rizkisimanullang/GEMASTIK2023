<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      /* Tambahkan gaya CSS untuk gambar latar belakang */
      body {
        background-image: url('../assets/img/forgot-password-office-dark.jpeg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
    </style>
  </head>
  <body>
  <?php
session_start();
require '../../function/functions.php';

// Cek apakah pengguna telah login
if (isset($_SESSION["login"]) && isset($_SESSION["email"])) {
  $email = $_SESSION["email"];

  // Query untuk mendapatkan data pengguna
  $result = mysqli_query($conn, "SELECT * FROM umkm WHERE email = '$email'");

  // Periksa apakah data pengguna ditemukan
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    $kontak = $row['kontak'];
    $foto_profil = $row['foto_profil'];
    $informasi_bisnis = $row['informasi_bisnis'];
    $kota_umkm = $row['kota_umkm'];


    // Periksa apakah form disubmit
    if (isset($_POST['submit'])) {
      // Ambil data yang diinputkan oleh pengguna
      $newNama = $_POST['nama'];
      $newAlamat = $_POST['alamat'];
      $newKontak = $_POST['kontak'];
      $newInformasiBisnis = $_POST['informasi_bisnis'];
      $gambar_lama = $_FILES['gambar']['name'];
      $newKota = $_POST['kota_umkm'];
      
      if ($_FILES['gambar']['error'] === 4) {
          $gambar = $gambar_lama;
      } else {
          $gambar = upload();
      }
      
      // Update data pengguna di database
      $updateResult = mysqli_query($conn, "UPDATE umkm SET nama = '$newNama', alamat = '$newAlamat', kontak = '$newKontak', informasi_bisnis = '$newInformasiBisnis', foto_profil = '$gambar', kota_umkm = '$newKota' WHERE email = '$email'");
      

      if ($updateResult) {
        // Redirect ke halaman home.php setelah berhasil mengupdate data
        header("Location: home.php");
        exit;
      } else {
        echo "Gagal mengupdate data pengguna";
      }
    }

    // Tampilkan form edit profil
    ?>
<div class="flex items-center justify-center h-screen bg-gray-100">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-xl w-full">
    <h2 class="text-2xl font-semibold mb-4">Lengkapi Profil</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="nama" class="block mb-2">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= $nama ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="alamat" class="block mb-2">Alamat</label>
      <input type="text" id="alamat" name="alamat" value="<?= $alamat ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="kota_umkm" class="block mb-2">Kota UMKM</label>
      <input type="text" id="kota_umkm" name="kota_umkm" value="<?= $kota_umkm ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="kontak" class="block mb-2">Kontak</label>
      <input type="text" id="kontak" name="kontak" value="<?= $kontak ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="informasi_bisnis" class="block mb-2">Informasi Bisnis</label>
      <textarea id="informasi_bisnis" name="informasi_bisnis" class="border border-gray-300 p-2 mb-4 w-full" required><?= $informasi_bisnis ?></textarea>

      <img style="width: 100px;" src="../assets/img/profil/<?= $foto_profil ?>" alt="Foto Profil">
      <label for="foto_profil" class="block mb-2">Foto Profil</label>
      <input type="file" id="gambar" name="gambar" class="mb-4" accept="image/*">

      <div class="flex justify-end">
        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-4" onclick="window.location.href='home.php'">Batal</button>
        <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

    <?php
  } else {
    echo "Data pengguna tidak ditemukan";
  }
} else {
  // Jika pengguna belum login, arahkan ke halaman login
  header("Location: login.php");
  exit;
}
?>

  </body>
</html>
