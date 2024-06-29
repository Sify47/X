<?php
session_start();
$logged = false;
if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_GET['cat_id'])) {
    $logged = true;
    $cat_id = $_GET['cat_id'];
    include_once("../db_conn.php");
    include_once("data/Post.php");
    include_once("data/Category.php");
    include_once("data/Comment.php");
    $category = getById($conn, $cat_id)
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>View Category Of - <?= $category['category'] ?> </title>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="../css/side-bar.css">
        <!-- <link rel="stylesheet" href="../css/style.css"> -->
        <script src="../js/font.js"></script>
        <script src="../js/flowbite.js"></script>
        <script src="../tailwind.js"></script>
        <link rel="stylesheet" href="../Profile/full.min.css">
        <link rel="stylesheet" href="../Profile/daist.css">
    </head>

    <body>
        <?php
        $key = "hhdsfs1263z";
        include "inc/side-nav.php";

        ?>

        <main role="main" class="container mx-auto w-[2000px]">
            <div class="flex justify-center">
                <section class="w-[800px] h-auto border border-y-0 border-gray-800">
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
                            <div class="px-4 py-2 mx-2 text-white text-md font-medium">
                                <h1><?php if ($category != 0)
                                        echo "Tweets about '" . $category['category'] . "'";
                                    else echo "Tweets about"; ?></h1>

                            </div>
                        </div>

                        <hr class="border-gray-800">
                    </div>

                    <div>
                        <div class="mt-">

                            <!-- <a href="ca.php"></a> -->
                            <section class="flex">
                                <?php
                                // $cId = $_GET['category_id'];
                                $posts = getAllPostsByCategory($conn, $cat_id);
                                ?>
                                <?php if ($posts != 0) { ?>
                                    <main class="">
                                        <?php foreach ($posts as $post) { ?>
                                            <div class="w-full hover:bg-gray-800 transition duration-350 ease-in-ou">
                                                <div class="flex flex-shrink-0 p-4 pb-0">

                                                    <a href="Profile/tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="flex-shrink-0 group block">
                                                        <div class="flex items-center">
                                                            <div>
                                                                <?php $o = $post['username'] ?>
                                                                <?php $p = getuser($conn, $o) ?>
                                                                <img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $p['avatar'] ?>" alt="">
                                                            </div>
                                                            <div class="ml-3">
                                                                <p class="text-base leading-6 font-medium text-white">
                                                                    <span><?= $post['fname'] ?></span>
                                                                    <span class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">
                                                                        @<?= $post['username'] ?> . <?= $post['crated_at'] ?>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>


                                                <div class="lg:pl-[65px] md:pr-10">
                                                    <a href="Profile/tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="text-base width-auto font-medium text-white flex-shrink">
                                                        <span class="text-white max-[500px]:text-[15px] max-[500px]:font-normal"><?= $post['tweet'] ?></span>
                                                    </a>

                                                    <div class="md:flex-shrink  pt-3">
                                                        <a href="single_post.php?post_id=<?= $post['tweet_id'] ?>" class="bg-cover bg-no-repeat bg-center rounded-lg w-full h-full " style="height: 420">
                                                            <img class="rounded-lg h-full w-full" src="../upload/blog/<?= $post['cover_url'] ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="flex items-center py-4 align-middle ">
                                                        <div class="flex-1 flex items-center justify-center text-white text-xs  hover:text-blue-400 transition duration-350 ease-in-out">
                                                            <a class="flex items-center" href="Profile/tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>">
                                                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                                                    <g>
                                                                        <path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
                                                                    </g>
                                                                </svg>
                                                                <?php echo CountByPostID($conn, $post['tweet_id']); ?>
                                                            </a>
                                                        </div>
                                                        <div class="flex-1 flex items-center justify-center react-btns space-x-2">
                                                            <i class="fa-brands fa-gratipay fa-shake love like-btn fa-lg text-gray-400 "></i>
                                                            <span class="text-white text-xs"><?php echo likeCountByPostID($conn, $post['tweet_id']); ?></span>

                                                        </div>

                                                    </div>

                                                </div>
                                                <hr class="border-gray-800">
                                            </div>
                                        <?php } ?>
                                    </main>
                                <?php } else { ?>
                                    <main class="main-blog p-2">
                                        <div class="alert alert-warning">
                                            No posts yet.
                                        </div>
                                    </main>
                                <?php } ?>

                            </section>

                        </div>


                    </div>

                </section>


            </div>
        </main>

        <script>
            var navList = document.getElementById('navList').children;
            navList.item(2).classList.add("active");
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>

    </html>

<?php } else {
    header("Location: ../admin-login.php");
    exit;
} ?>