<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Includes/header.php'; ?>
</head>

<body class="bg-black">
    <section class="text-lime-500">

        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-lime-600 h-32 w-full"></div>

        <!-- wrapper -->
        <div class="w-full h-screen flex flex-col relative space-y-8 h-screen p-5 lg:px-20 flex flex-col md:flex-row items-center justify-center">

            <form action="./backend/login.php" method="POST" class="w-full max-w-sm md:w-1/2 border border-lime-600 p-10 bg-black shadow-xl shadow-lime-600 border-lime-600 ">
                <h1 class="text-4xl p-4 text-center font-bold tracking-wide">
                    <span style="font-family: 'Elsie Swash Caps', serif; font-weight: 900; font-style: normal;"><span class="text-lime-400">FactQuest</span></span>
                </h1>
                <?php if (isset($_GET['message'])) : ?>
                    <div class="bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 text-white p-2 rounded mt-2">
                        <?= htmlspecialchars($_GET['message']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['error'])) : ?>
                    <div class="bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white p-2 rounded my-2">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div class="flex flex-col mb-3">
                        <label for="name" class="text-lime-500">Email</label>
                        <input type="email" name="email" placeholder="Enter your email" class="mt-2 px-3 py-2 bg-gray-800 border rounded-lg border-gray-900 focus:border-lime-500 focus:outline-none focus:bg-gray-800 focus:text-lime-500" autocomplete="off">
                    </div>
                    <div class='flex flex-col text-gray-600 py-2' x-data="{ show: true }">
                        <div class="flex flex-col mb-3">
                            <label for="password"class="text-lime-500" >Password</label>
                            <div class="relative mt-2">
                                <!-- Password input field -->
                                <input class="w-full min-w-0 mt-2 px-3 rounded-lg py-2 bg-gray-800 border border-gray-900 focus:border-lime-500 focus:outline-none focus:bg-gray-800 focus:text-lime-500" :type="show ? 'password' : 'text'" id="password" name="password" autocomplete="current-password" placeholder="Enter your password" />
                                <!-- Toggle icons for showing/hiding password -->
                                <div class="absolute inset-y-0 right-0 justify-center pr-3 flex items-center text-sm leading-5">
                                    <!-- Eye icon when password is hidden (show=true) -->
                                    <svg x-show="show" class="h-6 text-lime-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
                                    </svg>
                                    <!-- Crossed eye icon when password is shown (show=false) -->
                                    <svg x-show="!show" class="h-6 text-lime-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 a32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-2">
                    <a href="./forget_password.php" class="text-sm font-semibold text-white hover:text-lime-700 focus:text-lime-700">Forgot Password?</a>
                </div>
                <p class="mt-4">Don't have an account?
                    <a href="./register.php" class="text-white font-semibold">
                        Sign up
                    </a>
                </p>
                <div class="justify-center pt-3 item-center flex ">
                    <button type="submit" class="text-white bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-bold rounded-lg text-lg px-5 py-2 text-center mr-2 mb-2">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </section>

    <?php include 'Includes/scripts.php'; ?>
</body>

</html>