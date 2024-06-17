<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rizkiku";

    // $servername = "localhost";
    // $username = "u1563648_u156364";
    // $password = "aca1andri2iki3";
    // $dbname = "u1563648_rizkiku";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    
    // Fungsi Registrasi
    function registrasi($data) {
        global $conn;

        $nama = strtolower(stripslashes($data["nama"]));
        $email = strtolower(stripslashes($data["email"]));
        $password = $conn->real_escape_string($data["password"]);
        $password2 = $conn->real_escape_string($data["password2"]);

        $result = mysqli_query($conn, "SELECT email FROM umkm WHERE email ='$email'");

        if(mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('Email telah terdaftar sebelumnya, gunaka email lain');
            </script>
            ";
            return false;
        }

        // cek konfirmasi
        if ($password !== $password2) {
            echo "
                <script>
                    alert('Konfirmasi password tidak sesuai');
                </script>
            ";
            return false;
        }

        // Menambahkan data baru ke database
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO umkm (nama, email, pw_umkm) VALUES ('$nama','$email', '$password')";

        if ($conn->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
            return false;
        }
    }

    function registrasiKonsultan($data) {
        global $conn;

        $nama = strtolower(stripslashes($data["nama"]));
        $email = strtolower(stripslashes($data["email"]));
        $password = $conn->real_escape_string($data["password"]);
        $password2 = $conn->real_escape_string($data["password2"]);

        $result = mysqli_query($conn, "SELECT email FROM konsultan WHERE email ='$email'");

        if(mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('Email telah terdaftar sebelumnya, gunaka email lain');
            </script>
            ";
            return false;
        }

        // cek konfirmasi
        if ($password !== $password2) {
            echo "
                <script>
                    alert('Konfirmasi password tidak sesuai');
                </script>
            ";
            return false;
        }

        // Menambahkan data baru ke database
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO konsultan (nama, email, pw_konsultan) VALUES ('$nama','$email', '$password')";

        if ($conn->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
            return false;
        }
    }


    function uploadVideo() {
        $namaFile = $_FILES['video']['name'];
        $ukuranFile =$_FILES['video']['size'];
        $error = $_FILES['video']['error']; 
        $tmp_name = $_FILES['video']['tmp_name']; 

        //CEK APAKAH TDK ADA GAMBAR

        if($error == 4) {
            echo "<script>
                    alert('pilih gambar);
                    <script>";

            return false;
        }

        $ekstensiVideoValid = ['mp4', 'mkv', 'webm'];
        $ekstensiVideo = explode('.', $namaFile);
        $ekstensiVideo = strtolower(end($ekstensiVideoValid));

        if (!in_array($ekstensiVideo, $ekstensiVideoValid)) {
            echo "<script>
            alert('bukan gambar);
            <script>";

            return false;
        }

 

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiVideo;
        //move
        move_uploaded_file($tmp_name, '../assets/videos/'. $namaFileBaru);

        return $namaFileBaru ;
    }

    function updateVideo($judulVideo, $deskripsiVideo, $lokasiVideo) {
        global $conn;
        $tanggalUploadVideo = date("Y-m-d");
        // Menghindari SQL Injection dengan menggunakan prepared statement
        $stmt = $conn->prepare("INSERT INTO videos (judul_video, deskripsi_video, lokasi_video) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $judulVideo, $deskripsiVideo, $lokasiVideo);
    
        if ($stmt->execute()) {
            return true; // Sukses menyimpan data video
        } else {
            return false; // Gagal menyimpan data video
        }
    }
    

    function upload() {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile =$_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error']; 
        $tmp_name = $_FILES['gambar']['tmp_name']; 

        //CEK APAKAH TDK ADA GAMBAR

        if($error == 4) {
            echo "<script>
                    alert('pilih gambar);
                    <script>";

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
            alert('bukan gambar);
            <script>";

            return false;
        }

        //jika profil poto kebesaram
        if ($ukuranFile > 1000000) {
            echo "<script>
            alert('ukuran gambar terlalu besar');
            <script>";
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        //move
        move_uploaded_file($tmp_name, '../assets/img/profil/'. $namaFileBaru);

        return $namaFileBaru ;
    }

    function uploadKonsultan() {
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile =$_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error']; 
        $tmp_name = $_FILES['gambar']['tmp_name']; 

        //CEK APAKAH TDK ADA GAMBAR

        if($error == 4) {
            echo "<script>
                    alert('pilih gambar);
                    <script>";

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script>
            alert('bukan gambar);
            <script>";

            return false;
        }

        //jika profil poto kebesaram
        if ($ukuranFile > 1000000) {
            echo "<script>
            alert('ukuran gambar terlalu besar');
            <script>";
        }

        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        //move
        move_uploaded_file($tmp_name, '../assets/img/profil/'. $namaFileBaru);

        return $namaFileBaru ;
    }

    // Fungsi untuk mengubah biaya konsultasi
    function updateBiayaKonsultasi($email, $biaya) {
        global $conn;
        $updateResult = mysqli_query($conn, "UPDATE konsultan SET Biaya_Konsultasi = '$biaya' WHERE Email = '$email'");
        if ($updateResult) {
            // Refresh halaman setelah berhasil mengupdate biaya konsultasi
            // header("Location: ../public/konsultan/home.php");
            exit;
        } else {
            echo "Gagal mengupdate biaya konsultasi";
        }
    }

    // Fungsi untuk mengubah spesialisasi
    function updateSpesialisasi($email, $spesialisasi) {
        global $conn;
        $updateResult = mysqli_query($conn, "UPDATE konsultan SET Spesialisasi = '$spesialisasi' WHERE Email = '$email'");
        if ($updateResult) {
            // Refresh halaman setelah berhasil mengupdate spesialisasi
            header("Location: ../public/konsultan/home.php");
            exit;
        } else {
            echo "Gagal mengupdate spesialisasi";
        }
    }

    function mengajukan($id_umkm, $id_konsultan, $detail_ajuan, $tanggal_konsultasi, $jam_konsultasi, $topik_konsultasi, $durasi_konsultasi, $tempat_konsultasi) {
        global $conn;
        // Tanggal ajuan saat ini
        $tanggal_ajuan = date("Y-m-d");
    
        // Status awal "menunggu"
        $status = "menunggu";
    
        // Escape variabel $detail_ajuan sebelum dimasukkan ke dalam query
        $detail_ajuan = mysqli_real_escape_string($conn, $detail_ajuan);
    
        // Query untuk menyimpan data ajuan ke dalam tabel
        $query = "INSERT INTO ajuan (id_umkm, id_konsultan, tanggal_ajuan, status_ajuan, detail_ajuan, tanggal_konsultasi, jam_konsultasi, topik_konsultasi, durasi_konsultasi, tempat_konsultasi) 
                  VALUES ('$id_umkm', '$id_konsultan', '$tanggal_ajuan', '$status', '$detail_ajuan', '$tanggal_konsultasi', '$jam_konsultasi', '$topik_konsultasi', '$durasi_konsultasi', '$tempat_konsultasi')";
    
        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            // Tampilkan pesan sukses menggunakan JavaScript alert
            echo '<script>alert("Permohonan telah dikirim.");</script>';
    
            // Redirect kembali ke halaman sebelumnya
            echo '<script>window.location = document.referrer;</script>';
    
            // Exit dari skrip PHP
            exit;
        } else {
            // Tampilkan pesan kesalahan query
            echo '<script>alert("Permohonan gagal dikirim, mohon coba lagi. Error: ' . mysqli_error($conn) . '");</script>';
    
            // Redirect kembali ke halaman detail.php dengan parameter id_konsultan
            echo "<script>window.location = '../public/umkm/detail.php?id_konsultan=$id_konsultan'</script>";
        }
    }
    
    
    
      // Fungsi untuk menerima ajuan
// Fungsi untuk menerima ajuan
// Fungsi untuk menerima ajuan
function menerimaajuan($ajuanId) {
    global $conn;

    // Perbarui status ajuan menjadi "disetujui"
    $query = "UPDATE ajuan SET status_ajuan = 'diterima' WHERE id_ajuan = '$ajuanId'";

    var_dump($query);

    mysqli_query($conn, $query);

    echo mysqli_error($conn);

    // Tampilkan pesan berhasil menggunakan JavaScript alert
    echo "<script>alert('Berhasil menerima ajuan');</script>";
}



// Fungsi untuk menolak ajuan
function menolakajuan($ajuanId, $alasan) {
    global $conn;

    // Perbarui status ajuan menjadi "ditolak" dan tambahkan alasan penolakan
    $query = "UPDATE ajuan SET status_ajuan = 'Ditolak', alasan_penolakan = '$alasan' WHERE id_ajuan = $ajuanId";
    mysqli_query($conn, $query);

    // Tampilkan pesan berhasil menggunakan JavaScript alert
    echo "<script>alert('Berhasil menolak ajuan');</script>";
}

function updatePembayaran($metodePembayaran, $jumlahPembayaran, $tanggalPembayaran, $buktiPembayaran, $idAjuan) {
    // Lakukan operasi pembaruan pembayaran di sini
    // Misalnya, lakukan penyimpanan ke database atau pembaruan data pada entitas pembayaran
    global $conn;

    $statusPembayaran = "Menunggu"; // Default status pembayaran
    // Melakukan penyimpanan data pembayaran ke database
    $sql = "INSERT INTO pembayaran (id_pembayaran, metode_pembayaran, jumlah_pembayaran, tanggal_pembayaran, status_pembayaran, bukti_pembayaran, id_ajuan)
            VALUES ('', '$metodePembayaran', '$jumlahPembayaran', '$tanggalPembayaran', '$statusPembayaran', '$buktiPembayaran', '$idAjuan')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Pembayaran berhasil diperbarui.");</script>';
        echo '<script>window.location.href = "agenda.php";</script>';
        exit;
    } else {
        echo '<script>alert("Error: ' . $sql . '\n' . mysqli_error($conn) . '");</script>';
    }
}


function uploadBuktiPembayaran() {
    $namaFile = $_FILES['buktibayar']['name'];
    $ukuranFile =$_FILES['buktibayar']['size'];
    $error = $_FILES['buktibayar']['error']; 
    $tmp_name = $_FILES['buktibayar']['tmp_name']; 

    //CEK APAKAH TDK ADA GAMBAR

    if($error == 4) {
        echo "<script>
                alert('pilih gambar);
                <script>";

        return false;
    }

    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('bukan gambar);
        <script>";

        return false;
    }

    //jika profil poto kebesaram
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
        <script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    //move
    move_uploaded_file($tmp_name, '../assets/img/buktipembayaran/'. $namaFileBaru);

    return $namaFileBaru ;
}

function tolak($id_pembayaran) {
    global $conn;
    // Query SQL untuk mengubah status_pembayaran menjadi "tolak"
    $query = "UPDATE pembayaran SET status_pembayaran = 'Pembayaran Ditolak' WHERE id_pembayaran = $id_pembayaran";
  
    // Eksekusi query
    // Gantikan "koneksi_database" dengan koneksi database yang sesuai
    $result = mysqli_query($conn, $query);
  
    // Periksa apakah query berhasil dijalankan
    if ($result) {
      echo "Status pembayaran berhasil diubah menjadi tolak";
    } else {
      echo "Terjadi kesalahan dalam mengubah status pembayaran";
    }
  }

function createKonsultasiFromPembayaran($id_pembayaran) {
    global $conn;
  // Periksa status pembayaran berdasarkan id_pembayaran
  $query = "SELECT status_pembayaran FROM pembayaran WHERE id_pembayaran = '$id_pembayaran'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $data = mysqli_fetch_assoc($result);
    $status_pembayaran = $data['status_pembayaran'];

    // Jika status pembayaran adalah "disetujui", insert ke tabel Konsultasi
    if ($status_pembayaran == "disetujui") {
      // Dapatkan data dari tabel Ajuan berdasarkan id_ajuan
      $query_ajuan = "SELECT id_umkm, id_konsultan, tanggal_ajuan, status_ajuan, detail_ajuan, tanggal_konsultasi, jam_konsultasi, topik_konsultasi, durasi_konsultasi, alasan_penolakan, tempat_konsultasi FROM ajuan WHERE id_ajuan = (SELECT id_ajuan FROM pembayaran WHERE id_pembayaran = '$id_pembayaran')";
      $result_ajuan = mysqli_query($conn, $query_ajuan);

      if ($result_ajuan) {
        $data_ajuan = mysqli_fetch_assoc($result_ajuan);

        // Insert data ke tabel Konsultasi
        $id_umkm = $data_ajuan['id_umkm'];
        $id_konsultan = $data_ajuan['id_konsultan'];
        $tanggal_konsultasi = $data_ajuan['tanggal_konsultasi'];
        $jam_konsultasi = $data_ajuan['jam_konsultasi'];
        $topik_konsultasi = $data_ajuan['topik_konsultasi'];
        $durasi_konsultasi = $data_ajuan['durasi_konsultasi'];
        $tempat_konsultasi = $data_ajuan['tempat_konsultasi'];
        $status_konsultasi = "akan berlangsung";

        $query_insert = "INSERT INTO konsultasi 
        (id_konsultan, id_umkm, tanggal_konsultasi, jam_konsultasi, topik_konsultasi, status_konsultasi, durasi_konsultasi, tempat_konsultasi) VALUES 
        ('$id_konsultan', '$id_umkm', '$tanggal_konsultasi', '$jam_konsultasi', '$topik_konsultasi', '$status_konsultasi', '$durasi_konsultasi', '$tempat_konsultasi')";
        $result_insert = mysqli_query($conn, $query_insert);

        if ($result_insert) {
          echo "Data berhasil dimasukkan ke tabel Konsultasi";
        } else {
          echo "Terjadi kesalahan saat memasukkan data ke tabel Konsultasi";
        }
      } else {
        echo "Terjadi kesalahan saat mengambil data dari tabel Ajuan";
      }
    } else {
      echo "Status pembayaran tidak disetujui";
    }
  } else {
    echo "Terjadi kesalahan saat mengambil status pembayaran";
  }
}





  function setuju($id_pembayaran) {
  global $conn;
  
  // Query SQL untuk mengubah status_pembayaran menjadi "disetujui"
  $query = "UPDATE pembayaran SET status_pembayaran = 'disetujui' WHERE id_pembayaran = $id_pembayaran";
  
  // Eksekusi query
  $result = mysqli_query($conn, $query);

 
  
  // Periksa apakah query berhasil dijalankan
  if ($result) {
    echo "Status pembayaran berhasil diubah menjadi disetujui";
    createKonsultasiFromPembayaran($id_pembayaran);
  } else {
    echo "Terjadi kesalahan dalam mengubah status pembayaran";
  }
}

// Fungsi untuk mendapatkan daftar konsultasi berdasarkan id_umkm
function getDaftarKonsultasi($idUmkm)
{
    global $conn;

    // Menghindari serangan SQL Injection dengan menggunakan prepared statement
    $query = "SELECT * FROM konsultasi WHERE id_umkm = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "i", $idUmkm);
    
    // Eksekusi prepared statement
    mysqli_stmt_execute($statement);
    
    // Mengambil hasil query
    $result = mysqli_stmt_get_result($statement);

    // Mengecek apakah query berhasil dieksekusi
    if ($result) {
        // Mengambil data konsultasi dalam bentuk array
        $daftarKonsultasi = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Mendapatkan data konsultan untuk setiap konsultasi
        foreach ($daftarKonsultasi as &$konsultasi) {
            $idKonsultan = $konsultasi['id_konsultan'];
            $konsultan = getKonsultanById($idKonsultan);
            $konsultasi['konsultan'] = $konsultan;
        }

        // Mengembalikan data konsultasi
        return $daftarKonsultasi;
    } else {
        // Jika terjadi kesalahan saat eksekusi query, kembalikan array kosong
        return [];
    }
}

function getKonsultanById($idKonsultan)
{
    global $conn;

    // Menghindari serangan SQL Injection dengan menggunakan prepared statement
    $query = "SELECT konsultan_poto, Nama FROM konsultan WHERE ID_konsultan = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, "i", $idKonsultan);

    // Eksekusi prepared statement
    mysqli_stmt_execute($statement);

    // Mengambil hasil query
    $result = mysqli_stmt_get_result($statement);

    // Mengecek apakah query berhasil dieksekusi
    if ($result) {
        // Mengambil data konsultan dalam bentuk array asosiatif
        $konsultan = mysqli_fetch_assoc($result);

        // Mengembalikan data konsultan
        return $konsultan;
    } else {
        // Jika terjadi kesalahan saat eksekusi query, kembalikan null
        return null;
    }
}


function getDataKonsultasi($id_konsultasi) {
    // Kode untuk mengambil data konsultasi dari database berdasarkan id_konsul
    global $conn;

    
    // Membuat query SQL untuk mengambil data konsultasi
    $sql = "SELECT * FROM konsultasi WHERE id_konsultasi = '$id_konsultasi'";
    
    // Menjalankan query dan mendapatkan hasilnya
    $result = $conn->query($sql);
    
    // Memeriksa apakah query menghasilkan baris data
    if ($result->num_rows > 0) {
        // Mendapatkan baris data sebagai array asosiatif
        $konsultasi = $result->fetch_assoc();
        
        // Mengembalikan data konsultasi
        return $konsultasi;
    } else {
        // Jika tidak ada baris data yang ditemukan, mengembalikan null
        return null;
    }
    
}


// functions.php

// Fungsi untuk mengupdate kolom komentar dan rating pada tabel konsultasi
function komentarDanRating($id_konsultasi, $komentar, $rating)
{   global $conn;
    // Lakukan koneksi ke database

    // Lakukan proses update kolom komentar dan rating pada tabel konsultasi
    // Menggunakan parameter binding/prepared statements
    $query = "UPDATE konsultasi SET komentar = ?, rating = ? WHERE id_konsultasi = ?";
    
    // Persiapan statement
    $stmt = $conn->prepare($query);
    
    // Binding parameter
    $stmt->bind_param("ssi", $komentar, $rating, $id_konsultasi);
    
    // Eksekusi statement
    $result = $stmt->execute();
    
    // Cek apakah update berhasil dilakukan
    if ($result) {
        // Update berhasil
        return true;
    } else {
        // Update gagal
        return false;
    }
}

// functions.php

// Fungsi untuk mengubah status konsultasi menjadi "Telah Berlangsung"
function selesaiKonsultasi($id_konsultasi)
{
    // Lakukan koneksi ke database
    global $conn;
    // Buat prepared statement
    $stmt = $conn->prepare("UPDATE konsultasi SET status_konsultasi = 'Telah Berlangsung' WHERE id_konsultasi = ?");
    
    // Bind parameter
    $stmt->bind_param("i", $id_konsultasi);
    
    // Eksekusi statement
    if ($stmt->execute()) {
        // Update berhasil
        $stmt->close();
        return true;
    } else {
        // Update gagal
        $stmt->close();
        return false;
    }
}


function getDataKonsultan($awalData, $jumlahDataPerhalaman) {
    // Kode untuk mengambil semua data konsultan dari database
    global $conn;

    // Membuat query SQL untuk mengambil semua data konsultan
    $sql = "SELECT * FROM konsultan LIMIT $awalData, $jumlahDataPerhalaman";

    // Menjalankan query dan mendapatkan hasilnya
    $result = $conn->query($sql);

    // Memeriksa apakah query menghasilkan baris data
    if ($result->num_rows > 0) {
        // Mendapatkan semua baris data sebagai array asosiatif
        $konsultanArray = array();
        while ($row = $result->fetch_assoc()) {
            $konsultanArray[] = $row;
        }

        // Mengembalikan array data konsultan
        return $konsultanArray;
    } else {
        // Jika tidak ada baris data yang ditemukan, mengembalikan null
        return null;
    }
}


function cari($keyword, $awalData, $jumlahDataPerhalaman) {
    global $conn;

    $query = "SELECT * FROM konsultan WHERE Nama LIKE ? OR ID_Konsultan LIKE ? OR Alamat LIKE ? OR Kontak LIKE ? OR Email LIKE ? OR Rating LIKE ? OR Biaya_Konsultasi LIKE ? OR Status LIKE ? OR kota_konsultan LIKE ?  LIMIT $awalData, $jumlahDataPerhalaman";

    // Mempersiapkan statement
    $stmt = $conn->prepare($query);

    // Mengikat parameter dengan nilai yang aman
    $searchKeyword = "%{$keyword}%";
    $stmt->bind_param('sssssssss', $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword);

    // Menjalankan statement
    $stmt->execute();

    // Mendapatkan hasil query
    $result = $stmt->get_result();

    // Mengembalikan hasil query
    return $result;
}


function getDataUMKM($id_umkm) {
    // Establish a database connection
    global $conn;

    // Prepare and execute the SELECT statement
    $sql = "SELECT * FROM umkm WHERE id_umkm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_umkm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if ($result->num_rows > 0) {
        $umkmData = $result->fetch_assoc();
 
        return $umkmData;
    } else {
 
        return null; // Return null if no data is found
    }
}

function batalajuan($ajuanId) {
    // Lakukan koneksi ke database (sesuaikan dengan kode koneksi yang Anda gunakan)
    global $conn;

    // Escape string untuk mencegah SQL Injection
    $escapedAjuanId = mysqli_real_escape_string($conn, $ajuanId);

    // Query untuk mengupdate status_konsultasi menjadi "dibatalkan"
    $query = "UPDATE ajuan SET status_ajuan = 'dibatalkan' WHERE id_ajuan = $escapedAjuanId";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Menggunakan JavaScript alert untuk menampilkan pesan
        echo "<script>alert('Ajuan berhasil dibatalkan.');</script>";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
}

function formatCurrency($amount) {
    $formattedAmount = 'Rp ' . number_format($amount, 0, ',', '.');
    return $formattedAmount;
}

// Fungsi untuk menyimpan data artikel ke dalam database
function simpanArtikel($judulArtikel, $kontenArtikel, $tanggalArtikel, $namaAdmin, $kategoriArtikel, $thumbnail)
{
    // Melakukan koneksi ke database (asumsikan sudah ada koneksi ke database sebelumnya)


    global $conn;
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Menyimpan data ke dalam tabel artikel
    $sql = "INSERT INTO artikel (judul_artikel, isi_artikel, tanggal_artikel, id_admin, kategori_artikel, thumbnail) VALUES ('$judulArtikel', '$kontenArtikel', '$tanggalArtikel', '$namaAdmin', '$kategoriArtikel', '$thumbnail')";

    if ($conn->query($sql) === TRUE) {
        echo "Artikel berhasil disimpan.";
    } else {
        echo "Terjadi kesalahan saat menyimpan artikel: " . $conn->error;
    }

    $conn->close();
}


function getArtikelById($idArtikel)
{
    // Koneksi ke database
    global $conn;

    // Query untuk mengambil data artikel berdasarkan id_artikel
    $query = "SELECT * FROM artikel WHERE id_artikel = $idArtikel";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil dieksekusi
    if ($result) {
        // Periksa apakah ada baris data yang dikembalikan
        if (mysqli_num_rows($result) > 0) {
            // Ambil data artikel sebagai array asosiatif
            $artikel = mysqli_fetch_assoc($result);
            return $artikel;
        } else {
            // Artikel tidak ditemukan
            return null;
        }
    } else {
        // Query gagal dieksekusi
        return null;
    }
}

function totalPendapatan($id_konsultan) {
    // Koneksi ke database (sesuaikan dengan konfigurasi Anda)
    global $conn;

    // Kueri SQL untuk mengambil total pendapatan konsultan
   // Kueri SQL untuk mengambil total pendapatan konsultan
$sql = "SELECT id_konsultan, SUM(jumlah_pembayaran) AS total_pendapatan
FROM pembayaran
WHERE status_pembayaran = 'Diterima' AND id_konsultan = $id_konsultan
GROUP BY id_konsultan";

// Eksekusi kueri SQL
$result = mysqli_query($conn, $sql);

// Periksa hasil kueri
if ($result) {
// Periksa apakah ada data yang ditemukan
if (mysqli_num_rows($result) > 0) {
// Ambil data hasil kueri
$row = mysqli_fetch_assoc($result);

// Ambil total pendapatan
$total_pendapatan = $row['total_pendapatan'];

// Tampilkan total pendapatan
echo "Total pendapatan konsultan dengan ID $id_konsultan: $total_pendapatan";
} else {
echo "Data pendapatan tidak ditemukan untuk konsultan dengan ID $id_konsultan";
}
} else {
echo "Gagal mengambil data pendapatan";
}
}



?>
