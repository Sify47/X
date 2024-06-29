<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Posts</title>
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="../css/side-bar.css">
		<link rel="stylesheet" href="../css/style.css">
		<script src="../js/font.js"></script>
		<script src="../js/flowbite.js"></script>
		<script src="../tailwind.js"></script>
	</head>

	<body class="bg-gray-900">
		<?php
		$key = "hhdsfs1263z";
		include "inc/side-nav.php";
		include_once("data/Post.php");
		include_once("../Profile/req/Comment.php");
		include_once("../db_conn.php");
		$posts = getAllDeep($conn);
		?>

		<div class="lg:ml-[200px] lg:w-[900px] shadow-md sm:rounded-lg p-5">
			<h3 class="mb-3 space-x-3 flex ">
				<span class="text-[30px] text-white">All Tweets</span>
				<!-- <a href="post-add.php" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Add New</a> -->
			</h3>
			<?php if (isset($_GET['error'])) { ?>
				<div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
					<div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
						<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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

			<?php if ($posts != 0) { ?>
				<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 max-w-[1100px]">
					<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
						<tr>
							<th class="text-center px-6 py-3" scope="col">Id</th>
							<th class="text-center px-6 py-3">Username</th>
							<th class="text-center px-6 py-3">Category</th>
							<th class="text-center px-6 py-3">Comments</th>
							<th class="text-center px-6 py-3">Likes</th>
							<th class="text-center px-6 py-3">Tweet</th>
							<th class="text-center px-6 py-3">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($posts as $post) {
							$category = getCategoryById($conn, $post['category']);
						?>
							<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
								<th class="text-center px-6 py-4" scope="row"><?= $post['tweet_id'] ?></th>
								<td class="text-center px-6 py font-bold text-lg text-gray-900 whitespace-nowrap dark:text-white"><a href="Profile/profile-view.php?username=<?= $post['username'] ?>"><?= $post['username'] ?></a></td>
								<td class="text-center px-6 py-4">
									<?= $category['category'] ?>
								</td>
								<td class="text-center px-6 py-4">
									<i class="fa fa-comment" aria-hidden="true"></i>

									<?php
									echo CountByPostID($conn, $post['tweet_id']);
									?>
								</td>
								<td class="text-center px-6 py-4">
									<i class="fa-brands fa-gratipay fa-shake love w-3" aria-hidden="true"></i>
									<?php
									echo likeCountByPostID($conn, $post['tweet_id']);
									?>
								</td>
								<td><a href="single_post.php?post_id=<?= $post['tweet_id']?>"><?= $post['tweet'] ?></a></td>
								<td class="flex flex-col text-center px-6 py-4">
									<div class="flex justify-around my-2 ">
										<button><a href="post-delete.php?post_id=<?= $post['tweet_id'] ?>" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a></button>
										<!-- <button><a href="post-edit.php?tweet_id=<?= $post['tweet_id'] ?>" class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5  dark:focus:ring-yellow-900">Edit</a></button> -->

									</div>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			<?php } else { ?>
				<div id="toast-simple" class="flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
					<div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
						<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
							<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
						</svg>
						<span class="sr-only">Warning icon</span>
					</div>
					<div class="ps-4 text-sm font-normal">Empty</div>
				</div>
			<?php } ?>
		</div>
		</section>
		</div>

		<script>
			var navList = document.getElementById('navList').children;
			navList.item(1).classList.add("active");
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../admin-login.php");
	exit;
} ?>