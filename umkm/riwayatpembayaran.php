<?php
      session_start();

      //import database
      include("../../connection.php");

      
      if (!isset($_SESSION["login"])) {
        header("Location: ../masuk/umkm/login.php");
        exit;
      }

      if(isset($_SESSION["login"])) {
        // Ambil username dari session
        $email = $_SESSION["email"];
    
        // Query untuk mendapatkan data pengguna
        $query = "SELECT * FROM umkm WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $id_umkm = $row['id_umkm'];
          $poto_profil_umkm = $row['foto_profil'];
          // Gunakan nilai $id_umkm sesuai kebutuhan Anda
      } else {
          // Tidak ada data yang ditemukan
      }

    }
  ?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>

  <script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat Pembayaran</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
    <!-- You need focus-trap.js to make the modal accessible -->
    <script src="../assets/js/focus-trap.js" defer></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen}"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
          RizkiKU
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
                href="carikonsultan.php"
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
                <span class="ml-4">Cari Konsultan</span>
              </a>
            </li>
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
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Agenda</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="Artikel.php"
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
                <span class="ml-4">Artikel</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="videos.php"
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
                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"
                  ></path>
                </svg>
                <span class="ml-4">Videos</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="riwayatpembayaran.php"
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
                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                  ></path>
                </svg>
                <span class="ml-4">Riwayat Pembayaran</span>
              </a>
            </li>
                      </ul>
          <!-- <div class="px-6 my-6">
            <button
              class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
              Create account
              <span class="ml-2" aria-hidden="true">+</span>
            </button>
          </div>
        </div> -->
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
            RizkiKU
          </a>
          <ul class="mt-6">
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
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
                href="carikonsultan.php"
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
                <span class="ml-4">Cari Konsultan</span>
              </a>
            </li>
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
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                  ></path>
                </svg>
                <span class="ml-4">Agenda</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="artikel.php"
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
                <span class="ml-4">Artikel</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="videos.php"
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
                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"
                  ></path>
                </svg>
                <span class="ml-4">Videos</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <span
                class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                aria-hidden="true"
              ></span>
              <a
                class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="riwayatpembayaran.php"
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
                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                  ></path>
                </svg>
                <span class="ml-4">Riwayat Pembayaran</span>
              </a>

          </ul>
          
        </div>
      </aside>
      <div class="flex flex-col flex-1">
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
            <div class="flex justify-center flex-1 lg:mr-32">
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
            </div>
            <ul class="flex items-center flex-shrink-0 space-x-6">
              <!-- Theme toggler -->
              <!-- <li class="flex">
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
              </li> -->
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
                    aria-label="submenu"
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
                          1
                        </span>
                      </a>
                    </li>
                    <!-- <li class="flex">
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
                    </li> -->
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
                    src="../assets/img/profil/<?=  $poto_profil_umkm; ?>"
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
                        href="../masuk/umkm/logout.php"
                      >
                        <svg
                          class="w-4 h-4 mr-3"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          `stroke="currentColor"
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
        <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
          <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Riwayat Pembayaran
            </h4>
            <?php
 
include("../../connection.php");
 if (!isset($_SESSION["login"])) {
   header("Location: ../masuk/umkm/login.php");
   exit;
 } 

// Buat koneksi ke database

// Jalankan query untuk mengambil data pembayaran berdasarkan ID UMKM dengan nama konsultan
$query = "SELECT pembayaran.*, konsultan.Nama AS NamaKonsultan
          FROM pembayaran
          JOIN ajuan ON pembayaran.id_ajuan = ajuan.id_ajuan
          JOIN konsultan ON ajuan.id_konsultan = konsultan.ID_Konsultan
          WHERE ajuan.id_umkm = $id_umkm";
$result = $conn->query($query);
if ($result->num_rows > 0) {
?>
<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
  <div class="w-full overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
      <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="px-4 py-3">Id Pembayaran</th>
          <th class="px-4 py-3">Konsultan</th>
          <th class="px-4 py-3">Jumlah Pembayaran</th>
          <th class="px-4 py-3">Metode Pembayaran</th>
          <th class="px-4 py-3">Tanggal Pembayaran</th>
          <th class="px-4 py-3">Status Pembayaran</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        <?php
        // Tampilkan data pembayaran beserta nama konsultan
        while ($row = $result->fetch_assoc()) {
            $idPembayaran = $row['id_pembayaran'];
            $metodePembayaran = $row['metode_pembayaran'];
            $jumlahPembayaran = $row['jumlah_pembayaran'];
            $tanggalPembayaran = $row['tanggal_pembayaran'];
            $statusPembayaran = $row['status_pembayaran'];
            $buktiPembayaran = $row['bukti_pembayaran'];
            $namaKonsultan = $row['NamaKonsultan'];
            ?>

            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3"><?php echo $idPembayaran; ?></td>
              <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                  <!-- Avatar with inset shadow -->
                  <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                    <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy" />
                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                  </div>
                  <div>
                    <p class="font-semibold"><?php echo $namaKonsultan; ?></p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3 text-sm"><?php echo $jumlahPembayaran; ?></td>
              <td class="px-4 py-3 text-sm"><?php echo $metodePembayaran; ?></td>
              <td class="px-4 py-3 text-xs"><?php echo $tanggalPembayaran; ?></td>
              <td class="px-4 py-3 text-sm"><?php echo $statusPembayaran; ?></td>
            </tr>

        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php }else { ?>

  <div class="h-screen flex items-center">
	<div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
   		<div class="max-w-md">
      		<div class="text-5xl font-dark font-bold">Yah, Gak Ada Data</div>
            <p
              class="text-2xl md:text-3xl font-light leading-normal"
            >Belum Ada Riwayat Pembayaran</p>
          <p class="mb-8">Yuk, Konsultasikan binismu dengan konsultan berpengalaman.</p>
          
          <button class="px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-blue-600 active:bg-blue-600 hover:bg-blue-700">back to homepage</button>
    </div>
      <div class="max-w-lg">
      <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2395 1800" width="400"><defs><style>.cls-1{fill:#d6b49a;}.cls-1,.cls-10,.cls-11,.cls-13,.cls-14,.cls-15,.cls-17,.cls-2,.cls-4,.cls-5,.cls-6{stroke:#000;}.cls-1,.cls-11,.cls-13,.cls-14,.cls-16,.cls-8{stroke-linecap:round;stroke-linejoin:round;}.cls-1,.cls-10,.cls-11,.cls-12,.cls-13,.cls-14,.cls-15,.cls-16,.cls-17,.cls-2,.cls-3,.cls-4,.cls-5,.cls-6,.cls-7,.cls-8,.cls-9{stroke-width:3px;}.cls-2{fill:#020202;}.cls-10,.cls-12,.cls-15,.cls-17,.cls-2,.cls-3,.cls-4,.cls-5,.cls-6,.cls-7,.cls-9{stroke-miterlimit:10;}.cls-3{fill:#818181;}.cls-12,.cls-16,.cls-3,.cls-7,.cls-8,.cls-9{stroke:#191818;}.cls-4{fill:#dcdbda;}.cls-5{fill:#4ea7f1;}.cls-14,.cls-6{fill:#f8f3ed;}.cls-16,.cls-7{fill:#333;}.cls-13,.cls-8{fill:none;}.cls-9{fill:#f8f59c;}.cls-10,.cls-11{fill:#f3d2c9;}.cls-15{fill:#8bb174;}.cls-17{fill:#da4e22;}</style></defs><title>Artboard 1 copy</title><path class="cls-1" d="M1073.3,1016.93c-43.75-72.44-119.63-96.48-144.56-103.2h0a121.1,121.1,0,0,1-6-58.67c5.65-38.81,14.87-101.89,15.77-106.5L750,821.89,558.27,886.31c3.64,3,51.12,45.51,80.31,71.69a121.07,121.07,0,0,1,33,48.89h0c-14.84,21.13-57.72,88.19-44.92,171.84,12.09,79,67.16,129,103.83,162.39a396.42,396.42,0,0,0,88,60.44,121.54,121.54,0,0,0,98.43,19.6c5.76-1.34,16.84-4.18,27.22-7.38,4.58-1.42,10.4-3.23,17.06-5.57v0l1.1-.41,1.1-.39h0c6.61-2.47,12.24-4.8,16.67-6.65,10-4.19,20.35-9.11,25.63-11.77a121.54,121.54,0,0,0,63-78.09,396.28,396.28,0,0,0,28.85-102.77C1104.37,1159.06,1114.61,1085.35,1073.3,1016.93Z"/><ellipse class="cls-2" cx="748.2" cy="816.89" rx="202.22" ry="30.98" transform="translate(-233.49 303.67) rotate(-19.91)"/><path class="cls-3" d="M959,1447l-.09,82.82c0,6.19,6.66,11.22,14.88,11.23h.3c8.22,0,14.9-5,14.9-11.2l.09-81.9c0-.53-6.95-1-15.39-1H959"/><path class="cls-3" d="M1749,1447l-.09,82.82c0,6.19,6.66,11.22,14.88,11.23h.3c8.22,0,14.9-5,14.9-11.2l.09-81.9c0-.53-7-1-15.39-1H1749"/><path class="cls-4" d="M1825.5,1426.5H755.25a10.75,10.75,0,0,0-10.75,10.75h0A10.75,10.75,0,0,0,755.25,1448H1815a10.75,10.75,0,0,0,10.74-11l-.24-10.5"/><path class="cls-5" d="M701.74,867.5S663.12,1015,669.56,1076.79c3.84,36.88,2.64,98,1,141.4a52.4,52.4,0,0,1-104.76-1.3c-.27-22-2.78-38.74-.5-51.2,13.67-74.81-7.27-76,5.08-144.26q3.17-11.08,6.56-22.29c11.82-39,24.77-75.25,38.5-110.61,14.74-1.39,31.2-5.77,48.93-9.73C678,875.76,690.47,871.22,701.74,867.5Z"/><path class="cls-5" d="M719.77,1182.37c-8.92,0-15.45-12.93-18-18-17.59-34.83,9-95.59,19.32-117.16,9.86,22.2,34.32,82.46,16.74,117.16C735.17,1169.52,728.66,1182.37,719.77,1182.37Z"/><path class="cls-6" d="M1915.78,1027c-110.75-95.83-248-74.53-267.79-71.13-190.52,30.41-344.62,100-368.21,188.29a549.59,549.59,0,0,0-11.7,55.33c-47.15-8-126.29-11.92-172.38,38.22l-.23.26c-13.09,14.32-3.91,37.46,15.39,39.47,11.56,1.2,25.45,2.36,41.11,3.12,32.51,1.58,102.09,52,145.66,85.51A156.16,156.16,0,0,0,1404.34,1419l.66,0c12.09,8.11,44,27.11,88.17,26.43a153,153,0,0,0,66.95-16.73l160.38-2.2c74.24,21.55,133.85,19.3,170.18,14.75,52.21-6.53,71.81-19.57,80.58-26.78,30.3-25,41.33-63.94,49.13-102.93C2036.41,1231.43,2010.61,1109.06,1915.78,1027Z"/><path class="cls-6" d="M1267,1198c-9.38-27.55-23.66-79.78-24.88-129.15a393.76,393.76,0,0,1,12.55-108.79,334.61,334.61,0,0,1-32.62-173.74,17.07,17.07,0,0,1,26-13l132.1,82.11a320.21,320.21,0,0,1,150.63-4.18l119.81-98a13.73,13.73,0,0,1,22.29,8.61,456.39,456.39,0,0,1-16.57,202.39,188.88,188.88,0,0,1,7.14,87.26"/><path class="cls-5" d="M583.29,1375.5H583s-8.5-.11-16.44-7.73c-6.25-6-.85-32.43,18-63.08,16.1,31.14,20.08,57.13,14.16,63.08C591.12,1375.46,583.29,1375.5,583.29,1375.5Z"/><path class="cls-7" d="M2024.5,1260.5c14.81,6.82,38.24,20.41,54,46,36.42,59.15,9.28,145.76-41.37,191.33-36.76,33.08-79.09,38.28-112.39,42.57-19.52,2.51-110,13.78-172.14-42.57-12.57-11.4-42-38.11-37.66-71.13,2.25-17,13.79-39.69,33.47-46,37.71-12.14,60.28,50.17,131.09,57.83,10.2,1.1,53.88,4.58,88-23,5.59-4.52,14.81-13,26-32C2005,1364,2024.43,1323.52,2024.5,1260.5Z"/><path class="cls-8" d="M1560.5,1428.5s69-32,85-94"/><path class="cls-7" d="M1530.83,851.27l119.81-98a13.73,13.73,0,0,1,22.29,8.61c3.24,22.58,4.13,45.46,4.35,81S1665,911,1656.5,964.5a284.8,284.8,0,0,0-125.67-113.23Z"/><path class="cls-8" d="M1408.5,1420.5c-1.77-1.54-8.83-8-9-17.67-.11-7.92,4.52-13.56,6-15.33,12.18-14.84,33.82-8.35,59-15,11.91-3.15,28.36-10.22,46-28"/><ellipse class="cls-7" cx="1452.5" cy="998.5" rx="153" ry="117"/><circle class="cls-9" cx="1355" cy="991" r="31.5"/><path class="cls-10" d="M1672.5,762.5s-70,95-77,117c-5.24,16.45,18.62,8.3,31,3.14a2.87,2.87,0,0,1,3.69,3.88l-8.3,17.53a6.35,6.35,0,0,0,7.75,8.74l9.91-3.3a2.87,2.87,0,0,1,3.56,3.83l-3.59,17.18,17,34a457.51,457.51,0,0,0,16-202Z"/><path class="cls-7" d="M1379.5,855.5c-43.86-27.19-89.35-56.1-133.21-83.29-9.07-5.62-23.66,1.62-23.79,12.29-.27,22.81-4,48.1,3,83,3.77,18.84,5.45,28.58,9.26,41.5a315.06,315.06,0,0,0,19.74,50.5,199,199,0,0,1,18-29c5.75-7.71,26.56-34.42,64-56A221.93,221.93,0,0,1,1379.5,855.5Z"/><path class="cls-11" d="M1222.5,782.5s75.38,65.94,84.71,83.21c.55,1,2.89,5.62,1.16,7.71-3.3,4-17.41-6.08-23.87-.92a6.77,6.77,0,0,0-1.62,1.92,8,8,0,0,0,.75,8.68c2.16,2.87,5,7.47,4.73,11.84a6.33,6.33,0,0,1-1.15,3.63c-1.93,2.36-5.52,2.38-6.51,2.38-6.55,0-10.09-6.31-10.25-6.6a4.65,4.65,0,0,0-6,.13,3.51,3.51,0,0,0-.94,2,8.85,8.85,0,0,0,.82,5.06c2.17,4.39-.37,18.55-1.85,24.93a93.65,93.65,0,0,1-11,27c-9-19.66-21.15-51-27-89a326.82,326.82,0,0,1-3.49-62.74C1221.37,793.9,1222,787.3,1222.5,782.5Z"/><circle class="cls-12" cx="1355" cy="991" r="22.5"/><circle class="cls-9" cx="1557" cy="991" r="31.5"/><circle class="cls-12" cx="1557" cy="991" r="22.5"/><path class="cls-10" d="M1445.26,997.13l10.24,1.37,9.39-1.34a2.14,2.14,0,0,1,2.11,3.27l-9.09,14.28a3,3,0,0,1-4.94.08l-9.77-14.33A2.15,2.15,0,0,1,1445.26,997.13Z"/><path class="cls-13" d="M1454.74,1016.08s2.76,17.42-17.24,15.42"/><path class="cls-13" d="M1455.63,1017.08s-2.76,17.42,17.24,15.42"/><path class="cls-14" d="M1664.5,1001.5,1735,980"/><path class="cls-14" d="M1667,1017l66.5,10.5"/><path class="cls-14" d="M1244,1017l-60.5,13.5"/><path class="cls-14" d="M1246.5,1000.5,1180,990"/><path class="cls-15" d="M497.79,404c44.57,20.37,95.3,66.11,155.71,124.48,92.79,89.66,150.8,234.43,169,289-5.77,2.68-30.23-42.68-36-40-19.27-52.74-57.27-138.85-139-223-66.8-68.78-125-119.67-172-142Z"/><path class="cls-15" d="M745.55,850.16c-74.68-63-179.26-139.49-214.14-152.89-89.78-34.5-169.48-49.55-221.09-50.06q8.32-8.54,16.67-17.06c49-.22,119.61,13.39,199,41,31.84,11.09,153.72,90.48,241,170.65Z"/><path class="cls-15" d="M823.54,819.3c-17.76-23.9-59.56-97.14-83.92-120.77a597.13,597.13,0,0,0-166.5-113.78l-22.31,8.44A635.18,635.18,0,0,1,733.58,724.52c17.7,18.29,54.44,85.77,68.42,104Z"/><path class="cls-7" d="M1479.5,1367.5l34,76a192.85,192.85,0,0,1-51-1s-29.19-3.39-48.59-18c-13.48-10.12-14.12-17.25-14.29-19.38-.78-9.74,5.64-16.63,8.13-19l.75-.68c9-7.86,25-8.93,26-9C1444.74,1375.81,1458.89,1373.16,1479.5,1367.5Z"/><path class="cls-16" d="M1173.28,1285.23l30.22-89.73a156.61,156.61,0,0,0-60,11,149.83,149.83,0,0,0-38,23c-1,.85-15,12.88-15.5,24.47,0,.63,0,1.22,0,1.26.23,9.77,7.33,16,10.06,18l.82.6c8.37,5.92,18.58,5.26,33.63,5.63,8.49.21,12.73.32,18,1A113.17,113.17,0,0,1,1173.28,1285.23Z"/><path class="cls-17" d="M292.3,344.49l-28.05-15.3a40.34,40.34,0,0,1-20.8-39.64l2.35-22.21a61.8,61.8,0,0,1,26.57-44.52h0a29.52,29.52,0,0,1,29.48-2.22,82.16,82.16,0,0,0,8.28,3.32,234.66,234.66,0,0,1,86.78,54.37l-43.47,78.83Z"/><path class="cls-17" d="M318.73,318l-.69.05a40.94,40.94,0,0,0-37,32l-2.68,12.12a53.57,53.57,0,0,0,33.25,61.63L394.1,455.2,406.8,365l-57-38.69A48.91,48.91,0,0,0,318.73,318Z"/><path class="cls-17" d="M465,262.82l-32.13-42.59A53.66,53.66,0,0,0,379,200l-10.53,2.21A31.57,31.57,0,0,0,348.89,251l27,38.3,84.61,30.61Z"/><circle class="cls-9" cx="395.47" cy="335.18" r="65.13"/><path class="cls-17" d="M410.35,262.8l-3.18,24.43c-1.27,9.71,1.05,18.92,6.5,25.82l43.66,55.28,25.6,66.79a188.3,188.3,0,0,0,13.53-28.27s9.66-27.18,8.55-57.61c-2-56.48-41.85-101.41-48.51-108.74a21.18,21.18,0,0,0-11-7c-8.32-2-15.23,2.41-18.82,4.69C414.7,245.8,411.24,258.85,410.35,262.8Z"/><path class="cls-17" d="M393,455.33,343.6,432.5a42.53,42.53,0,0,1-21-55.8l10.27-23.18a56,56,0,0,1,70.16-30l59.18,21.35A54.61,54.61,0,0,1,497.69,404h0a72.53,72.53,0,0,1-17.51,34.08c-22.74,24.35-55.11,23-60.87,22.72A83.93,83.93,0,0,1,393,455.33Z"/><path class="cls-17" d="M220.48,538.45l-4.1-14.15a39.86,39.86,0,0,1,20.26-46.64h0a44.74,44.74,0,0,1,46.87,4c12.59,4.22,69.55,24.82,98.81,84.49a161.75,161.75,0,0,1,16.25,66.83A8.26,8.26,0,0,1,386,640.17Z"/><path class="cls-17" d="M173.88,677.25,191,690a87.06,87.06,0,0,0,16.42,9.6,175.79,175.79,0,0,0,21.43,7.83c15.81,4.64,54.81,16.06,98.18.1,33.26-12.24,53.93-35,64.71-49.86a7,7,0,0,0-4.9-11.16L198.54,625.16a32.86,32.86,0,0,0-33,17.77A27.41,27.41,0,0,0,173.88,677.25Z"/><path class="cls-17" d="M160.14,576h0a63.93,63.93,0,0,0,32.92,42l57.42,29.55c3.85,1.51,9.48,3.61,16.37,5.82a265.52,265.52,0,0,0,45,10.4c27.27,3.24,57.36-5.36,74.44-11.41a13.29,13.29,0,0,0,8.07-17c-10.22-28.29-25.28-44.58-33.77-52.46-15.68-14.55-34.71-24.26-49.92-32a314.15,314.15,0,0,0-29.59-13.23l-48.9-13.51A63.9,63.9,0,0,0,184.09,530l-4.91,2.74A39.23,39.23,0,0,0,160.14,576Z"/><path class="cls-17" d="M525.79,497.88a10.12,10.12,0,0,0-10.16,11.81c4,23.68,14.18,75.92,28.34,89.12,18.47,17.22,48.15,116.37,130.7,95.46,56.68-14.36,39.26-73.52,22.76-109.22a117,117,0,0,0-41.89-48.75A228.19,228.19,0,0,0,597,509,260,260,0,0,0,525.79,497.88Z"/><path class="cls-15" d="M857.63,805C860.5,803.5,830.5,512.5,746.5,400.5s-104-130-104-130-2,85,34,145,78,160,90,182,56,223,56,223Z"/></svg>
    </div>
    
  </div>
</div>
<?php } ?>



           
              </div>
          </div>
        </main>
      </div>
    </div>
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
      <!-- Modal -->
      <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        @click.away="closeModal"
        @keydown.escape="closeModal"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal"
      >
        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
            aria-label="close"
            @click="closeModal"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
        <!-- Modal body -->
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p
            class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
          >
            Modal header
          </p>
          <!-- Modal description -->
          <p class="text-sm text-gray-700 dark:text-gray-400">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum et
            eligendi repudiandae voluptatem tempore!
          </p>
        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
          >
            Cancel
          </button>
          <button
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Accept
          </button>
        </footer>
      </div>
    </div>
    <!-- End of modal backdrop -->
  </body>
</html>
