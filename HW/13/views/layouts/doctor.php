<?php

use core\Application;
?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- <body class="bg-gradient-to-r from-purple-500 to-pink-500 "> -->

<body class="bg-fixed bg-cover bg-center" style="background-image: url(/views/layouts/doctorpic.jpg);">

  <nav class="backdrop-blur-md bg-blue-300/30 border-gray-200 px-4 sm:px-4 py-2.5 mx-4 my-4 rounded dark:bg-gray-800">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
      <a href="" class="flex items-center">
        <img src="/views/layouts/logo.jpg" class="mr-3 h-6 sm:h-9 rounded-full" alt="Flowbite Logo">
        <span class="self-center text-l font-semibold whitespace-nowrap dark:text-white">Momeni Medical Center</span>
      </a>
      <div class="flex items-center md:order-2">

        <?php if (Application::isGuest()) : ?>
          <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
            <li class="">
              <button class="font-bold transition ease-in-out delay-50  hover:-translate-y-1 hover:scale-200  duration-200">
              <a class="" href="/login">Login</a>
              </button>
            </li>
            <li class="">
              <button class="font-bold transition ease-in-out delay-50  hover:-translate-y-1 hover:scale-200  duration-200">
              <a class="" href="/register">register</a>
              </button>
            </li>
          </ul>
        <?php else : ?>
          <ul class="ml-auto">
            <li class="">
              <a class="" href="/profile">
                Profile
              </a>
            </li>
            <li class="">
              Welcome <?php echo Application::$app->user->getDisplayName();
                      echo "Guest : " . Application::isGuest(); ?>
            </li>
            <li>
              <a class="" href="/logout"> (Logout)
              </a>
            </li>
          </ul>
        <?php endif; ?>
        <img class="w-8 h-8 ml-4 rounded-full" src="/views/layouts/userpic.jpg" alt="user photo">
        </button>
      </div>



      <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
        <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
          <li>
            <a href="/" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
          </li>
          <li>
            <a href="/doctor/workingtimetabling" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Working Timetabling</a>
          </li>
          <li>
            <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
          </li>
          <li>
            <a href="" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


    {{content}}



  <!-- <div class="h-14 bg-gradient-to-r from-purple-500 to-pink-500"></div> -->
</body>

</html>