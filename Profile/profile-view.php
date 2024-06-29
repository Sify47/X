<? ?>
<?php
session_start();
$logged = false;
if ((isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
    $userid = $_SESSION['username'];
    $notFound = 0;
}

if (1) {

    include_once("Post.php");
    include_once("User.php");
    include_once("req/Comment.php");
    include_once("../db_conn.php");
    $id = $_GET['username'];


    $comments = getCommentsByPostID($conn, $id);
    $co = CountByPostID($conn, $id);
    $categories = get3Categoies($conn);
    $users = get($conn, $id);
    $us = getAlll($conn);
    if (isset($_GET['search'])) {
        $key = $_GET['search'];
        $posts = serach($conn, $key);
        if ($posts == 0) {
            $notFound = 1;
        }
    } else {
        $posts = getAll1($conn, $id);
    }
    $count = totaltweet($conn, $id);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile of - <?= $id ?></title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <!-- <script src="https://kit.fontawesome.com/52d0aa4c29.js" crossorigin="anonymous"></script> -->
        <script src="../tailwind.js"></script>
        <script src="../js/alpine.js"></script>
        <script src="../js/font.js"></script>
        <script src="../js/jquery.js"></script>
        <link rel="stylesheet" href="daist.css">
        <link rel="stylesheet" href="full.min.css">
    </head>

    <body class="overflow-x-hidden h-full" style="background-color: #15202b;">
        <div class="" style="background-color: #15202b;">
            <div class="flex justify-center max-[500px]:flex-col">

                <header class="text-white py-4">
                    <!-- Navbar (left side) -->
                    <div class="max-[500px]:hidden" style="width: 275px;">
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
                    <div class="navbar bg-base-100 min-[500px]:hidden">
                        <div class="navbar-start">
                            <div class="dropdown">
                                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                </div>
                                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                                    <li><a>Homepage</a></li>
                                    <li><a>Portfolio</a></li>
                                    <li><a>About</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex-1">
                            <a class="btn btn-ghost text-xl">daisyUI</a>
                        </div>
                        <div class="flex-none gap-2">
                            <div class="form-control">
                                <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
                            </div>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                    <div class="w-10 rounded-full">
                                        <img alt="Tailwind CSS Navbar component" src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>
                                </div>
                                <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                                    <li>
                                        <a class="justify-between">
                                            Profile
                                            <span class="badge">New</span>
                                        </a>
                                    </li>
                                    <li><a>Settings</a></li>
                                    <li><a>Logout</a></li>
                                </ul>
                            </div>
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
                                        <a href="../blog.php" class=" text-2xl font-medium rounded-full text-blue-400 hover:bg-gray-800 hover:text-blue-300 float-right">
                                            <svg class="m-2 h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <g>
                                                    <path d="M20 11H7.414l4.293-4.293c.39-.39.39-1.023 0-1.414s-1.023-.39-1.414 0l-6 6c-.39.39-.39 1.023 0 1.414l6 6c.195.195.45.293.707.293s.512-.098.707-.293c.39-.39.39-1.023 0-1.414L7.414 13H20c.553 0 1-.447 1-1s-.447-1-1-1z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="text-white text-md font-medium">
                                        <h1>Total Tweets: <span><?= $count ?></span></h1>

                                    </div>
                                </div>

                                <hr class="border-gray-800">
                            </div>

                            <!-- User card-->
                            <div>
                                <div class="w-full bg-cover bg-no-repeat bg-center " style="height: 200px; ">
                                    <img class=" w-full h-full" src="../upload/cover/<?= $users['cover'] ?>" alt="">
                                </div>
                                <div class="p-4">
                                    <div class="relative flex w-full">
                                        <!-- Avatar -->
                                        <div class="flex flex-1">
                                            <div style="margin-top: -6rem;">
                                                <div style="height:9rem; width:9rem;" class="md rounded-full relative avatar">
                                                    <img style="height:9rem; width:9rem;" class="md rounded-full relative border-4 border-gray-900" src="../upload/Avatar/<?= $users['avatar'] ?>" alt="">
                                                    <div class="absolute"></div>
                                                </div>
                                            </div>
                                            <a href="chat.php?user=<?= $users['username'] ?>" class="btn flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-2 ml-auto">Chat With Him</a>
                                            <div class="flex space-x-2">
                                                <form action="../ajax/follow.php" method="post" id="f" class="checked:enabled:f">
                                                    <input type="text" name="id" id="" value="<?= $users['id'] ?>" hidden>
                                                    <input type="text" name="username" id="" value="<?= $users['username'] ?>" hidden>
                                                    <button type="submit" onclick="addClass()" id="f" class=" btn flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">Follow</button>
                                                    <!-- <button type="submit">UnFollow</button> -->
                                                </form>
                                                <form action="../ajax/unfollow.php" method="post" class="uf ">
                                                    <input type="text" name="id" id="" value="<?= $users['id'] ?>" hidden>
                                                    <input type="text" name="username" id="" value="<?= $users['username'] ?>" hidden>
                                                    <!-- <button type="submit">Follow</button> -->
                                                    <button type="submit" class="btn flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">UnFollow</button>
                                                </form>

                                            </div>
                                            <!-- <a href="chat.php?user=<?= $users['username'] ?>" class="btn flex justify-center  max-h-max whitespace-nowrap focus:outline-none  focus:ring  max-w-max border bg-transparent border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">Chat With Him</a> -->
                                        </div>
                                    </div>

                                    <!-- Profile info -->
                                    <div class=" space-y-1 justify-center w-full mt-3 ml-3">
                                        <!-- User basic-->
                                        <div>
                                            <h2 class="text-xl leading-6 font-bold text-white"><?= $users['fname'] ?></h2>
                                            <p class="text-sm leading-5 font-medium text-gray-600">@<?= $users['username'] ?></p>

                                        </div>
                                        <!-- Description and others -->
                                        <div class="mt-3">
                                            <p class="text-white leading-tight mb-2">
                                                <?= $users['Bio'] ?>
                                            </p>
                                            <div class="text-gray-600 flex">
                                                <!-- <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                                                    <g>
                                                        <path d="M11.96 14.945c-.067 0-.136-.01-.203-.027-1.13-.318-2.097-.986-2.795-1.932-.832-1.125-1.176-2.508-.968-3.893s.942-2.605 2.068-3.438l3.53-2.608c2.322-1.716 5.61-1.224 7.33 1.1.83 1.127 1.175 2.51.967 3.895s-.943 2.605-2.07 3.438l-1.48 1.094c-.333.246-.804.175-1.05-.158-.246-.334-.176-.804.158-1.05l1.48-1.095c.803-.592 1.327-1.463 1.476-2.45.148-.988-.098-1.975-.69-2.778-1.225-1.656-3.572-2.01-5.23-.784l-3.53 2.608c-.802.593-1.326 1.464-1.475 2.45-.15.99.097 1.975.69 2.778.498.675 1.187 1.15 1.992 1.377.4.114.633.528.52.928-.092.33-.394.547-.722.547z"></path>
                                                        <path d="M7.27 22.054c-1.61 0-3.197-.735-4.225-2.125-.832-1.127-1.176-2.51-.968-3.894s.943-2.605 2.07-3.438l1.478-1.094c.334-.245.805-.175 1.05.158s.177.804-.157 1.05l-1.48 1.095c-.803.593-1.326 1.464-1.475 2.45-.148.99.097 1.975.69 2.778 1.225 1.657 3.57 2.01 5.23.785l3.528-2.608c1.658-1.225 2.01-3.57.785-5.23-.498-.674-1.187-1.15-1.992-1.376-.4-.113-.633-.527-.52-.927.112-.4.528-.63.926-.522 1.13.318 2.096.986 2.794 1.932 1.717 2.324 1.224 5.612-1.1 7.33l-3.53 2.608c-.933.693-2.023 1.026-3.105 1.026z"></path>
                                                    </g>
                                                </svg> <a href="https://ricardoribeirodev.com/personal/" target="#" class="leading-5 ml-1 text-blue-400">www.RicardoRibeiroDEV.com</a></span> -->
                                                <span class="flex mr-2"><svg viewBox="0 0 24 24" class="h-5 w-5 paint-icon">
                                                        <g>
                                                            <path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path>
                                                            <circle cx="7.032" cy="8.75" r="1.285"></circle>
                                                            <circle cx="7.032" cy="13.156" r="1.285"></circle>
                                                            <circle cx="16.968" cy="8.75" r="1.285"></circle>
                                                            <circle cx="16.968" cy="13.156" r="1.285"></circle>
                                                            <circle cx="12" cy="8.75" r="1.285"></circle>
                                                            <circle cx="12" cy="13.156" r="1.285"></circle>
                                                            <circle cx="7.032" cy="17.486" r="1.285"></circle>
                                                            <circle cx="12" cy="17.486" r="1.285"></circle>
                                                        </g>
                                                    </svg> <span class="leading-5 ml-1">Joined <?= $users['cr_tweet'] ?></span></span>
                                            </div>
                                            <div>
                                                <span>
                                                    Following <?= likeCount($conn, $users['id']) ?>
                                                </span>
                                                <span>
                                                    Followers <?= likeCountByID($conn, $users['id']); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- <div class="pt-3 flex justify-start items-start w-full divide-x divide-gray-800 divide-solid">
                                        <div class="text-center pr-3"><span class="font-bold text-white"><?= $users['Following'] ?></span><span class="text-gray-600"> Following</span></div>
                                        <div class="text-center px-3"><span class="font-bold text-white">23,4m </span><span class="text-gray-600"> Followers</span></div>
                                    </div> -->
                                    </div>
                                </div>
                                <hr class="border-gray-800">
                            </div>
                            <?php if ($posts != 0) { ?>
                                <ul class="list-none">
                                    <li>
                                        <h1 class="display-4 mb-4 fs-3">
                                            <?php
                                            if (isset($_GET['search'])) {
                                                echo "Search <b>'" . htmlspecialchars($_GET['search']) . "'</b>";
                                            } ?>
                                        </h1>
                                        <!--second tweet-->
                                        <?php foreach ($posts as $post) { ?>
                                            <article class="relative hover:bg-gray-800 transition duration-350 ease-in-out">

                                                <div class="flex flex-shrink-0 p-4 pb-0">

                                                    <a href="tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="flex-shrink-0 group block">
                                                        <div class="flex items-center">
                                                            <div>
                                                                <img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $users['avatar'] ?>" alt="">
                                                            </div>
                                                            <div class="ml-3">
                                                                <p class="text-base leading-6 font-medium text-white">
                                                                    <span><?= $users['fname'] ?></span>
                                                                    <span class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                                        @<?= $post['username'] ?> . <?= $post['crated_at'] ?>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>


                                                <div class="pl-[65px] pr-10">
                                                    <a href="tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="text-base width-auto font-medium text-white flex-shrink">
                                                        <span class="text-white"><?= $post['tweet'] ?></span>
                                                    </a>

                                                    <div class="md:flex-shrink  pt-3">
                                                        <div class="bg-cover bg-no-repeat bg-center rounded-lg w-full" style="height: 350px;">
                                                            <a href="tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>"><img class="rounded-lg w-full h-full" src="../upload/blog/<?= $post['cover_url'] ?>" alt=""></a>
                                                        </div>
                                                    </div>


                                                    <div class="flex items-center py-4 align-middle ">
                                                        <div class="flex-1 flex items-center justify-center text-white text-xs  hover:text-blue-400 transition duration-350 ease-in-out">
                                                            <a class="flex items-center" href="tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>">
                                                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                                                    <g>
                                                                        <path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
                                                                    </g>
                                                                </svg>
                                                                <!-- <i class="fa fa-comment" aria-hidden="true"></i> -->
                                                                <?php echo CountByPostID($conn, $post['tweet_id']); ?>
                                                            </a>
                                                        </div>
                                                        
                                                        <div class="flex-1 flex items-center justify-center react-btns space-x-2">
                                                            <?php
                                                            $post_id = $post['tweet_id'];
                                                            if ($logged) {
                                                                $liked = isLikedByUserID($conn, $post_id, $user_id);


                                                                if ($liked) {
                                                            ?>
                                                                    <i class="fa-brands fa-gratipay fa-shake love like-btn fa-lg text-gray-400 " post-id="<?= $post_id ?>" liked="1" aria-hidden="true"></i>


                                                                <?php } else { ?>
                                                                    <i class="fa-brands fa-gratipay fa-beat like like-btn fa-lg text-gray-400" post-id="<?= $post_id ?>" liked="0" aria-hidden="true"></i>

                                                                <?php }
                                                            } else { ?>
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                            <?php } ?>
                                                            <span class="text-white text-xs"><?php
                                                                                                echo likeCountByPostID($conn, $post['tweet_id']);
                                                                                                ?></span>

                                                        </div>

                                                    </div>

                                                </div>
                                                <hr class="border-gray-800">
                                            </article>
                                    </li>
                                </ul>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($notFound) { ?>
                                <div class="alert alert-warning">
                                    No search results found
                                    <?php echo " - <b>key = '" . htmlspecialchars($_GET['search']) . "'</b>" ?>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-warning">
                                    No posts yet.
                                </div>
                            <?php } ?>
                        <?php } ?>
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
                                <form class="d-flex" role="search" method="GET" action="../blog.php">
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
                                        <a href="Category.php" class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</a>
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
                                <!-- bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 -->
                                <div class="flex flex-col flex-shrink-0">
                                    <?php if ($us != 0) { ?>
                                        <?php foreach ($us as $user) { ?>
                                            <div class="flex-1">
                                                <div class="flex items-center pl-3">
                                                    <!-- <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">upload/blog/<?= $post['cover_url'] ?></> -->
                                                    <img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $user['avatar'] ?>" alt="">
                                                    <div>
                                                        <!-- <img class="inline-block h-10 w-10 rounded-full" src="upload/blog/2.jpg" alt=""> -->
                                                        <!-- <?= $user['avatar'] ?> -->
                                                    </div>
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

                                    <?php }  ?>

                                </div>
                                <hr class="border-gray-800">
                                <script>
                                    $(document).ready(function() {
                                        $(".like-btn").click(function() {
                                            var post_id = $(this).attr('post-id');
                                            var liked = $(this).attr('liked');

                                            if (liked == 1) {
                                                $(this).attr('liked', '0');
                                                $(this).removeClass('love');
                                            } else {
                                                $(this).attr('liked', '1');
                                                $(this).addClass('love');
                                            }
                                        });
                                    });
                                </script>
                                <div class="flex">
                                    <div class="flex-1 p-4">
                                        <!-- <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2> -->
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

        <style>
            .like-btn.love {
                color: red;
            }

            .like-btn.like:hover {
                color: red;
            }
        </style>
        <script>
            $(document).ready(function() {
                $(".like-btn").click(function() {
                    var post_id = $(this).attr('post-id');
                    var liked = $(this).attr('liked');

                    if (liked == 1) {
                        $(this).attr('liked', '0');
                        $(this).removeClass('love');
                    } else {
                        $(this).attr('liked', '1');
                        $(this).addClass('love');
                    }
                    $(this).next().load("../ajax/follow.php", {
                        post_id: post_id
                    });
                });
            });
        </script>

    </body>

    </html>
<?php } else {
    header("Location: ../blog.php");
    exit;
} ?>