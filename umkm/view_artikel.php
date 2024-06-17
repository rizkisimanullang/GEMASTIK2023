<?php
require '../../function/functions.php';

// Periksa apakah parameter id tersedia dalam URL
if (isset($_GET['id'])) {
    // Ambil nilai id_artikel dari URL
    $idArtikel = $_GET['id'];

    // Panggil fungsi untuk mendapatkan data artikel berdasarkan id_artikel
    $artikel = getArtikelById($idArtikel);

    // Periksa apakah artikel ditemukan
    if ($artikel) {
        $judul = $artikel['judul_artikel'];
        $isi = htmlspecialchars_decode($artikel['isi_artikel']);
        $idAdmin = $artikel['id_admin'];
        $tanggal = $artikel['tanggal_artikel'];
        $thumbnail = $artikel['thumbnail'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Artikel Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
  <!-- Container for demo purpose -->
  <div class="bg-white shadow-lg rounded-lg container p-12 my-0 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32">
      <img src="<?php echo $thumbnail; ?>"
        class="mb-6 w-full h-120 rounded-lg shadow-lg dark:shadow-black/20" alt="image" />

      <div class="mb-6 flex items-center">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (23).jpg" class="mr-2 h-8 rounded-full"
          alt="avatar" loading="lazy" />
        <div>
          <span> Published <u><?php echo $tanggal; ?></u> by </span>
          <a href="#!" class="font-medium"><?php echo $idAdmin; ?></a>
        </div>
      </div>

      <h1 class="mb-6 text-3xl font-bold">
        <?php echo $judul; ?>
      </h1>

    
        <?php echo $isi; ?>


      </div>
    </section>
    <!-- Section: Design Block -->
  </div>
  <!-- Container for demo purpose -->
</body>

</html>
<?php
    } else {
        // Artikel tidak ditemukan, lakukan tindakan yang sesuai
        echo "Artikel tidak ditemukan.";
    }
} else {
    // Parameter id tidak tersedia, lakukan tindakan yang sesuai
    echo "ID artikel tidak tersedia.";
}
?>
