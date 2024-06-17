<?php
    session_start();
    require '../../../function/functions.php';

    // Cek cookie
    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        // Ambil username
        $result = mysqli_query($conn, "SELECT email FROM umkm WHERE id_umkm = $id");
        $row = mysqli_fetch_assoc($result);

        // Cek cookie dan username
        if($key === hash('sha256', $row['email'])) {
            $_SESSION['login'] = true;
        }
    }

    if(isset($_SESSION["login"])) {
        header("Location: ../../umkm/home.php");
        exit;
    }

    // require '../../../connection.php';
?>

<?php 
    if(isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM umkm WHERE email = '$email'" );

        if(mysqli_num_rows($result) === 1) {
            // Cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["pw_umkm"])){

                // Set session
                $_SESSION["login"] = true;
                $_SESSION["email"] = $email; 

                // Cek remember me
                if(isset($_POST["remember"])) {
                    // Buat cookie
                    setcookie('id', $row['id_umkm'], time() + 60);
                    setcookie('key', hash('sha256', $row['email']), time() + 60);
                }
                

                header("Location: ../../umkm/home.php");
                exit;
            }
        }

        $error = true;
    }
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../../assets/img/umkm.jpg"
              alt="Office"

            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../../assets/img/login-office-dark.jpeg"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
  <div class="w-full">
  <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="../../../index.php"
                >
                  <- Kembali
                </a>
                <br>
                <br>
    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
      Login
    </h1>
    <form action="" method="post">
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Email</span>
        <input
          type="email"
          name="email"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="Jane Doe"
        />
      </label>
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Password</span>
        <input
          type="password"
          name="password"
          id="password"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          placeholder="***************"
        />
      </label>

      <label class="block mt-4 text-sm">
        <input
          type="checkbox"
          name="remember"
          class="form-checkbox"
        />
        <span class="ml-2 text-gray-700 dark:text-gray-400">Remember Me</span>
      </label>

      <button
        type="submit"
        name="login"
        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Log in
      </button>

      <hr class="my-8" />
    </form>
    <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="../../registrasi/umkm/registrasi.php"
                >
                  Don't have an account? Sign
                </a>
  </div>
</div>

          </div>
        </div>
      </div>
    </div>
  </body>
</html>
