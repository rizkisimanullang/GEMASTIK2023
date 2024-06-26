<!DOCTYPE html>
<?php
session_start();
require '../../function/functions.php';
if(isset($_POST["submit"])){
    $judul_video = $_POST["judul_video"];
    $deskripsi_video = $_POST["deskripsi_video"];
    $namaFile = $_FILES['video']['name'];
    $ukuranFile =$_FILES['video']['size'];
    $error = $_FILES['video']['error']; 
    $tmp_name = $_FILES['video']['tmp_name']; 

    var_dump($judul_video);

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

    //jika profil poto kebesaram
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar');
        <script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiVideo;
    $folder = '../assets/videos/'. $namaFileBaru;
    //move
    move_uploaded_file($tmp_name, $folder);


    updateVideo($judul_video, $deskripsi_video, $folder);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover relative items-center">
	<div class="absolute bg-black opacity-60 inset-0 z-0"></div>
	<div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
		<div class="text-center">
			<h2 class="mt-5 text-3xl font-bold text-gray-900">
				Upload Video
			</h2>
			<p class="mt-2 text-sm text-gray-400">RizkiKU.</p>
		</div>
        <form class="mt-8 space-y-3" action="#" method="POST" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 space-y-2">
                        <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
                            <input name="judul_video" class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" type="text" placeholder="Judul video">
                    </div>
                    <div class="grid grid-cols-1 space-y-2">
                        <label class="text-sm font-bold text-gray-500 tracking-wide">Descrption</label>
                            <input name="deskripsi_video" class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukan deskripsi">
                    </div>
                    <div class="grid grid-cols-1 space-y-2">
                                    <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Document</label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                                <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                    <!---<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>-->
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                    <img class="has-mask h-36 object-center" src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg" alt="freepik image">
                                    </div>
                                    <p class="pointer-none text-gray-500 "><span class="text-sm">Drag and drop</span> files here <br /> or <a href="" id="" class="text-blue-600 hover:underline">select a file</a> from your computer</p>
                                </div>
                                <input type="file" name="video" class="hidden">
                            </label>
                        </div>
                    </div>
                            <p class="text-sm text-gray-300">
                                <span>File type: doc,pdf,types of images</span>
                            </p>
                    <div>
                        <button type="submit" name="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                                    font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                        Upload
                    </button>
                    </div>
        </form>
	</div>
</div>

<style>
	.has-mask {
		position: absolute;
		clip: rect(10px, 150px, 130px, 10px);
	}
</style>
</body>

</html>
