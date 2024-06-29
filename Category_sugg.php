<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $userid = $_SESSION['username'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Create Tweet</title>
        <script src="js/ajax.js"></script>
        <script src="js/font.js"></script>
        <script src="js/flowbite.js"></script>
        <script src="tailwind.js"></script>
        <link rel="stylesheet" href="Profile/daist.css">
    </head>

    <body>
        <?php
        $key = "hhdsfs1263z";
        // include "inc/side-nav.php";
        include_once("Profile/req/Category.php");
        include_once("Profile/User.php");
        include_once("db_conn.php");
        $users = get($conn, $userid);
        $usern = getAlll($conn);
        $su = ge($conn);
        $categories3 = get3Categoies($conn);

        ?>


        <!-- component -->
        <div class="container mx-auto">
            <div class="" style="background-color: #15202b;">
                <div class="flex justify-center">

                    <header class="text-white h-12 py-4">
                        <!-- Navbar (left side) -->
                        <div style="width: 275px;">
                            <div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
                                <!--Logo-->
                                <a href="../blog.php">
                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-8 w-8 text-[white] ml-4" fill="currentColor">
                                        <g>
                                            <path d=" M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                                        </g>
                                    </svg>
                                </a>


                                <!-- Nav-->
                                <nav class="mt-5 px-2">
                                    <a href="blog.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6 " stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"></path>
                                        </svg>
                                        Home
                                    </a>

                                    <a href="Profile/message.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Messages
                                    </a>
                                    <a href="Profile/profile.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profile
                                    </a>
                                    <a href="Category_sugg.php" class="group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full bg-gray-800 text-blue-300 ">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Category Suggetions
                                    </a>
                                    <a href="logout.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="#ffffff" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                                        </svg>
                                        LogOut
                                    </a>


                                    <a href="Profile/tweet-add.php" class="btn bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full">Tweet</a>
                                </nav>
                            </div>
                        </div>
                    </header>

                    <div class="flex h-screen" style="width: 99">
                        <section class=" border border-y-0 border-gray-800" style="max-width:600">
                            <!--Content (Center)-->
                            <!-- Nav back-->
                            <div>
                                <div class="flex justify-start items-center">
                                    <div class="px-4 py-2 mx-2">
                                        <a href="Category.php" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                            <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </a>

                                    </div>
                                    <h3 class="w-[523px] text-center text-3xl text-white">Create New Suggetions Category</h3>

                                </div>

                                <hr class="border-gray-800">
                            </div>
                            <div class="p-4 w-[700px]">
                                <!-- Profile info -->
                                <div class="flex flex-col items-center ">
                                    <div class="mt-3">
                                        <div class="px-5 flex flex-col items-center ">
                                            <?php if (isset($_GET['error'])) { ?>
                                                <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-red-800 dark:text-green-200">
                                                        <svg class="w-5 h-5 text-green-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                        </svg>
                                                        <span class="sr-only">Check icon</span>
                                                    </div>
                                                    <div class="ms-3 text-sm font-normal">
                                                        <?= htmlspecialchars($_GET['error']) ?>
                                                    </div>
                                                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                                        <span class="sr-only">Close</span>
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                    </button>
                                                </div>

                                            <?php } ?>
                                            <?php if (isset($_GET['success'])) { ?>
                                                <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                        </svg>
                                                        <span class="sr-only">Check icon</span>
                                                    </div>
                                                    <div class="capitalize ms-3 text-sm font-normal"><?= htmlspecialchars($_GET['success']) ?></div>
                                                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                                        <span class="sr-only">Close</span>
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                            <?php if ($su != 0) { ?>
                                                <?php foreach ($su as $sugs) { ?>
                                                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                                                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                            </svg>
                                                            <span class="sr-only">Check icon</span>
                                                        </div>
                                                        <div class="ms-3 text-sm font-normal">
                                                            You Sugget :  <?= $sugs['Cat'] ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                        <div class=" p-5 w-[700px]">
                                            <form action="Profile/req/fo.php" method="post" enctype="multipart/form-data">
                                                <input type="text" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full py-3 px-3 placeholder:text-[12px] mb-3" name="sug" placeholder="Write Suggestion Category">
                                                <div class="mb-3">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo">Upload Photo</label>
                                                    <input type="file" id="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="cover">
                                                    <p class="mt-1 ml-2 text-[12px] text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG Or JPG.</p>

                                                </div>
                                                <button type="submit" class=" btn w-[200px] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Suggestion</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <hr class="border-gray-800"> -->
                        </section>


                    </div>
                    <aside class="w-[400px] h-12 position-relative max-[500px]:hidden">
                        <!--Aside menu (right side)-->
                        <div style="max-width:350px;">
                            <div class="overflow-y-auto fixed  h-screen">

                                <?php
                                if (isset($_GET['search'])) {
                                    $key = $_GET['search'];
                                    $posts = serach($conn, $key);
                                    if ($posts == 0) {
                                        $notFound = 1;
                                    }
                                }
                                ?>


                                <div class="relative text-gray-300 w-full p-5">
                                    <form class="d-flex" role="search" method="GET" action="blog.php">
                                        <button type="submit" class="absolute ml-4 mt-3 mr-4">
                                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                                            </svg>
                                        </button>

                                        <input type="search" name="search" aria-label="Search" placeholder="Search Twitter" class=" bg-dim-700 h-10 px-10 pr-5 w-full text-sm focus:outline-none bg-purple-white shadow rounded border-0">
                                    </form>
                                </div>
                                <!--trending tweet section-->

                                <!--trending tweet section-->
                                <div class="max-w-sm rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Category</h2>
                                        </div>

                                    </div>


                                    <hr class="border-gray-800">

                                    <!--first trending tweet-->
                                    <?php if ($categories3 != 0) { ?>
                                        <?php foreach ($categories3 as $category) { ?>
                                            <div class=" border-b text-center py-3 border-gray-800">
                                                <a href="category.php?category_id=<?= $category['id'] ?>" class=" text-xl whitespace-nowrap text-white"><?= $category['category'] ?></a>
                                            </div>
                                        <?php } ?>

                                        </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="alert alert-warning">
                                            Empty!
                                        </div>
                                    <?php } ?>
                                    <hr class="border-gray-800">

                                    <!--show more-->

                                    <div class="flex">
                                        <div class="flex-1 p-4">
                                            <a href="Category.php" class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</a>
                                        </div>
                                    </div>

                                </div>
                                <!--people suggetion to visit profile section-->
                                <div class="max-w-sm rounded-lg  bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Who to follow</h2>
                                        </div>
                                    </div>


                                    <hr class="border-gray-800">

                                    <!--loop for persons who to visit Profile-->
                                    <div class="flex flex-col flex-shrink-0">
                                        <?php if ($usern != 0) { ?>
                                            <?php foreach ($usern as $user) { ?>
                                                <div class="flex-1">
                                                    <div class="flex items-center pl-3">
                                                        <img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $user['avatar'] ?>" alt="">
                                                        <div class="ml-3 mt-3">
                                                            <p class="text-base leading-6 font-medium text-white capitalize"><?= $user['fname'] ?></p>
                                                            <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"><?= $user['username'] ?></>
                                                        </div>
                                                        <div class="flex-1 px-4 py-2 m-2">
                                                            <a href="Profile/profile-view.php?username=<?= $user['username'] ?>" class=" float-right">
                                                                <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                                    Visit Profile
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        <?php }  ?>

                                    </div>
                                    <hr class="border-gray-800">

                                </div>




                                <div class="flow-root m-6">
                                    <div class="flex-1">

                                        <p class="text-sm leading-6 font-medium text-gray-500">Terms Privacy Policy Cookies Imprint Ads info
                                        </p>

                                    </div>
                                    <div class="flex-2">
                                        <p class="text-sm leading-6 font-medium text-gray-600"> © 2024 SIFY.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>

            </div>

        </div>





        <style>
            .overflow-y-auto::-webkit-scrollbar,
            .overflow-y-scroll::-webkit-scrollbar,
            .overflow-x-auto::-webkit-scrollbar,
            .overflow-x::-webkit-scrollbar,
            .overflow-x-scroll::-webkit-scrollbar,
            .overflow-y::-webkit-scrollbar,
            body::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            .overflow-y-auto,
            .overflow-y-scroll,
            .overflow-x-auto,
            .overflow-x,
            .overflow-x-scroll,
            .overflow-y,
            body {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }

            .bg-dim-700 {
                --bg-opacity: 1;
                background-color: #192734;
            }

            html,
            body {
                margin: 0;
                background-color: #15202b;
            }

            svg.paint-icon {
                fill: currentcolor;
            }
        </style>

    </body>



    </html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>