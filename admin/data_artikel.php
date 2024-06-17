
<?php
      session_start();

      //import database
      require '../../function/functions.php';
  ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
<link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-gray-100">
 
<div class="container px-6 mx-auto grid">

<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        			Cari Artikel
        		</h4>
        		<!-- pencarian -->

        		<form action="" method="post" class="flex max-w-md  bg-gray-100 rounded-lg overflow-hidden">
        			<input autofocus autocomplete="off" type="text" name="keyword" class="py-2 px-4 w-full text-gray-700 focus:outline-none" placeholder="Cari..." />
        			<button type="submit" name="cari" class="flex items-center justify-center px-4 bg-gray-200">
        				<svg class="h-5 w-5 text-gray-600" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
        					<circle cx="11" cy="11" r="8" />
        					<path d="M21 21l-4.35-4.35" />
        				</svg>
        			</button>
        		</form>
        		<br>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href = 'buatartikel.php'">
  Tambah Artikel
</button>

        		<!-- New Table -->
        		<div class="w-full overflow-hidden rounded-lg shadow-xs">
        			<div class="w-full overflow-x-auto">
        				<table class="w-full whitespace-no-wrap">
        					<thead>
        						<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

        							<th class="px-4 py-3">ID</th>
        							<th class="px-4 py-3">Judul Artikel</th>
        							<th class="px-4 py-3">Tanggal Publish</th>
        							<th class="px-4 py-3">Kategori</th>
        							<th class="px-4 py-3">Admin Penulis</th>
        							<th class="px-4 py-3">Aksi</th>
        						</tr>
        					</thead>
        					<tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        						<?php
              // Kode untuk mengambil data konsultan dari database
              if (isset($_POST["cari"])) {
                  $cari = $_POST["keyword"];
                  $_SESSION["keyword"] = $cari;
              } else {
                  $cari = "";
              }
              // Membuat query SQL untuk mengambil data umkm
              $sql = "SELECT * FROM artikel WHERE judul_artikel LIKE '%$cari%' OR tanggal_artikel LIKE '%$cari%' OR kategori_artikel LIKE '%$cari%'";
              $result = $conn->query($sql);
              //Konfigurasi Pagintation
              $jumlahData = 5;
              $totalData = mysqli_num_rows($result);
              $jumlahPagination = ceil($totalData / $jumlahData);

              if (isset($_GET["halaman"])) {
                  $halamanAktif = $_GET["halaman"];
              } else {
                  $halamanAktif = 1;
              }

              $dataAwal = $halamanAktif * $jumlahData - $jumlahData;

              $jumlahLink = 4;
              if ($halamanAktif > $jumlahLink) {
                  $start_number = $halamanAktif - $jumlahLink;
              } else {
                  $start_number = 1;
              }

              if ($halamanAktif < $jumlahPagination - $jumlahLink) {
                  $end_number = $halamanAktif + $jumlahLink;
              } else {
                  $end_number = $jumlahPagination;
              }
              $sqlPerHalaman = "SELECT * FROM artikel WHERE judul_artikel LIKE '%$cari%' LIMIT $dataAwal,$jumlahData";

              $ambildata_perhalaman = $conn->query($sqlPerHalaman);

              // Menjalankan query dan mendapatkan hasilnya

              // Memeriksa apakah query menghasilkan baris data
              if ($ambildata_perhalaman->num_rows > 0) {
                  // Menampilkan data umkm dalam bentuk tabel
                  while ($artikel = $ambildata_perhalaman->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td class='px-4 py-3 text-sm'>" .
                          $artikel["id_artikel"] .
                          "</td>";
                      echo "<td class='px-4 py-3 text-sm'>" .
                          $artikel["judul_artikel"] .
                          "</td>";
                      echo "<td class='px-4 py-3 text-sm'>" .
                      $artikel["tanggal_artikel"]  .
                          "</td>";
                      echo "<td class='px-4 py-3 text-sm'>" .
                      $artikel["kategori_artikel"]   .
                          "</td>";
                      echo "<td class='px-4 py-3 text-sm'>" .
                          $artikel["id_admin"] .
                          "</td>";
                      echo '<td class="px-4 py-3 text-sm">
                      <!-- Tombol Hapus -->
                      <form action="" method="post" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus item ini?\')">
                        <input type="hidden" name="id_konsultan" value="'.$artikel['id_artikel'].'">
                        <button
                          type="submit"
                          name="hapus"
                          class="flex items-center justify-center px-2 py-1 text-red-500 hover:text-red-700"
                        >
                          <svg
                            class="w-4 h-4 mr-1"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"
                            />
                          </svg>
                          Hapus
                        </button>
                      </form>

                      <!-- Tombol Lihat -->
                      <button
                        type="button"
                        class="flex items-center justify-center px-2 py-1 text-blue-500 hover:text-blue-700"
                        onclick="viewItem()"
                      >
                        <svg
                          class="w-4 h-4 mr-1"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                          />
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v2m0 8v2m-7-4h2m12 0h2M6 12h12"
                          />
                        </svg>
                        Lihat
                      </button>
                    </td>';
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='8'>Tidak ada data umkm</td></tr>";
              }
              ?></tbody>
        				</table>
        			</div>
        		</div>

        		<div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        			<span class="flex items-center col-span-3">
        				Showing 21-30 of 100
        			</span>
        			<span class="col-span-2"></span>
        			<!-- Pagination -->
        			<span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
        				<nav aria-label="Table navigation">
        					<ul class="inline-flex items-center">
        						<?php if ($halamanAktif > 1): ?>
        						<li>
        							<button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous"><a href="?halaman=<?= $halamanAktif -
                   1 ?>">
        									<svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
        										<path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
        									</svg>
        								</a>
        							</button>
        						</li>
        						<?php endif; ?>
        						<?php for ($i = $start_number; $i <= $end_number; $i++): ?>
        						<li>
        							<?php if ($i == $halamanAktif): ?>
        							<button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
        								<a href="?halaman=<?= $i ?>"><?= $i ?></a>
        							</button>
        							<?php else: ?>
        							<button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
        								<a href="?halaman=<?= $i ?>"><?= $i ?></a>
        							</button>

        							<?php endif; ?>
        						</li>
        						<li>
        							<?php endfor; ?>
        							<?php if ($halamanAktif < $jumlahPagination): ?>
        						<li>
        							<button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next"><a href="?halaman=<?= $halamanAktif +
                   1 ?>">
        									<svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
        										<path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
        									</svg>
        								</a>
        							</button>
        						</li>
        						<?php endif; ?>
        					</ul>
        				</nav>
        			</span>
        		</div>
        	</div>







                                    </div>
</body>
</html>
