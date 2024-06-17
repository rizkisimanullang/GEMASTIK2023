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
  $result = mysqli_query($conn, "SELECT * FROM konsultan WHERE Email = '$email'");

  // Periksa apakah data pengguna ditemukan
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama = $row['Nama'];
    $alamat = $row['Alamat'];
    $kontak = $row['Kontak'];
    $email = $row['Email'];
    $riwayat_pendidikan = $row['Riwayat_Pendidikan'];
    $pengalaman = $row['Pengalaman'];
    // $id_spesialisasi = $row['id_spesialisasi'];
    $konsultan_foto = $row['konsultan_poto'];
    $deskripsi = $row['Deskripsi'];
    $kota = $row['kota_konsultan'];


    // Periksa apakah form disubmit
    if (isset($_POST['submit'])) {
      // Ambil data yang diinputkan oleh pengguna
      $newNama = $_POST['nama'];
      $newAlamat = $_POST['alamat'];
      $newKontak = $_POST['kontak'];
       
      $newRiwayatPendidikan = $_POST['riwayat_pendidikan'];
      $newPengalaman = $_POST['pengalaman'];
      $newIdSpesialisasi = $_POST['spesialisasi'];
      $newDeskripsi =  $_POST['deskripsi'];
      $newKota = $_POST['kota'];
      var_dump($newIdSpesialisasi);
      if (isset($_POST['gambar'])) {
        $gambar_lama = $_POST['gambar'];
        // Lakukan tindakan yang diperlukan dengan $gambar_lama
      } else {
        // Tidak ada input gambar yang dikirim
        // Lakukan tindakan alternatif atau abaikan kondisi ini
      }
      
      $konsultan_foto= "aa";
    
      if($_FILES['gambar']['error']=== 4) {
        $gambar = $gambar_lama;
      } else {
        $gambar = uploadKonsultan() ;
      }
      // Upload gambar


      // Update data pengguna di database
      $updateResult = mysqli_query($conn, "UPDATE konsultan SET nama = '$newNama', Deskripsi = '$newDeskripsi', alamat = '$newAlamat', kota_konsultan = '$newKota',  kontak = '$newKontak',  riwayat_pendidikan = '$newRiwayatPendidikan', pengalaman = '$newPengalaman', ID_Spesialisasi = '$newIdSpesialisasi', konsultan_poto = '$gambar' WHERE email = '$email'");

      if ($updateResult) {
        // Redirect ke halaman home.php setelah berhasil mengupdate data
        header("Location: home.php");
        exit;
      } else {
        echo "Gagal mengupdate data pengguna". mysqli_error($conn) ;
        echo "<script>alert('Kesalahan koneksi database: ". mysqli_error($conn) .  "');</script>";
      }
    }

    // Tampilkan form edit profil
    ?>
    <div class="flex items-center w-screen justify-center h-screen bg-gray-100">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-xl w-full">
    <h2 class="text-2xl font-semibold mb-4">Lengkapi Profil</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <label for="nama" class="block mb-2">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= $nama ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="deskripsi" class="block mb-2">Deskripsi Singkat Saya</label>
      <textarea id="deskripsi" name="deskripsi" class="border border-gray-300 p-2 mb-4 w-full" required><?= $deskripsi ?></textarea>

      <label for="alamat" class="block mb-2">Alamat</label>
      <input type="text" id="alamat" name="alamat" value="<?= $alamat ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="kota" class="block mb-2">Kota</label>
      <input type="text" id="kota" name="kota" value="<?= $kota ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="kontak" class="block mb-2">Kontak</label>
      <input type="text" id="kontak" name="kontak" value="<?= $kontak ?>" class="border border-gray-300 p-2 mb-4 w-full" required>

      <label for="riwayat_pendidikan" class="block mb-2">Riwayat Pendidikan</label>
      <textarea id="riwayat_pendidikan" name="riwayat_pendidikan" class="border border-gray-300 p-2 mb-4 w-full" required><?= $riwayat_pendidikan ?></textarea>

      <label for="pengalaman" class="block mb-2">Pengalaman</label>
      <textarea id="pengalaman" name="pengalaman" class="border border-gray-300 p-2 mb-4 w-full" required><?= $pengalaman ?></textarea>

      <img style="width: 100px;" src="../assets/img/konsultan/<?= $konsultan_foto ?>" alt="Foto Profil">
      <label for="konsultan_foto" class="block mb-2">Foto Profil</label>
      <input type="file" id="gambar" name="gambar" class="mb-4" accept="image/*">

      <label for="spesialisasi" class="block mb-2">Spesialisasi</label>
      <select id="spesialisasi" name="spesialisasi" class="border border-gray-300 p-2 mb-4 w-full" required>
        <?php
          // Query untuk mendapatkan data spesialisasi dari tabel spesialisasi
          $query = "SELECT * FROM spesialisasi";
          $result = mysqli_query($conn, $query);

          // Periksa apakah query berhasil dieksekusi
          if ($result) {
            // Tampilkan pilihan spesialisasi
            while ($row = mysqli_fetch_assoc($result)) {
              $id_spesialisasi = $row['ID_Spesialisasi'];
              $nama_spesialisasi = $row['Nama_Spesialisasi'];

              // Tandai spesialisasi yang dipilih
              $selected = ($id_spesialisasi == $spesialisasi) ? 'selected' : '';

              echo "<option value=\"$id_spesialisasi\" $selected>$nama_spesialisasi</option>";
            }
          }
        ?>
      </select>

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
