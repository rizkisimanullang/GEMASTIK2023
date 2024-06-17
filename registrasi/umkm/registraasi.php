<?php 
    require '../../../function/functions.php';
    // require '../../../connection.php';
?>

<?php 

    if(isset($_POST["register"])) {
        if (registrasi($_POST) > 0) {
            echo "<script>

            alert('úser baru berhasil');
            </script>";
            
        } else {
            echo mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p></p>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">Nama Lengkap </label>
                <input type="text" name="nama" id="nama">
            </li>
            <li>
                <label for="email">Email </label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label for="password">password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">konfirmasi password : </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">
                    Register
                </button>
            </li>
        </ul>
    </form>
</body>
</html>