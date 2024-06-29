<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $userid = $_SESSION['username'];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Create Tweet</title>
        <script src="../js/ajax.js"></script>
        <script src="../js/font.js"></script>
        <script src="../js/flowbite.js"></script>
        <script src="../tailwind.js"></script>
        <link rel="stylesheet" href="daist.css">
    </head>

    <body>
        <?php
        $key = "hhdsfs1263z";
        // include "inc/side-nav.php";
        // include_once("../admin/data/Category.php");
        include_once("User.php");
        include_once("../db_conn.php");
        $users = get($conn, $userid);

        // $categories = getAllCategories($conn);

        ?>


        <!-- component -->
        <div class="container mx-auto">
            <div class="" style="background-color: #15202b;">
                <div class="flex justify-center">

                    <div class="text-white h-12 py-4">
                        <!-- Navbar (left side) -->
                        <div style="width: 275px;">
                            <div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
                                <!--Logo-->
                                <svg viewBox="0 0 24 24" class="h-8 w-8 text-white ml-3" fill="currentColor">
                                    <g>
                                        <path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
                                        </path>
                                    </g>
                                </svg>


                                <!-- Nav-->
                                <nav class="mt-5 px-2">
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6 " stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"></path>
                                        </svg>
                                        Home
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>

                                        Explore
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                            </path>
                                        </svg>
                                        Notifications
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Messages
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                        Bookmarks
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                            </path>
                                        </svg>
                                        Lists
                                    </a>
                                    <a href="profile.php" class="group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full bg-gray-800 text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profile
                                    </a>
                                    <a href="#" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                        <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        More
                                    </a>


                                    <a href="post-add.php" class="btn bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full">Tweet</a>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="flex h-screen" style="width: 99">
                        <section class=" border border-y-0 border-gray-800" style="max-width:600">
                            <!--Content (Center)-->
                            <!-- Nav back-->
                            <div>
                                <div class="flex justify-start items-center">
                                    <div class="px-4 py-2 mx-2">
                                        <a href="profile.php" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                            <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </a>

                                    </div>
                                    <h3 class="w-[523px] text-center text-3xl text-white">Create New Tweet</h3>

                                </div>

                                <hr class="border-gray-800">
                            </div>
                            <div class="p-4 w-[700px]">
                                <!-- Profile info -->
                                <div class="flex flex-col items-center ">
                                    <form action="req/user_edit.php" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="username" value="<?= $users['username'] ?>" hidden>
                                            <!-- <input type="text" class="form-control" name="tweet_id" value="<?= $post['tweet_id'] ?>" hidden> -->
                                            <input type="text" class="form-control" name="cover_url" value="<?= $users['avatar'] ?>" hidden>
                                        </div>
                                        <div class="space-y-3">
                                            <!-- <input type="file" name="avatar" id="avatar" style="height:9rem; width:9rem;" class="md rounded-full relative border-4 border-gray-900"> -->
                                            <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="cover">
                                            <img src="../upload/Avatar/<?= $users['avatar'] ?>" style="height:9rem; width:9rem;" class="md rounded-full relative border-4 border-gray-900"">
                                            <label for=" fname" class="block mb-2 text-sm font-medium">Name</label>
                                            <input type="text" name="fname" id="fname" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5" value="<?= $users['fname'] ?>">
                                            <label for="bio" class="block mb-2 text-sm font-medium">Bio</label>
                                            <input type="text" name="bio" id="bio" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5" value="<?= $users['Bio'] ?>">
                                        </div>
                                        <div class="modal-action">
                                            <label for="my_modal_6" class="btn">Close!</label>
                                            <button type="submit" class="btn">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- <hr class="border-gray-800"> -->
                        </section>


                    </div>
                    <div class="w-[400px] h-12 ">
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


                                <div class="relative text-gray-300 w-80 p-5">
                                    <form class="d-flex" role="search" method="GET" action="profile.php">
                                        <button type="submit" class="absolute ml-4 mt-3 mr-4">
                                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                                            </svg>
                                        </button>

                                        <input type="search" name="search" aria-label="Search" placeholder="Search Twitter" class=" bg-dim-700 h-10 px-10 pr-5 w-full text-sm focus:outline-none bg-purple-white shadow rounded border-0">
                                        <!-- <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">

                                <button class="btn btn-outline-success" type="submit">
                                    Search</button> -->
                                    </form>
                                </div>
                                <!--trending tweet section-->

                                <!--trending tweet section-->
                                <div class="max-w-sm rounded-lg bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Germany trends</h2>
                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-white hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                    </path>
                                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>


                                    <hr class="border-gray-800">

                                    <!--first trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">1 . Trending</p>
                                            <!-- <h2 class="px-4 ml-2 w-48 font-bold text-white"><?= $post['post_test'] ?></h2> -->
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,466 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="border-gray-800">

                                    <!--second trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">2 . Politics . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#HI-Fashion</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">8,464 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--third trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">3 . Rock . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#Ferrari</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">5,586 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--forth trending tweet-->

                                    <div class="flex">
                                        <div class="flex-1">
                                            <p class="px-4 ml-2 mt-3 w-48 text-xs text-gray-400">4 . Auto Racing . Trending</p>
                                            <h2 class="px-4 ml-2 w-48 font-bold text-white">#vettel</h2>
                                            <p class="px-4 ml-2 mb-3 w-48 text-xs text-gray-400">9,416 Tweets</p>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" text-2xl rounded-full text-gray-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                                <svg class="m-2 h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--show more-->

                                    <div class="flex">
                                        <div class="flex-1 p-4">
                                            <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
                                        </div>
                                    </div>

                                </div>
                                <!--people suggetion to follow section-->
                                <div class="max-w-sm rounded-lg  bg-dim-700 overflow-hidden shadow-lg m-4">
                                    <div class="flex">
                                        <div class="flex-1 m-2">
                                            <h2 class="px-4 py-2 text-xl w-48 font-semibold text-white">Who to follow</h2>
                                        </div>
                                    </div>


                                    <hr class="border-gray-800">

                                    <!--first person who to follow-->

                                    <div class="flex flex-shrink-0">
                                        <div class="flex-1 ">
                                            <div class="flex items-center w-48">
                                                <div>
                                                    <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
                                                </div>
                                                <div class="ml-3 mt-3">
                                                    <p class="text-base leading-6 font-medium text-white">
                                                        Sonali Hirave
                                                    </p>
                                                    <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                        @ShonaDesign
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" float-right">
                                                <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                    Follow
                                                </button>
                                            </a>

                                        </div>
                                    </div>
                                    <hr class="border-gray-800">

                                    <!--second person who to follow-->

                                    <div class="flex flex-shrink-0">
                                        <div class="flex-1 ">
                                            <div class="flex items-center w-48">
                                                <div>
                                                    <img class="inline-block h-10 w-auto rounded-full ml-4 mt-2" src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png" alt="">
                                                </div>
                                                <div class="ml-3 mt-3">
                                                    <p class="text-base leading-6 font-medium text-white">
                                                        Sonali Hirave
                                                    </p>
                                                    <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                        @ShonaDesign
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="flex-1 px-4 py-2 m-2">
                                            <a href="" class=" float-right">
                                                <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                    Follow
                                                </button>
                                            </a>

                                        </div>
                                    </div>

                                    <hr class="border-gray-800">



                                    <!--show more-->

                                    <div class="flex">
                                        <div class="flex-1 p-4">
                                            <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2>
                                        </div>
                                    </div>

                                </div>




                                <div class="flow-root m-6">
                                    <div class="flex-1">
                                        <a href="#">
                                            <p class="text-sm leading-6 font-medium text-gray-500">Terms Privacy Policy Cookies Imprint Ads info
                                            </p>
                                        </a>
                                    </div>
                                    <div class="flex-2">
                                        <p class="text-sm leading-6 font-medium text-gray-600"> © 2020 Twitter, Inc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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