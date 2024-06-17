<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Artikel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
</head>

<body class="bg-gray-100">
  <div class="h-full w-full container mx-auto py-8 h-screen">
    <div class="h-full w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden">
      <div class="bg-gray-200 text-center py-4">
        <h2 class="text-xl font-bold text-gray-800">Edit Artikel</h2>
      </div>
      <div class="p-4">
        <form action="proses_edit_artikel.php" method="POST">
          <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="nama" class="block text-sm font-medium text-gray-700">Nama Admin</label>
              <input type="number" id="nama" name="nama" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="Nama Admin">
            </div>
            
            <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Publish</label>
              <input type="date" id="tanggal" name="tanggal" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>
          <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
              <select id="kategori" name="kategori" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                <option value="kategori1">Kategori 1</option>
                <option value="kategori2">Kategori 2</option>
                <option value="kategori3">Kategori 3</option>
              </select>
            </div>
            <br>
          <div class="mb-4">
            <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="judul" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
              <input type="text" id="judul" name="judul" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="Judul Artikel">
            </div>
          </div>
          <div class="mb-4">
            <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="judul" class="block text-sm font-medium text-gray-700">Thumbnail Artikel</label>
              <input type="text" id="judul" name="thumbnail" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" value="Judul Artikel">
            </div>
          </div>
          <div class="mb-4">
            <div class="bg-white border border-gray-200 rounded-md p-4">
              <label for="konten" class="block text-sm font-medium text-gray-700">Konten Artikel</label>
              <textarea id="konten" name="konten" rows="6" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
            </div>
          </div>
          
          <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
          </div>
          
        </form>
     </div>
<script>
    ClassicEditor
        .create( document.querySelector( '#konten' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
  </div>
</body>

</html>
