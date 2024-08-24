<?php
session_start();
include_once "./backend/db.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Includes/header.php'; ?>
</head>

<body class="bg-black">
    <?php include 'Includes/navbar.php'; ?>

    <section class="relative">
        <div class="relative z-10 max-w-screen-xl mx-auto px-4 py-28 md:px-8">
            <div class="space-y-5 max-w-4xl mx-auto text-center">
                <h2 class=" text-xl sm:text-xl md:text-3xl lg:text-4xl xl:text-5xl font-extrabold text-white mx-auto">
                    Welcome to
                    <span style="font-family: 'Elsie Swash Caps', serif; font-weight: 900; font-style: normal;"><span class="text-lime-400 wow animate__animated animate__zoomIn">FactQuest</span></span>
                </h2>
                <p class="max-w-2xl mx-auto text-gray-300">
                    Fact or Fiction? You Decide.
                </p>
            </div>
            <div class="py-10">
                <div class="max-w-screen-lg mx-auto px-4 md:px-8">
                    <div class="max-w-md">
                        <h1 class="text-white text-2xl font-extrabold sm:text-3xl">
                            Discover, Share, and Verify the Truth Together.
                        </h1>
                        <p class="text-white mt-2">
                            FactQuest is an interactive platform where users can share, explore, and vote on intriguing facts submitted by others.
                        </p>
                        <?php if (isset($_GET['Message'])) : ?>
                            <div id="alert-1" class="flex item-center bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 text-white p-2 rounded mt-2" role="alert">
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlspecialchars($_GET['Message']); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-white p-1.5 inline-flex items-center justify-center alert-del h-8 w-8" data-dismiss-target="#alert-1" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['Error'])) : ?>
                            <div id="alert-2" role="alert" class="flex items-center bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white p-2 rounded my-2">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlspecialchars($_GET['Error']); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-white p-1.5 inline-flex items-center justify-center alert-del h-8 w-8" data-dismiss-target="#alert-2" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    function time_elapsed_string($datetime, $full = false)
                    {
                        $now = new DateTime;
                        $ago = new DateTime($datetime);
                        $diff = $now->diff($ago);

                        $string = array(
                            'y' => 'year',
                            'm' => 'month',
                            'd' => 'day',
                            'h' => 'hour',
                            'i' => 'minute',
                            's' => 'second',
                        );

                        $result = array();
                        foreach ($string as $k => $v) {
                            if ($diff->$k) {
                                $result[] = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                            }
                        }

                        if (!$full) {
                            $result = array_slice($result, 0, 1);
                        }

                        return $result ? implode(', ', $result) . ' ago' : 'just now';
                    }

                    // Function to display facts
                    function display_facts($pdo)
                    {
                        $sql = "SELECT f.id, f.fact, f.source, f.created_at, u.full_name, u.image, u.university,
                        (SELECT COUNT(*) FROM votes WHERE fact_id = f.id) AS total_votes,
                        (SELECT COUNT(*) FROM votes WHERE fact_id = f.id AND vote_type = 'True') AS true_votes,
                        (SELECT COUNT(*) FROM votes WHERE fact_id = f.id AND vote_type = 'False') AS false_votes
                        FROM facts f
                        JOIN users u ON f.user_id = u.id
                        ORDER BY f.created_at DESC";

                        $stmt = $pdo->query($sql);

                        // Check if the query was successful
                        if (!$stmt) {
                            echo "Error: " . $pdo->errorInfo()[2];
                            return;
                        }

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            // Handle the image path, using a placeholder if no image exists
                            $imagePath = empty($row['image']) ? "./Images/placeholder.jpg" : "./Images/" . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
                            // Prepare the source URL
                            $source = htmlspecialchars($row['source'], ENT_QUOTES, 'UTF-8');
                            if (strpos($source, 'http') !== 0) {
                                $source = 'http://' . $source;
                            }
                            // Calculate the elapsed time
                            $elapsedTime = time_elapsed_string($row['created_at']);
                            echo "
                            <div class='mt-12 divide-y space-y-3 wow animate__animated animate__zoomIn'>
                                <div class='px-4 py-5 duration-150 border-2 shadow-lg shadow-lime-600 border-lime-600 rounded-xl'>
                                    <div class='flex items-center gap-x-3'>
                                        <div class='bg-white w-14 h-14 xs:h-10 xs:w-10 sm:h-14 sm:w-14 lg:h-24 lg:w-24 lg:h-24 lg:w-24 border-4 border-lime-600 rounded-full flex items-center justify-center'>
                                              <img src='{$imagePath}' class='border-2 rounded-full object-cover w-full h-full' alt='User Image'>
                                        </div>
                                        <div>
                                            <span class='block text-lg text-lime-600 font-medium'>{$row['full_name']}</span>
                                            <h3 class='text-base text-white font-semibold mt-1'>{$row['university']}</h3>
                                        </div>
                                    </div>
                                    <div class='text-sm text-white mt-10 mb-5 gap-6'>
                                        <span class='gap-2'>
                                            <span class='text-white sm:text-sm my-5'>" . htmlspecialchars($row['fact'], ENT_QUOTES, 'UTF-8') . "</span>
                                        </span>
                                        <span class='flex mt-5  items-center gap-2'>
                                            <span>Source: 
                                                  <a href='" . $source . "' class='text-lime-400 sm:text-sm my-10 hover:underline' target='_blank' rel='noopener noreferrer'>
                                                           " . $source . "
                                                  </a>
                                            </span>
                                        </span>
                                    </div>
                                    <div class='text-sm text-white flex items-center gap-6'>
                                        <span class='flex items-center gap-2'>
                                            <span>Total Votes: <span>{$row['total_votes']}</span></span>
                                        </span>
                                        <span class='flex items-center gap-2'>
                                            <span>True: <span>{$row['true_votes']}</span></span>
                                        </span>
                                        <span class='flex items-center gap-2'>
                                            <span>False: <span>{$row['false_votes']}</span></span>
                                        </span>
                                    </div>
                                    <div class='text-sm text-white mt-5 flex items-center gap-6'>
                                        <span class='flex items-center gap-2'>
                                            <span class='py-2.5 text-center mb-2'>Vote</span>
                                            <form method='POST' action='./backend/vote.php'>
                                                <input type='hidden' name='fact_id' value='{$row['id']}'>
                                                <button class='text-white bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-3 lg:px-5 xl:px-5 md:px-4 py-2.5 text-center mr-2 mb-2' type='submit' name='vote' value='True'>
                                                    True
                                                </button>
                                                <button class='text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-3 lg:px-5 xl:px-5 md:px-4 py-2.5 text-center mr-2 ' type='submit' name='vote' value='False'>
                                                    False
                                                </button>
                                            </form>
                                        </span>
                                        <span class='flex items-center text-xs gap-2 ml-auto'>
                                        <span>{$elapsedTime}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    // Call the function to display facts
                    display_facts($pdo);
                    ?>
                    <form action="./backend/post.php" method="POST" class="w-full mt-20 max-w-2xl mx-auto md:w-1/2 border border-lime-600 rounded-lg p-6 bg-black wow animate__animated animate__zoomIn">
                        <h2 class="text-2xl text-lime-600 pb-3 font-semibold">
                            Post a Fact
                        </h2>
                        <?php if (isset($_GET['message'])) : ?>
                            <div id="alert-3" class="flex item-center bg-gradient-to-r from-lime-500 via-lime-600 to-lime-700 text-white p-2 rounded mt-2" role="alert">
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlspecialchars($_GET['message']); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-white p-1.5 inline-flex items-center justify-center alert-del h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['error'])) : ?>
                            <div id="alert-4" role="alert" class="flex items-center bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white p-2 rounded my-2">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlspecialchars($_GET['error']); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 text-white p-1.5 inline-flex items-center justify-center alert-del h-8 w-8" data-dismiss-target="#alert-4" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="flex flex-col mb-3">
                                <label class="text-lime-600 mb-2" for="message">Fact</label>
                                <textarea rows="4" name="fact" id="message" placeholder="Enter the fact here" class="px-3 rounded-lg py-2 bg-gray-800 border border-gray-900 focus:border-2 focus:border-lime-500 focus:outline-none focus:bg-gray-800 text-white"></textarea>
                            </div>
                            <div class="flex flex-col mb-3">
                                <label class="text-lime-600 mb-2" for="source-input">Source</label>
                                <input type="text" name="source" id="source-input" placeholder="Source URL" class="px-3 rounded-lg py-2 bg-gray-800 border focus:border-2 border-gray-900 focus:border-lime-500 focus:outline-none focus:bg-gray-800 text-white" />
                            </div>
                        </div>
                        <div class="w-full flex justify-center pt-3">
                            <button type="submit" name="submit" class="relative flex items-center px-6 py-3 overflow-hidden font-medium transition-all bg-lime-600 rounded-md group">
                                <span class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-lime-700 rounded group-hover:-mr-4 group-hover:-mt-4">
                                    <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-lime-800 rounded group-hover:-ml-4 group-hover:-mb-4">
                                    <span class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 bg-white"></span>
                                </span>
                                <span class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-lime-700 rounded-2xl group-hover:translate-x-0"></span>
                                <span class="absolute top-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 translate-x-full bg-lime-800 rounded-2xl group-hover:translate-x-0"></span>
                                <span class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">Post Now</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <Script>
        // Script For Close alert
        var alert_del = document.querySelectorAll('.alert-del');
        alert_del.forEach((x) =>
            x.addEventListener('click', function() {
                x.parentElement.classList.add('hidden');
            })
        );
    </Script>
    <?php include 'Includes/footer.php'; ?>
</body>

</html>