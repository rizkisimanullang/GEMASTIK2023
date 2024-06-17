<?php
      session_start();

      //import database
      require '../../function/functions.php';

      
      if (!isset($_SESSION["login"])) {
        header("Location: ../masuk/konsultan/login.php");
        exit;
      }

      if(isset($_SESSION["login"])) {
        // Ambil username dari session
        $email = $_SESSION["email"];
    
        // Query untuk mendapatkan data pengguna
        $query = "SELECT * FROM konsultan WHERE Email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
  
          $poto_profil_konsultan = $row["konsultan_poto"];
          $ID = $row["ID_Konsultan"];
          // Gunakan $id_konsultan untuk query atau tampilkan data ajuan sesuai kebutuhan
          // ...
  
      } else {
          // Data konsultan tidak ditemukan
          echo "Data konsultan tidak ditemukan.";
      }

    }
  ?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
  <script src="/cdn-cgi/apps/head/lmplkzhV3pH6fdNUw6kpmpBQ68Q.js"></script><link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="true"><link rel="preload" as="style" onload="this.rel='stylesheet'" href="https://fonts.googleapis.com/css2?family=Inter&#38;display=swap">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
  <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
 
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsultan</title>
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="./assets/js/charts-lines.js" defer></script>
    <script src="./assets/js/charts-pie.js" defer></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
          Konsultan
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="home.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Beranda</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="agenda.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Agenda</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="permintaan.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Permintaan</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="riwayatkonsultasi.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                  ></path>
                  <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="ml-4">Riwayat Konsultasi</span>
              </a>
            </li>
      </aside>
      <!-- Mobile sidebar -->
      <!-- Backdrop -->
      <div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
      ></div>
      <aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.away="closeSideMenu"
        @keydown.escape="closeSideMenu"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            Beranda
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="home.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  ></path>
                </svg>
                <span class="ml-4">Beranda</span>
              </a>
            </li>
          </ul>
          <ul>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="agenda.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                  ></path>
                </svg>
                <span class="ml-4">Agenda</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="permintaan.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Permintaan</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="riwayatkonsultasi.php"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                  ></path>
                  <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>
                <span class="ml-4">Riwayat Konsultasi</span>
              </a>
            </li>
           
            </li>
            
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/login.html">Login</a>
                  </li>
                  
                </ul>
              </template>
            </li>
          </ul>
          
        </div>
      </aside>
      <div class="flex flex-col flex-1 w-full">
        <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
          <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
          >
            <!-- Mobile hamburger -->
            <button
              class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
              @click="toggleSideMenu"
              aria-label="Menu"
            >
              <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <!-- Search input -->
            <!-- <div class="flex justify-center flex-1 lg:mr-32">
              <div
                class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
              >
                <div class="absolute inset-y-0 flex items-center pl-2">
                  <svg
                    class="w-4 h-4"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <input
                  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                  type="text"
                  placeholder="Search for projects"
                  aria-label="Search"
                />
              </div>
            </div> -->
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <li class="flex">
                <button
                  class="rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleTheme"
                  aria-label="Toggle color mode"
                >
                  <template x-if="!dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                      ></path>
                    </svg>
                  </template>
                  <template x-if="dark">
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </template>
                </button>
              </li>
              <!-- Notifications menu -->
              <li class="relative">
                <button
                  class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                  @click="toggleNotificationsMenu"
                  @keydown.escape="closeNotificationsMenu"
                  aria-label="Notifications"
                  aria-haspopup="true"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                    ></path>
                  </svg>
                  <!-- Notification badge -->
                  <span
                    aria-hidden="true"
                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                  ></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Messages</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                          13
                        </span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Sales</span>
                        <span
                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                        >
                          2
                        </span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <span>Alerts</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
              <!-- Profile menu -->
              <li class="relative">
                <button
                  class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                  @click="toggleProfileMenu"
                  @keydown.escape="closeProfileMenu"
                  aria-label="Account"
                  aria-haspopup="true"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    src="../assets/img/profil/<?=  $poto_profil_konsultan; ?>"
                    alt=""
                    aria-hidden="true"
                  />
                </button>
                <template x-if="isProfileMenuOpen">
                  <ul
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click.away="closeProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu"
                  >
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <span>Profile</span>
                      </a>
                    </li>
                    <li class="flex">
                      <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="#"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li class="flex">
                    <a
                        class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                        href="../masuk/konsultan/logout.php"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <span>Log out</span>
                      </a>
                    </li>
                  </ul>
                </template>
              </li>
            </ul>
          </div>
        </header>
        <main class="h-full overflow-y-auto">
        <?php

