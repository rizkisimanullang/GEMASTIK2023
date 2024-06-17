<?php
require '../../function/functions.php';

// Memanggil fungsi simpanArtikel dengan data dari formulir
if (isset($_POST['judul']) && isset($_POST['konten']) && isset($_POST['tanggal']) && isset($_POST['nama']) && isset($_POST['kategori'])  && isset($_POST['thumbnail']) ) {
    $judulArtikel = $_POST['judul'];
    $kontenArtikel = $_POST['konten'];
    $tanggalArtikel = $_POST['tanggal'];
    $namaAdmin = $_POST['nama'];
    $kategoriArtikel = $_POST['kategori'];
    $thumbnail = $_POST['thumbnail'];

    simpanArtikel($judulArtikel, $kontenArtikel, $tanggalArtikel, $namaAdmin, $kategoriArtikel, $thumbnail);

    // Mengalihkan pengguna ke halaman buatartikel.php
    header('Location: buatartikel.php?success=true');
    exit;
} else {
    echo '<div class="bg-red-500 text-white text-center py-4">Data artikel tidak lengkap.</div>';
}
?>

<!-- Setelah kode di atas -->
<div id="notification" class="fixed top-0 right-0 mt-5 mr-5 bg-green-500 text-white px-4 py-2 rounded-md hidden">
    Artikel berhasil ditambahkan!
</div>

<script>
    // Memunculkan notifikasi sukses setelah halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.search.includes("success=true")) {
            const notification = document.getElementById("notification");
            notification.classList.remove("hidden");
            setTimeout(function() {
                notification.classList.add("hidden");
            }, 3000);
        }
    });
</script>
