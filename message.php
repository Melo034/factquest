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
            <div class="w-full max-w-sm md:w-1/2 border border-lime-600 p-10 bg-black shadow-xl shadow-lime-600 border-lime-600 ">
                <h1 class="text-4xl p-4 text-center font-bold tracking-wide">
                    <span style="font-family: 'Elsie Swash Caps', serif; font-weight: 900; font-style: normal;"><span class="text-lime-400">FactQuest</span></span>
                </h1>
                <p class="text-center p-4 font-bold text-white text-3xl">Message sent, please check your inbox.</p>
            </div>
        </div>
    </section>

    <?php include 'Includes/scripts.php'; ?>
</body>

</html>