// Cek apakah pengguna telah login
if (isset($_SESSION["login"]) && isset($_SESSION["email"])) {
    $email = $_SESSION["email"];

    // Query untuk mendapatkan data konsultan
    $result = mysqli_query($conn, "SELECT konsultan.*, spesialisasi.Nama_Spesialisasi FROM konsultan
    INNER JOIN spesialisasi ON konsultan.ID_Spesialisasi = spesialisasi.ID_Spesialisasi
    WHERE konsultan.Email = '$email'");


    // Periksa apakah data konsultan ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['Nama'];
        $deskripsi = $row['Deskripsi'];
        $alamat = $row['Alamat'];
        $kontak = $row['Kontak'];
        $email = $row['Email'];
        $riwayat_pendidikan = $row['Riwayat_Pendidikan'];
        $pengalaman = $row['Pengalaman'];
        $rating = $row['Rating'];
        $spesialisasi = $row['Nama_Spesialisasi'];
        $biaya_konsultasi = formatCurrency($row['Biaya_Konsultasi']);
        $kota= $row['kota_konsultan'];
        
        $status = $row['Status'];
        $status_akun = $row['status_akun_konsultan'];
        // $spesialisasi = $row['Spesialisasi'];
        $foto_profil = $row['konsultan_poto'];

                // Update biaya konsultasi
                if (isset($_POST['update_biaya'])) {
                  $newBiaya = $_POST['biaya_konsultasi'];
                  updateBiayaKonsultasi($email, $newBiaya);
                  header("Location: home.php");
                  exit;
              }
      
              // Update spesialisasi
              // if (isset($_POST['update_spesialisasi'])) {
              //     $newSpesialisasi = $_POST['spesialisasi'];
              //     updateSpesialisasi($email, $newSpesialisasi);
              //     header("Location: home.php");
              //     exit;
              // }
?>  
          <div class="container px-6 mx-auto grid">
          <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
            Beranda
            </h2>
              <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-2">
              
              <!-- Card -->
              <div
                class="  items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              
        <img src="../assets/img/profil/<?= $foto_profil ?>" alt="Foto Profil" class="rounded-full w-32 h-32 object-cover mb-4 mx-auto">
<div class="col-span-3 bg-white rounded-lg shadow-lg p-4 mt-4">
    <h3 class="text-xl font-bold">Status Akunmu</h3>
    <div class="flex items-center mt-4">
        <?php if ($status_akun == 'Sudah Diverifikasi'): ?>
            <span id="status_konsultasi" class="bg-green-500 text-white px-2 py-1 rounded-full"><?php echo $status_akun; ?></span>
        <?php elseif ($status_akun == 'Menunggu Verifikasi'): ?>
            <span id="status_konsultasi" class="bg-gray-500 text-white px-2 py-1 rounded-full"><?php echo $status_akun; ?></span>
        <?php elseif ($status_akun == 'Belum Diverifikasi' || $status_akun == 'Verifikasi Ditolak'): ?>
            <span id="status_konsultasi" class="bg-blue-500 text-white px-2 py-1 rounded-full"><?php echo $status_akun; ?></span>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded ml-2">Verifikasi Sekarang</button>
        <?php endif; ?>
    </div>
</div>
    <div class="col-span-3 bg-white rounded-lg shadow-lg p-4 mt-4">
        <h3 class="text-xl font-bold">Informasi Konsultasi</h3>
        <p  class="text-gray-600 mb-4">Biaya Konsultasi: <span class="  text-gray-400 rounded-lg border border-gray-300 p-1" id="biaya_konsultasi"> <?php echo $biaya_konsultasi; ?></span> /jam</p>
        <p  class="text-gray-600 mb-10">Spesialisasi: <span class="  text-gray-400 rounded-lg border border-gray-300 p-1" id="biaya_konsultasi"> <?php echo $spesialisasi; ?></span></p>
        <p class="text-gray-600">
            Status:
            <?php if ($status == 'Available'): ?>
                <span  id="status_konsultasi" class="bg-green-500 text-white px-2 py-1 rounded-full"><?php echo $status; ?></span>
            <?php else: ?>
                <span  id="status_konsultasi" class="bg-red-500 text-white px-2 py-1 rounded-full"><?php echo $status; ?></span>
            <?php endif; ?>
        </p>
    </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              <div class="col-span-2 bg-white rounded-lg p-4">
    <p style="font-size: larger;" class="text-blue-500 text-lg font-bold"><?php echo $nama; ?></p>
    <p>
      <i style="display: inline;"  class="iconify w-4 h-4 text-green-400" data-icon="mingcute:location-line"></i>
        					<span class="ml-4 font-semibold text-xs text-muted-500 dark:text-muted-400"><?= $alamat ?>, <?= $kota ?> </span>
    </p>
    <p>
      <i style="display: inline;"  class="iconify w-4 h-4 text-blue-400" data-icon="iconamoon:phone-fill"></i>
        					<span class="ml-4 font-semibold text-xs text-muted-500 dark:text-muted-400"><?= $kontak ?></span>
    </p>
 
    <p>
      <i style="display: inline;"  class="iconify w-4 h-4 text-red-400" data-icon="uiw:mail"></i>
        					<span class="ml-4 font-semibold text-xs text-muted-500 dark:text-muted-400"><?= $email ?></span>
    </p>
    
    <p>
      <i style="display: inline;"  class="iconify w-4 h-4 text-yellow-400" data-icon="uiw:star-on"></i>
        					<span class="ml-4 font-semibold text-xs text-muted-500 dark:text-muted-400"><?= $rating ?>/5</span>
    </p>
    
    <div style="margin-top: 10px;">
        <a href="edit_profil.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M2.293 10.293a1 1 0 0 1 0-1.414l5-5a1 1 0 0 1 1.414 0l8 8a1 1 0 0 1 0 1.414l-5 5a1 1 0 0 1-1.414 0l-8-8zm1.414-1.414L12 3.586 16.586 8l-8 8L4 12.414z" clip-rule="evenodd" />
            </svg>
            Edit Profil
        </a>
    </div>
</div>



              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                 <div class="bg-white rounded-lg   p-4">
        <div class="ubah_harga md:flex-col md:flex-col-reverse">
            <h3 class="text-xl font-bold">Tetapkan biaiya</h3>
            <label  for="status_input" class="block">Tetapkan biayaya konsultasi Anda per jam:</label>
            <input type="number" id="new_biaya_input" placeholder="Harga Konsultasi" class="border border-gray-300 px-2 py-1 rounded-md">
            <button id="update_button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mt-2">Update</button>
        </div>
    </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              <div class="col-span-2 bg-white rounded-lg  p-4">
        <h3 class="text-xl font-bold">Ubah Status Konsultasi</h3>
    
            <label for="status_input" class="block">Status:</label>
            <select id="new_status_input" name="new_status" class="border border-gray-300 px-2 py-1 rounded-md">
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
            <button  id="update_status_button"  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md mt-2">Update</button>
       
    </div>
              </div>

              
              
            </div>
                          <!-- Card -->
                          <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              <div class="col-span-2 bg-white rounded-lg  p-4">
              <div style="margin-bottom: 10px;" class="col-span-3 bg-white rounded-lg shadow-lg p-4 mt-4">
        <h3 class="text-xl font-bold">Deskripsi Singkat Mengenai Anda</h3>

    </div>
    <?= $deskripsi; ?>
    </div>
              </div>

              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              <div class="col-span-2 bg-white rounded-lg  p-4">
              <div style="margin-bottom: 10px;" class="col-span-3 bg-white rounded-lg shadow-lg p-4 mt-4">
        <h3 class="text-xl font-bold">Riwayat Pendidikan</h3>

    </div>
    <?= $riwayat_pendidikan; ?>
    </div>
              </div>
                  <!-- Card -->
                  <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
              <div class="col-span-2 bg-white rounded-lg  p-4">
              <div style="margin-bottom: 10px;" class="col-span-3 bg-white rounded-lg shadow-lg p-4 mt-4">
        <h3 class="text-xl font-bold">Pengalaman</h3>

    </div>
    <?= $pengalaman; ?>
    </div>
              </div>
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
            Beranda
            </h2>





 

    <script>
      $(document).ready(function() {
  // Tangkap peristiwa saat tombol "Update" diklik
  $('#update_button').click(function() {
    // Ambil nilai email, harga, dan status dari input form
    var email = '<?php echo $email; ?>';
    var newBiaya = $('#new_biaya_input').val();

    // Kirim permintaan AJAX ke server untuk memperbarui harga konsultasi
    $.ajax({
      url: '../../function/update_biaya.php', // Ganti dengan URL tujuan Anda
      method: 'POST',
      data: { email: email, biaya: newBiaya },
      success: function(response) {
        // Harga konsultasi berhasil diperbarui
      
        document.getElementById("biaya_konsultasi").innerHTML = response;
      
        $('#biaya_konsultasi').load();

        alert('Harga konsultasi berhasil diperbarui');
      },
      error: function() {
        // Terjadi kesalahan saat mengirim permintaan AJAX
        alert('Gagal mengubah harga konsultasi');
      }
    });

  });

  $('#update_status_button').click(function() {
  // Ambil nilai email, harga, dan status dari input form
  var email = '<?php echo $email; ?>';
  var newStatus = $('#new_status_input').val();

  // Kirim permintaan AJAX ke server untuk memperbarui status konsultan
  $.ajax({
    url: '../../function/update_status.php', // Ganti dengan URL tujuan Anda
    method: 'POST',
    data: { email: email, status: newStatus },
    success: function(response) {
      // Perbarui elemen dengan respons yang diterima
      $('#status_konsultasi').text(newStatus);

      // Ubah kelas CSS untuk mengatur warna latar belakang
      if (newStatus === 'Available') {
        $('#status_konsultasi').removeClass('bg-red-500').addClass('bg-green-500');
      } else {
        $('#status_konsultasi').removeClass('bg-green-500').addClass('bg-red-500');
      }

      alert('Status konsultasi berhasil diperbarui');
    },
    error: function() {
      // Terjadi kesalahan saat mengirim permintaan AJAX
      alert('Gagal mengubah status konsultan');
    }
  });
});
});

      </script>

<?php
// Ambil id_konsultan yang ingin dicari
 // Contoh: id_konsultan yang ingin dicari adalah 1

// Query untuk menghitung total konsultasi berdasarkan id_konsultan
$query = "SELECT id_konsultan, COUNT(*) AS total_konsultasi FROM konsultan WHERE id_konsultan = $ID GROUP BY id_konsultan";

// Eksekusi query
$result = mysqli_query($conn, $query);

// Inisialisasi variabel total_konsultasi
$total_konsultasi = 0;

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil hasil konsultasi dari setiap baris hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        $total_konsultasi = $row['total_konsultasi'];
    }
} else {
    // Tampilkan pesan jika query gagal dieksekusi
    echo "Error: " . mysqli_error($conn);
}
?>    
            <!-- CTA -->
            
            <!-- Cards -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                  </svg>
                </div>
                <div>
    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
        Total Konsultasi
    </p>
    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
        <?php echo $total_konsultasi; ?>
    </p>
</div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Total Penghasilan
                  </p>

                  <?php $total_pendapatan = totalPendapatan(12); ?>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                    <?= $total_pendapatan; ?>
                  </p>
                </div>
              </div>
              <!-- Card -->
              <!-- <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    New sales
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                    376
                  </p>
                </div>
              </div> -->
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    Akan Berlangsung
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                    Klik di sini
                  </p>
                </div>
              </div>
            </div>

            <!-- New Table -->
            
              

            <!-- Charts -->
            
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
<?php
    } else {
        echo "Data konsultan tidak ditemukan";
    }
} else {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit;
}
?>