<?php
session_start();

//import database
require '../../function/functions.php';

if (!isset($_SESSION["login"])) {
    header("Location: ../masuk/konsultan/login.php");
    exit;
}

if (isset($_POST['bayar'])) {
  $metodePembayaran = isset($_POST['metode-pembayaran']) ? $_POST['metode-pembayaran'] : '';
  $jumlahPembayaran = isset($_POST['total-bayar']) ? $_POST['total-bayar'] : '';
  $tanggalPembayaran = date('Y-m-d');
  $statusPembayaran = "Menunggu";
  $buktiPembayaran = uploadBuktiPembayaran();

  // Periksa apakah parameter id_ajuan ada dalam URL
  $id_ajuan = isset($_GET['id_ajuan']) ? $_GET['id_ajuan'] : '';

  // Panggil fungsi updatePembayaran()
  updatePembayaran($metodePembayaran, $jumlahPembayaran, $tanggalPembayaran, $buktiPembayaran, $id_ajuan);

  
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

<body>
<?php
// Periksa apakah parameter id_ajuan ada dalam URL
$id_ajuan = isset($_GET['id_ajuan']) ? $_GET['id_ajuan'] : '';

if (!empty($id_ajuan)) {
    // Gunakan nilai id_ajuan sesuai kebutuhan Anda
    // echo "ID Ajuan: " . $id_ajuan;
} else {
    // Parameter id_ajuan tidak ditemukan dalam URL
    echo "Parameter id_ajuan tidak ditemukan";
}


?>

<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto py-8">
        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-200 text-center py-4">
                <h2 class="text-xl font-bold text-gray-800">Pembayaran</h2>
            </div>
            <div class="p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="total-bayar" class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                        <input type="text" id="total-bayar" name="total-bayar" value="<?php echo $_POST['jumlahPembayaran']; ?>" readonly
  class="mt-1 bg-gray-100 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm">

                    </div>
                    <div class="mb-4">
                        <label for="metode-pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <select id="metode-pembayaran" name="metode-pembayaran"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="transfer">Transfer Bank</option>
                            <option value="kartu-kredit">Kartu Kredit</option>
                            <option value="e-wallet">E-Wallet</option>
                        </select>
                    </div>
                    <!-- Select option untuk memilih bank -->
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700">Silahkan transfer ke salah satu bank ini</p>
                        <label for="bank" class="block mt-2 text-sm font-medium text-gray-700">Pilih Bank</label>
                        <select id="bank" name="bank" class="hidden">
                            <option value="BRI">Bank BRI - 1234567890</option>
                            <option value="BNI">Bank BNI - 0987654321</option>
                            <option value="MANDIRI">Bank Mandiri - 5678901234</option>
                        </select>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="flex flex-col items-center border p-2 rounded">
                                <input type="radio" id="bri" name="bank" value="BRI" class="hidden" />
                                <label for="bri" class="cursor-pointer">
                                    <img src="https://i0.wp.com/febi.uinsaid.ac.id/wp-content/uploads/2020/11/Logo-BRI-Bank-Rakyat-Indonesia-PNG-Terbaru.png?ssl=1" alt="Logo BRI" class="h-12 w-12">
                                </label>
                                <span class="text-sm">Bank BRI</span>
                                <span class="text-xs">Nomor Rekening:<b> 1234567890</b></span>
                            </div>
                            <div class="flex flex-col items-center border p-2 rounded">
                                <input type="radio" id="bni" name="bank" value="BNI" class="hidden" />
                                <label for="bni" class="cursor-pointer">
                                    <img src="https://blogger.googleusercontent.com/img/a/AVvXsEiJiuTTGeNBEmRhATgkdM9vQJ37F8AjqKCwn8Hw1_7hF97OwAptW3f95dRVfRydLHfjmP77O_9EpeNcovCXvwKnIGVrriTlZTW-SBLcqSx791gZSnBmfv7uP2jE7RzT-LzY75ZsQ-Fd6p_6pcqNgcjPxMGyYwK1zpRXLIiqI4-ZlcsIj_aZVRq8Hpwj=s16000" alt="Logo BNI" class="h-12 w-12">
                                </label>
                                <span class="text-sm">Bank BNI</span>
                                <span class="text-xs">Nomor Rekening: <b>0987654321</b></span>
                            </div>
                            <div class="flex flex-col items-center border p-2 rounded">
                                <input type="radio" id="mandiri" name="bank" value="MANDIRI" class="hidden" />
                                <label for="mandiri" class="cursor-pointer">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Logo Mandiri" class="h-12 w-12">
                                </label>
                                <span class="text-sm">Bank Mandiri</span>
                                <span class="text-xs">Nomor Rekening:<b> 5678901234</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="bukti-pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                        <input type="file" id="gambar" name="buktibayar"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            name="bayar"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Bayar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





</body>

</html>
<?php 
if (isset($_POST['bayar'])) {
  $metodePembayaran = isset($_POST['metode-pembayaran']) ? $_POST['metode-pembayaran'] : '';
  $jumlahPembayaran = isset($_POST['total-bayar']) ? $_POST['total-bayar'] : '';
  $tanggalPembayaran = date('Y-m-d');
  $statusPembayaran = "Menunggu";
  $buktiPembayaran = uploadBuktiPembayaran();

  // Periksa apakah parameter id_ajuan ada dalam URL
  $id_ajuan = isset($_GET['id_ajuan']) ? $_GET['id_ajuan'] : '';

  // Panggil fungsi updatePembayaran()
  updatePembayaran($metodePembayaran, $jumlahPembayaran, $tanggalPembayaran, $buktiPembayaran, $id_ajuan);

  // Mengalihkan pengguna ke halaman sebelumnya
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  
}

?>