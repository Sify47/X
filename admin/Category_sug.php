<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Category Suggestion</title>
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="../css/side-bar.css">
		<!-- <link rel="stylesheet" href="../css/style.css"> -->
		<script src="../tailwind.js"></script>
		<script src="../js/alpine.js"></script>
		<script src="../js/font.js"></script>
		<script src="../js/flowbite.js"></script>
		<link rel="stylesheet" href="../Profile/daist.css">
	</head>

	<body class="bg-gray-900">
		<?php
		$key = "hhdsfs1263z";
		include "inc/side-nav.php";
		include_once("data/User.php");
		include_once("data/Category.php");
		include_once("../db_conn.php");
		$categories = getAll($conn);
		$su = gesug($conn);
		// $user = get($conn,);

		?>

		<div class="lg:ml-[200px] lg:w-[900px] shadow-md sm:rounded-lg p-5">
			<h3 class="mb-3 space-x-3 flex ">
				<span class="text-[30px] text-white">All Categories Suggestion</span>
				<!-- <a href="category-add.php" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Add New</a> -->
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
			<?php if ($su != 0) { ?>
				<?php foreach ($su as $sugs) { ?>
					<div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
						<div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
							<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
							</svg>
							<span class="sr-only">Check icon</span>
						</div>
						<div class="ms-3 w-full text-sm font-normal">
							<?php $user = get($conn, $sugs['user_id']) ?>
							<h1 class="text-xl text-center mb-3"><?= $sugs['Cat'] ?></h1>

							<h1>Suggestion For <a href="../Profile/profile-view.php?username=<?= $user ?>" class="hover:underline "><?= $user ?></a></h1>
							<img src="../upload/category/<?= $sugs['cover'] ?>" class="my-3" alt="">
							<form action="req/sugtocat.php" method="post" enctype="multipart/form-data">
								<input type="text" hidden name="sug" value="<?= $sugs['Cat'] ?>">
								<input type="text" hidden name="cover" value="<?= $sugs['cover'] ?>">
								<input type="text" hidden name="id" value="<?= $sugs['id'] ?>">
								<button type="submit" class="btn btn-primary w-full">Send</button>
							</form>
							<form action="req/sugcatdel.php" method="post">
								<input type="text" hidden name="sug" value="<?= $sugs['Cat'] ?>">
								<input type="text" hidden name="id" value="<?= $sugs['id'] ?>">
								<button type="submit" class="btn btn-primary w-full">Del</button>
							</form>
						</div>

					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="alert alert-warning">
					Empty!
				</div>
			<?php } ?>
		</div>
		</section>
		</div>

		<script>
			var navList = document.getElementById('navList').children;
			navList.item(3).classList.add("active");
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</body>

	</html>

<?php } else {
	header("Location: ../admin-login.php");
	exit;
} ?>