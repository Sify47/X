<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css"> -->
	<script src="tailwind.js"></script>
	<script src="js/alpine.js"></script>
	<script src="/js/flowbite.js"></script>
	<script src="js/font.js"></script>
	<link rel="stylesheet" href="Profile/full.min.css">
	<link rel="stylesheet" href="Profile/daist.css">
</head>

<body style="background-image: url(img/BG.svg); background-repeat: no-repeat;
    background-position: center;
    background-size: cover;">
	<div class="container mx-auto">
		<div class="flex justify-evenly items-center h-screen">
			<svg viewBox="0 0 24 24" aria-hidden="true" class=" w-[360px]">
				<g>
					<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
				</g>
			</svg>
			<form class="w-[400px]" action="php/signup.php" method="post">

				<h4 class="text-[50px] text-white">Create Account</h4><br>
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-danger text-white p-3 mb-4 text-[18px] w-[300px] rounded-md" role="alert">
						<?php echo htmlspecialchars($_GET['error']); ?>
					</div>
				<?php } ?>


				<?php if (isset($_GET['success'])) { ?>
					<div class="alert alert-success text-white p-3 mb-4 text-[18px] w-[300px] rounded-md" role="alert">
						<?php echo htmlspecialchars($_GET['success']); ?>
					</div>
				<?php } ?>
				<div class="mb-3 w-[300px]">
					<label class="block mb-2 text-sm font-medium text-white">Full Name</label>
					<input type="text" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 placeholder:text-[12px]" name="fname" value="<?php echo (isset($_GET['fname'])) ? htmlspecialchars($_GET['fname']) : "" ?>" placeholder="Enter Your Name">
					<?php if (isset($_GET['error_fname'])) { ?>
						<div class="text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_fname']); ?>
						</div>
					<?php } ?>
				</div>

				<div class="mb-3 w-[300px]">
					<label class="block mb-2 text-sm font-medium text-white">Username</label>
					<input type="text" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 placeholder:text-[12px]" name="uname" value="<?php echo (isset($_GET['uname'])) ? htmlspecialchars($_GET['uname']) : "" ?>" placeholder="Enter Your Username">
					<?php if (isset($_GET['error_username'])) { ?>
						<div class="text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_username']); ?>
						</div>
					<?php } ?>
					<?php if (isset($_GET['error_username1'])) { ?>
						<div class="text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_username1']); ?>
						</div>
					<?php } ?>
				</div>

				<div class="mb-3 w-[300px]">
					<label class="block mb-2 text-sm font-medium text-white">Password</label>
					<input type="password" class="text-sm rounded-lg focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 placeholder:text-sm" name="pass" placeholder="*******">
					<?php if (isset($_GET['error_pass'])) { ?>
						<div class=" text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_pass']); ?>
						</div>
					<?php } ?>
				</div>
				<div class="flex flex-col w-[300px]">
					<button type="submit" class="btn w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign Up</button>
					<div class="inline-flex items-center justify-center w-full">
						<hr class="w-64 h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
					</div>
					<a href="login.php" class="btn w-full focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Login</a>
				</div>
			</form>
		</div>
	</div>
</body>

</html>