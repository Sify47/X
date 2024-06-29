<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
	$userid = $_SESSION['username'];
}
$notFound = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php
		if (isset($_GET['search'])) {
			echo "search '" . htmlspecialchars($_GET['search']) . "'";
		} else {
			echo "Tweeter";
		} ?>
	</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<!-- <link rel="stylesheet" href="css/style.css"> -->
	<script src="https://kit.fontawesome.com/52d0aa4c29.js" crossorigin="anonymous"></script>
	<script src="js/ajax.js"></script>
	<script src="js/font.js"></script>
	<script src="js/flowbite.js"></script>
	<script src="tailwind.js"></script>
	<link rel="stylesheet" href="Profile/full.min.css">
	<link rel="stylesheet" href="Profile/daist.css">


</head>

<body class="overflow-x-hidden">
	<?php
	// include 'inc/NavBar.php';
	include_once("Profile/Post.php");
	include_once("Profile/User.php");
	include_once("Profile/req/Comment.php");
	include_once("db_conn.php");
	// include_once("Profile/Post.php");
	if (isset($_GET['search'])) {
		$key = $_GET['search'];
		$posts = serach($conn, $key);
		if ($posts == 0) {
			$notFound = 1;
		}
	} else {
		$posts = getAll($conn);
	}
	$categories = get3Categoies($conn);
	$users = getAlll($conn);
	// $p = ge(($conn , ))
	// include_once("Profile/User.php");
	// $users = get($conn, $userid);
	// $usern = getAllusern($conn);
	// $count = user($conn, $userid);
	?>
	<!-- <button><a href="Profile/profile.php">pro</a></button> -->
	<!-- <div class="container mt-5">
		<section class="flex justify-between">

			<?php if ($posts != 0) { ?>
				<main class="flex flex-col ml-[150px] w-[600px] ">
					<h1 class="display-4 mb-4 fs-3">
						<?php
						if (isset($_GET['search'])) {
							echo "Search <b>'" . htmlspecialchars($_GET['search']) . "'</b>";
						} ?></h1>
					<?php foreach ($posts as $post) { ?>
						<div class="card main-blog-card mb-5">
							<img src="upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title"><?= $post['post_title'] ?></h5>
								<?php
								$p = strip_tags($post['post_text']);
								$p = substr($p, 0, 200);
								?>
								<p class="card-text"><?= $p ?>...</p>
								<a href="blog-view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read more</a>
								<hr>
								<div class="d-flex justify-content-between">
									<div class="react-btns">
										<?php
										$post_id = $post['tweet_id'];
										if ($logged) {
											$liked = isLikedByUserID($conn, $post_id, $user_id);


											if ($liked) {
										?>
												<i class="fa-brands fa-gratipay fa-shake love like-btn" post-id="<?= $post_id ?>" liked="1" aria-hidden="true"></i>
											<?php } else { ?>
												<i class="fa-brands fa-gratipay fa-beat like like-btn" post-id="<?= $post_id ?>" liked="0" aria-hidden="true"></i>

											<?php }
										} else { ?>
											<i class="fa fa-thumbs-up" aria-hidden="true"></i>
										<?php } ?>
										<span><?php
												echo likeCountByPostID($conn, $post['tweet_id']);
												?></span>
										<a href="blog-view.php?post_id=<?= $post['tweet_id'] ?>#comments">
											<i class="fa fa-comment" aria-hidden="true"></i>
											<?php echo CountByPostID($conn, $post['tweet_id']); ?>
										</a>
									</div>
									<?= $post['username'] ?>
									<small class="text-body-secondary"><?= $post['crated_at'] ?></small>
								</div>

							</div>
						</div>
					<?php } ?>
				</main>
			<?php } else { ?>
				<main class="main-blog p-2">
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
				</main>
			<?php } ?>
			<aside class="aside-main">
				<div class="list-group category-aside">
					<a href="#" class="list-group-item list-group-item-action active" aria-current="true">
						Category
					</a>
					<?php foreach ($categories as $category) { ?>
						<a href="category.php?category_id=<?= $category['id'] ?>" class="list-group-item list-group-item-action">
							<?php echo $category['category']; ?>
						</a>
					<?php } ?>
				</div>
			</aside>
		</section>
	</div> -->
	<div class="" style="background-color: #15202b;">
		<div class="flex justify-center max-[500px]:flex-col">

			<header class="text-white">
				<!-- Navbar (left side) -->
				<div class="max-[500px]:hidden" style="width: 275px;">
					<div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
						<!--Logo-->

						<!-- Nav-->
						<nav class="mt-5 px-2">
							<a href="blog.php" class="group flex items-center px-2 py-2 text-base leading-6 font-semibold rounded-full bg-gray-800 text-blue-300 ">
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
							<a href="../logout.php" class="mt-1 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-800 hover:text-blue-300">
								<svg class="mr-4 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
									<path fill="#ffffff" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
								</svg>
								LogOut
							</a>


							<a href="Profile/tweet-add.php" class="btn bg-blue-400 hover:bg-blue-500 w-full mt-5 text-white font-bold py-2 px-4 rounded-full">Tweet</a>
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

			<main class="main w-[750px] max-[500px]:w-[350px]">
				<div class="flex w-[750px] max-[500px]:w-[350px]">
					<section class="w-[750px] max-[500px]:w-[350px] lg:border lg:border-y-0 lg:border-gray-800">
						<!--Content (Center)-->
						<!-- Nav back-->
						<div>
							<div class="flex justify-center">
								<div class="px-4 py-2 mx-2">
									<a href="blog.php">
										<svg viewBox="0 0 24 24" aria-hidden="true" class="h-8 w-8 text-white ml-3" fill="currentColor">
											<g>
												<path d=" M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
											</g>
										</svg>
									</a>
								</div>
							</div>

							<hr class="border-gray-800">
						</div>
						<!-- User card-->
						<div>

							<?php if ($posts != 0) { ?>
								<ul class="list-none w-[750px] max-[500px]:w-[350px]">
									<li>
										<?php
										if (isset($_GET['search'])) {
											echo "Search <b>'" . htmlspecialchars($_GET['search']) . "'</b>";
										} ?>
										</h1>
										<!--second tweet-->
										<?php foreach ($posts as $post) { ?>
											<article class="w-[750px] max-[500px]:w-[350px] relative hover:bg-gray-800 transition duration-350 ease-in-out">

												<div class="flex flex-shrink-0 p-4 pb-0">

													<?php if ($post['username'] == $userid) { ?>
														<a href="Profile/profile.php" class="flex-shrink-0 group block">
															<div class="flex items-center">
																<div>
																	<?php isset($_POST['username']);
																	$o = $post['username'] ?>
																	<?php $p = g($conn, $o) ?>
																	<img class="inline-block h-10 w-10 rounded-full" src="upload/Avatar/<?= $p ?>" alt="">
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
													<?php } else { ?>
														<a href="Profile/profile-view.php?username=<?= $post['username'] ?>" class="flex-shrink-0 group block">
															<div class="flex items-center">
																<div>
																	<?php isset($_POST['username']);
																	$o = $post['username'] ?>
																	<?php $p = g($conn, $o) ?>
																	<img class="inline-block h-10 w-10 rounded-full" src="upload/Avatar/<?= $p ?>" alt="">
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
													<?php } ?>
												</div>


												<div class="lg:pl-[65px] md:pr-10">
													<a href="Profile/tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="text-base width-auto font-medium text-white flex-shrink">
														<span class="text-white max-[500px]:text-[15px] max-[500px]:font-normal"><?= $post['tweet'] ?></span>
													</a>

													<div class="md:flex-shrink  pt-3">
														<a href="Profile/tweet-view.php?tweet_id=<?= $post['tweet_id'] ?>" class="bg-cover bg-no-repeat bg-center rounded-lg w-full h-full " style="height: 420">
															<img class="rounded-lg  w-full h-full" src="upload/blog/<?= $post['cover_url'] ?>" alt="">
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
																<!-- <i class="fa fa-comment" aria-hidden="true"></i> -->
																<?php echo CountByPostID($conn, $post['tweet_id']); ?>
															</a>
														</div>
														<!-- <div class="flex-1 flex items-center justify-center text-white text-xs  hover:text-green-400 transition duration-350 ease-in-out">
																	<svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
																		<g>
																			<path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path>
																		</g>
																	</svg>
																	14 k
																</div> -->
														<div class="flex-1 flex items-center justify-center react-btns space-x-2">
															<?php
															$post_id = $post['tweet_id'];
															if ($logged) {
																$liked = isLikedByUserID($conn, $post_id, $user_id);


																if ($liked) {
															?>
																	<i class="fa-brands fa-gratipay fa-shake love like-btn fa-lg text-gray-400 " post-id=<?= $post_id ?>" liked="1" aria-hidden="true"></i>
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
								<?php if ($users != 0) { ?>
									<?php foreach ($users as $user) { ?>
										<div class="flex-1">
											<div class="flex items-center pl-3">
												<!-- <p class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150">upload/blog/<?= $post['cover_url'] ?></> -->
												<img class="inline-block h-10 w-10 rounded-full" src="upload/Avatar/<?= $user['avatar'] ?>" alt="">
												<div>
													<!-- <img class="inline-block h-10 w-10 rounded-full" src="upload/blog/2.jpg" alt=""> -->
													<!-- <?= $user['avatar'] ?> -->
												</div>
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


							<div class="flex">
								<div class="flex-1 p-4">
									<!-- <h2 class="px-4 ml-2 w-48 font-bold text-blue-400">Show more</h2> -->
								</div>
							</div>

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
				$(this).next().load("ajax/like-unlike.php", {
					post_id: post_id
				});
			});
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>