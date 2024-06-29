<?php
session_start();

if (isset($_SESSION['username'])) {
    $userna = $_SESSION['username'];
    # database connection file
    include '../db_conn.php';

    include 'User.php';
    include 'Post.php';
    include 'req/user.php';
    include 'req/chat.php';
    include 'req/opened.php';

    include 'req/timeAgo.php';

    if (!isset($_GET['user'])) {
        header("Location: home.php");
        exit;
    }

    # Getting User data data
    $chatWith = get($conn, $_GET['user']);

    if (empty($chatWith)) {
        header("Location: message.php");
        exit;
    }

    $chats = getChats($_SESSION['user_id'], $chatWith['id'], $conn);

    opened($chatWith['id'], $conn, $chats);
    $username = $_SESSION['username'];
    if (isset($_GET['search'])) {
        $key = $_GET['search'];
        $posts = serach($conn, $key);
        if ($posts == 0) {
            $notFound = 1;
        }
    } else {
        $posts = getAll($conn, $username);
    }
    $categories = get3Categoies($conn);
    $userl = getAlll($conn, $username);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php
            echo "Chat With $chatWith[fname]"; ?>
        </title>
        <link rel="icon" href="img/logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/ajax.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="../js/font.js"></script>
        <script src="../js/flowbite.js"></script>
        <script src="../tailwind.js"></script>
        <link rel="stylesheet" href="full.min.css">
        <link rel="stylesheet" href="daist.css">
    </head>

    <body class="flex justify-center items-center h-auto">


        <div class="p-relative " style="background-color: #15202b;">
            <div class="flex justify-center">

                <header class="text-white h-12 py-4">
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
                                <a href="../blog.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full hover:bg-gray-800 hover:text-blue-300">
                                    <svg class="mr-4 h-6 w-6 " stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"></path>
                                    </svg>
                                    Home
                                </a>
                                <a href="message.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                    <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Messages
                                </a>
                                <a href="profile.php" class="group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full bg-gray-800 text-blue-300">
                                    <svg class="mr-4 h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <a href="../logout.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
                                    <svg class="mr-4 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ffffff" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                                    </svg>
                                    LogOut
                                </a>
                                <a href="tweet-add.php" class="btn bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full">Tweet</a>
                            </nav>
                        </div>
                    </div>
                </header>

                <main role="main">
                    <div class="flex">
                        <section class="w-[750px] border border-y-0 border-gray-800">
                            <!--Content (Center)-->
                            <!-- Nav back-->
                            <div>
                                <div class="flex justify-start items-center">
                                    <div class="px-4 py-2 mx-2">
                                        <a href="message.php" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                            <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="text-white text-md font-medium">
                                        <!-- <h1>Total Tweets: <span><?= $count ?></span></h1> -->

                                    </div>
                                </div>

                                <hr class="border-gray-800">
                            </div>
                            <div>
                                <div class="w-400 p-4 rounded">
                                    <div class="flex items-center">
                                        <img src="../upload/Avatar/<?= $chatWith['avatar'] ?>" class="w-16 h-14 rounded-full">

                                        <div class="ml-2.5">
                                            <div class="text-2xl"><?= $chatWith['fname'] ?></div>
                                            <div class="flex items-center " title="online">
                                                <?php
                                                if (last_seen($chatWith['lastseen']) == "Active") {
                                                ?>
                                                    <div class="online"></div>
                                                    <small class="block ">Online</small>
                                                <?php } else { ?>
                                                    <small class="block ">
                                                        Last seen:
                                                        <?= last_seen($chatWith['lastseen']) ?>
                                                    </small>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-4 rounded flex flex-col mt-2 chat-box" id="chatBox">
                                        <?php
                                        if (!empty($chats)) {
                                            foreach ($chats as $chat) {
                                                if ($chat['from_id'] == $_SESSION['user_id']) { ?>
                                                    <div class="flex justify-end items-end">
                                                        <div class="bg-gray-500 space-y-2 mb-1 max-w-96 w-[200px] mr-1 border rounded-lg">
                                                            <p class="text-right text-black p-2 mr-2">
                                                                <?= $chat['message'] ?>

                                                                <small class="block">
                                                                    <?=
                                                                    $chat['created_at'] ?>
                                                                </small>
                                                            </p>

                                                        </div>
                                                        <!-- <?php $g = g($conn, $userna) ?> -->
                                                        <!-- <img src="../upload/Avatar/<?= $g ?>" alt="" class="inline-block h-10 w-10 rounded-full"> -->

                                                    </div>
                                                <?php } else { ?>
                                                    <div class="flex justify-start items-end">
                                                        <img src="../upload/Avatar/<?= $chatWith['avatar'] ?>" class="inline-block h-10 w-10 rounded-full mr-1">
                                                        <div class="flex items-center border rounded-lg my-2 p-2.5">
                                                            <p class="text-left ml-1">
                                                                <?= $chat['message'] ?>
                                                                <small class="block">
                                                                    <?= $chat['created_at'] ?>
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>
                                            <?php }
                                            }
                                        } else { ?>
                                            <div class="alert alert-info text-center">
                                                <i class="fa fa-comments block fs-big"></i>
                                                No messages yet, Start the conversation
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="input-group mt-3 flex items-center">
                                        <input type="text" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full py-4 px-4 placeholder:text-[12px]" id="message" placeholder="Write Message">
                                        <button class="w-28 btn btn-primary ml-2" for="message" id="sendBtn">
                                            <i class="fa fa-paper-plane"></i>
                                            Send
                                        </button>
                                    </div>

                                </div>
                                <script>
                                    var scrollDown = function() {
                                        let chatBox = document.getElementById('chatBox');
                                        chatBox.scrollTop = chatBox.scrollHeight;
                                    }

                                    scrollDown();

                                    $(document).ready(function() {

                                        $("#sendBtn").on('click', function() {
                                            message = $("#message").val();
                                            if (message == "") return;

                                            $.post("req/ajax/insert.php", {
                                                    message: message,
                                                    to_id: <?= $chatWith['id'] ?>
                                                },
                                                function(data, status) {
                                                    $("#message").val("");
                                                    $("#chatBox").append(data);
                                                    scrollDown();
                                                });
                                        });

                                        /** 
                                        auto update last seen 
                                        for logged in user
                                        **/
                                        let lastSeenUpdate = function() {
                                            $.get("req/ajax/update_last_seen.php");
                                        }
                                        lastSeenUpdate();
                                        /** 
                                        auto update last seen 
                                        every 10 sec
                                        **/
                                        setInterval(lastSeenUpdate, 1000);



                                        // auto refresh / reload
                                        let fechData = function() {
                                            $.post("req/ajax/getMessage.php", {
                                                    id_2: <?= $chatWith['id'] ?>
                                                },
                                                function(data, status) {
                                                    $("#chatBox").append(data);
                                                    if (data != "") scrollDown();
                                                });
                                        }

                                        fechData();
                                        /** 
                                        auto update last seen 
                                        every 0.5 sec
                                        **/
                                        setInterval(fechData, 50);

                                    });
                                </script>
                            </div>


                        </section>


                    </div>
                </main>
                <aside class="w-[400px] h-screen position-relative max-[500px]:hidden">
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
                                <?php if ($categories != 0) { ?>
                                    <?php foreach ($categories as $category) { ?>
                                        <div class=" border-b text-center py-3 border-gray-800">
                                            <a href="../category.php?category_id=<?= $category['id'] ?>" class=" text-xl whitespace-nowrap text-white"><?= $category['category'] ?></a>
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
                                        <a href="../Category.php" class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</a>
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

                                    <?php foreach ($userl as $user) { ?>
                                        <div class="flex-1">
                                            <div class="flex items-center pl-3">
                                                <img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $user['avatar'] ?>" alt="">
                                                <div class="ml-3 mt-3">
                                                    <p class="text-base leading-6 font-medium text-white capitalize"><?= $user['fname'] ?></p>
                                                    <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"><?= $user['username'] ?></>
                                                </div>
                                                <div class="flex-1 px-4 py-2 m-2">
                                                    <a href="profile-view.php?username=<?= $user['username'] ?>" class=" float-right">
                                                        <button class="bg-transparent hover:bg-gray-800 text-white font-semibold hover:text-white py-2 px-4 border border-white hover:border-transparent rounded-full">
                                                            Visit Profile
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>



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
<?php
} else {
    header("Location: ../blog.php");
    exit;
}
?>