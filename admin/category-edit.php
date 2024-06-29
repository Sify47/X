<?php
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) && $_GET['id']) {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard - Category Edit</title>
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
		$id = $_GET['id'];
		include "inc/side-nav.php";
		include_once("data/Category.php");
		include_once("../db_conn.php");
		$category = getById($conn, $id);

		?>

		<div class="flex flex-col w-[1700px] content-center items-center">
			<h3 class="my-3 text-white text-2xl">Edit Category</h3>
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-warning">
					<?= htmlspecialchars($_GET['error']) ?>
				</div>
			<?php } ?>

			<?php if (isset($_GET['success'])) { ?>
				<div class="alert alert-success">
					<?= htmlspecialchars($_GET['success']) ?>
				</div>
			<?php } ?>
			<form class="shadow p-3" action="req/Category-edit.php" method="post" enctype="multipart/form-data">

				<div class="mb-3">
					<label class="form-label">Category</label>
					<!-- <input type="text" class="form-control" name="category" value="<?= $category ?>"> -->
					<input type="text" class="rounded-lg text-sm focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 mb-3" name="category" value="<?= $category['category'] ?>">
					<input type="text" class="form-control" name="id" value="<?= $category['id'] ?>" hidden>
					<input type="text" class="form-control" name="cover_url" value="<?= $category['cover'] ?>" hidden>
					<img src="../upload/category/<?= $category['cover'] ?>" class="w-full h-[400px]" alt="">
				</div>
				<div class="mb-3">
					<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo">Upload Photo</label>
					<input type="file" id="cover" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" value="<?= $category['cover'] ?>" name=" cover">
				</div>
				<p class="mt-1 ml-2 text-[12px] text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG Or JPG.</p>

				<button type="submit" class="mt-3 btn btn-primary">Edit</button>
			</form>

		</div>
		
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