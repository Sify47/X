<? ?>
<?php
session_start();
$logged = false;
if ((isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
	$userid = $_SESSION['username'];
}

if (isset($_GET['tweet_id'])) {

	include_once("Post.php");
	include_once("User.php");
	include_once("req/Comment.php");
	include_once("../db_conn.php");
	$id = $_GET['tweet_id'];
	$post = getById($conn, $id);
	$comments = getCommentsByPostID($conn, $id);
	$co = CountByPostID($conn, $id);
	$categories = get3Categoies($conn);
	$users = getAlll($conn, $userid);

	if ($post == 0) {
		header("Location: blog.php");
		exit;
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tweet of - <?= $post['username'] ?></title>
		<script src="../tailwind.js"></script>
		<script src="../js/alpine.js"></script>
		<script src="../js/font.js"></script>
		<link rel="stylesheet" href="daist.css">
		<link rel="stylesheet" href="full.min.css">
	</head>

	<body class="overflow-x-hidden h-full" style="background-color: #15202b;">
		<div class="" style="background-color: #15202b;">
			<div class="flex justify-center max-[500px]:flex-col">

				<header class="text-white">
					<!-- Navbar (left side) -->
					<div class="max-[500px]:hidden" style="width: 275px;">
						<div class="overflow-y-auto fixed h-screen pr-3" style="width: 275px;">
							<!--Logo-->

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

				<main role="main w-[750px] max-[500px]:w-[350px]">
					<div class="flex w-[750px] max-[500px]:w-[350px]">
						<section class="w-[750px] h-auto max-[500px]:w-[350px] lg:border lg:border-y-0 lg:border-gray-800">
							<!--Content (Center)-->
							<!-- Nav back-->
							<div>
								<div class="flex justify-center">
									<div class="px-4 py-2 mx-2">
										<a href="../blog.php">
											<svg viewBox="0 0 24 24" aria-hidden="true" class="h-8 w-8 text-[white] ml-4" fill="currentColor">
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
								<div class="flex justify-center ">
									<?php if (isset($_GET['error'])) { ?>
										<div class="alert alert-warning w-auto my-3 text-[18px] text-center capitalize">
											<?= htmlspecialchars($_GET['error']) ?>
										</div>
									<?php } ?>

									<?php if (isset($_GET['success'])) { ?>
										<div class="alert alert-success w-auto my-3 text-[18px] text-center capitalize">
											<?= htmlspecialchars($_GET['success']) ?>
										</div>
									<?php } ?>
								</div>
								<div class="card main-blog-card mb-5">
									<div class="flex flex-shrink-0 p-4 pb-0">

										<div class="flex-shrink-0 group block">
											<div class="flex items-center">
												<div>
													<?php $o = $post['username'] ?>
													<?php $p = g($conn, $o) ?>
													<img class="inline-block h-10 w-10 rounded-full" src="../upload/Avatar/<?= $p ?>" alt="">
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
										</div>

										<?php if ($post['username'] == $userid) {
										?>
											<div class="absolute right-[30px] top-6">

												<div>

													<div class="dropdown bg-transparent">
														<div tabindex="0" role="button" class=" m-1">
															<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
																<path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
															</svg>
														</div>
														<ul tabindex="0" class="dropdown-content z-[1] menu p-2  bg-base-100 rounded-box w-52">
															<li><a href="tweet-edit.php?tweet_id=<?= $post['tweet_id'] ?>">Edit</a></li>
															<li><label for="my_modal_6" class="btn flex justify-center w-[900px] max-h-max whitespace-nowrap focus:outline-none  focus:ring  max-w-max border border-blue-500 text-blue-500 hover:border-blue-800  items-center hover:shadow-lg font-bold py-2 px-4 rounded-full mr-0 ml-auto">Edit Profile</label>

																<!-- Put this part before </body> tag -->
																<input type="checkbox" id="my_modal_6" class="modal-toggle bg-transparent w-[900px]" />
																<div class="modal h-screen w-[900px] overflow-y-scroll shadow-none bg-transparent" role="dialog">
																	<div class="modal-box w-[900px]">
																		<div class="flex flex-col">
																			<form action="req/tweet_edit.php" method="post" enctype="multipart/form-data">
																				<div class="mb-3">
																					<input type="text" class="form-control" name="username" value="<?= $post['username'] ?>" hidden>
																					<input type="text" class="form-control" name="tweet_id" value="<?= $post['tweet_id'] ?>" hidden>
																					<input type="text" class="form-control" name="cover_url" value="<?= $post['cover_url'] ?>" hidden>
																				</div>
																				<div>
																					<input type="text" hidden class="form-control" name="userfname" value="<?= $post['fname'] ?>">
																				</div>

																				<div class="mb-3">
																					<textarea rows="8" class="textarea textarea-bordered textarea-lg w-[700px] placeholder:text-sm" name="tweet"><?= $post['tweet'] ?></textarea>
																				</div>
																				<div class="mb-3">
																					<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo">Upload Photo</label>
																					<input type="file" id="cover" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="cover">
																					<img src="../upload/blog/<?= $post['cover_url'] ?>" class="w-full">
																				</div>
																				<p class="mt-1 ml-2 text-[12px] text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG Or JPG.</p>

																				<div class="my-3">
																					<label class="sr-only">Category</label>
																					<select name="category" class="block  py-2.5 px-0 w-full text-lg text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
																						<?php foreach ($categories as $category) { ?>
																							<option class="bg-gray-700 text-white text-[16px]" value="<?= $category['id'] ?>">
																								<?= $category['category'] ?></option>
																						<?php } ?>
																					</select>

																				</div>
																				<div class="flex  justify-end">
																					<button type="submit" class="btn btn-success w-32 ">Edit Tweet</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</li>
															<li>
																<div x-data="{ showModal: false }">
																	<!-- Button to open the modal -->
																	<button @click="showModal = true" class="">Del</button>
																	<!-- Background overlay -->
																	<div x-show="showModal" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
																		<div class="absolute inset-0 bg-gray-700 opacity-35"></div>
																	</div>
																	<!-- Modal -->
																	<div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="fixed z-10 inset-0 overflow-y-hidden w-96 h-screen" x-cloak>
																		<div class="flex items-end justify-center h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
																			<!-- Modal panel -->
																			<div class="h-screen w-full inline-block align-bottom bg-[#15202 rounded-lg text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
																				<div class="bg-[#15202b]  px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
																					<!-- Modal content -->
																					<div class="sm:flex sm:items-start">
																						<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
																							<!-- Heroicon name: outline/exclamation -->
																							<svg width="64px" height="64px" class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#ef4444" stroke-width="0.45600000000000007">
																								<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
																								<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
																								<g id="SVGRepo_iconCarrier">
																									<path d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="#ef4444"></path>
																									<path d="M12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="#ef4444"></path>
																									<path fill-rule="evenodd" clip-rule="evenodd" d="M8.2944 4.47643C9.36631 3.11493 10.5018 2.25 12 2.25C13.4981 2.25 14.6336 3.11493 15.7056 4.47643C16.7598 5.81544 17.8769 7.79622 19.3063 10.3305L19.7418 11.1027C20.9234 13.1976 21.8566 14.8523 22.3468 16.1804C22.8478 17.5376 22.9668 18.7699 22.209 19.8569C21.4736 20.9118 20.2466 21.3434 18.6991 21.5471C17.1576 21.75 15.0845 21.75 12.4248 21.75H11.5752C8.91552 21.75 6.84239 21.75 5.30082 21.5471C3.75331 21.3434 2.52637 20.9118 1.79099 19.8569C1.03318 18.7699 1.15218 17.5376 1.65314 16.1804C2.14334 14.8523 3.07658 13.1977 4.25818 11.1027L4.69361 10.3307C6.123 7.79629 7.24019 5.81547 8.2944 4.47643ZM9.47297 5.40432C8.49896 6.64148 7.43704 8.51988 5.96495 11.1299L5.60129 11.7747C4.37507 13.9488 3.50368 15.4986 3.06034 16.6998C2.6227 17.8855 2.68338 18.5141 3.02148 18.9991C3.38202 19.5163 4.05873 19.8706 5.49659 20.0599C6.92858 20.2484 8.9026 20.25 11.6363 20.25H12.3636C15.0974 20.25 17.0714 20.2484 18.5034 20.0599C19.9412 19.8706 20.6179 19.5163 20.9785 18.9991C21.3166 18.5141 21.3773 17.8855 20.9396 16.6998C20.4963 15.4986 19.6249 13.9488 18.3987 11.7747L18.035 11.1299C16.5629 8.51987 15.501 6.64148 14.527 5.40431C13.562 4.17865 12.8126 3.75 12 3.75C11.1874 3.75 10.4379 4.17865 9.47297 5.40432Z" fill="#ef4444"></path>
																								</g>
																							</svg>
																						</div>
																						<div class="my-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
																							<div class="mt-2">
																								<p class="text-sm text-gray-500"> Are you sure you want to delete <span class="font-bold">This Tweet</span>? This action cannot be undone. </p>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="bg-[#15202b] px-4 pb-6 sm:px-6 sm:flex sm:flex-row-reverse">
																					<button @click="deleteItem" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-500 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"> <a href="post-del.php?post_id=<?= $post['tweet_id'] ?>">Delete</a> </button>
																					<button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"> Cancel </button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
													</div>
												</div>

											</div>
									</div>

								<?php } ?>
								</div>

							</div>
							<div class="card-body border border-gray-800 rounded-2xl mx-3">
								<p class="card-text text-xl font-medium"><?= $post['tweet'] ?></p>
							</div>
							<img src="../upload/blog/<?= $post['cover_url'] ?>" class="w-full h-[500p] p-3" alt="...">
							<div class="card-body">
								<hr class="border-gray-800">
								<div class="flex justify-between my-2">
									<div class="flex-1 flex items-center justify-center text-white text-xs  hover:text-blue-400 transition duration-350 ease-in-out">
										<div class="flex items-center">
											<svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
												<g>
													<path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path>
												</g>
											</svg>
											<?php echo CountByPostID($conn, $post['tweet_id']); ?>
										</div>
									</div>
									<div class="flex-1 flex items-center justify-center react-btns space-x-2">
										<?php
										$post_id = $id;
										if ($logged) {
											$liked = isLikedByUserID($conn, $post_id, $user_id);


											if ($liked) {
										?>
												<i class="fa-brands fa-gratipay fa-shake love like-btn fa-lg text-gray-400" post-id="<?= $post_id ?>" liked="1" aria-hidden="true"></i>


											<?php } else { ?>
												<i class="fa-brands fa-gratipay fa-beat like like-btn fa-lg text-gray-400 " post-id="<?= $post_id ?>" liked="0" aria-hidden="true"></i>

											<?php }
										} else { ?>
											<i class="fa-brands fa-gratipay" aria-hidden="true"></i>
										<?php } ?>
										<span class="text-white text-xs"><?php
																			echo likeCountByPostID($conn, $post['tweet_id']); ?>
										</span>

									</div>
								</div>
								<small class="text-body-secondary"><span class="text-xl mb-2 text-white">Crated At: </span><?= $post['crated_at'] ?></small>
								<hr class="border-gray-800 mt-2">
								<form action="../php/comment.php" method="post" id="comments">

									<h5 class="mt-2 mb-2 text-white text-2xl">Add Comment</h5>

									<div class="flex mb-3">
										<input type="text" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-[300px] p-2.5" name="comment">
										<input type="text" class="form-control" name="post_id" value="<?= $id ?>" hidden>
										<button type="submit" class="ml-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Comment</button>
									</div>
								</form>
								<hr class="border-gray-800 my-2">
								<div>
									<div class="comments">
										<h1 class="text-2xl text-white mb-3">Comment</h1>
										<?php if ($comments != 0) {
											foreach ($comments as $comment) {
												$u = getUserByID($conn, $comment['user_id']);
										?>
												<div class="comment flex flex-col">
													<!-- if($post['username']) -->
													<div class="flex flex-col mt-2 ">
														<div class="p-2 w-full flex">
															<img src="../upload/Avatar/<?= $u['avatar']?>" class="inline-block h-12 w-12 rounded-full" alt="">
															<p class=" border border-gray-800 rounded-2xl mx-3 w-[470px] h-full text-warp text-white p-2 text-[21px] font-normal mb-1"><?= $comment['comment'] ?></p>
															<?php if ($comment['user_id'] == $user_id) { ?>
																<div class="w-full">
																	<a href="req/comment-delete.php?comment_id=<?= $comment['comment_id'] ?>" class="btn btn-error mt-2 font-normal text-[17px] text-center">Delete Comment</a>
																</div>
															<?php } ?>
														</div>
														<small class="text-body-secondary ml-5 mt-2"><?= $comment['crated_at'] ?></small>
													</div>
												
											<?php }} ?>
												</div>
									</div>
									<hr class="border-gray-800 my-2">
								</div>
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

									<?php foreach ($users as $user) { ?>
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
					$(this).next().load("../ajax/like-unlike.php", {
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