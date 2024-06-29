<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
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
			<svg viewBox="0 0 24 24" aria-hidden="true" class="tet-[#264eca] text-white w-[360px]" fill="currentColor">
				<g>
					<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
				</g>
			</svg>
			<form class="w-[400px]" action="php/login.php" method="post">

				<h4 class="text-[50px] text-white">Happening Now</h4><br>
				<h4 class="text-2xl text-white">Join Today.</h4><br>


				<div class="mb-3 w-[300px]">
					<label class="block mb-2 text-sm font-medium text-white">Username</label>
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
							<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
							</svg>
						</span>
						<input type="text" class="rounded-r-lg rounded-rb-lg text-sm focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5" name="uname" value="<?php echo (isset($_GET['uname'])) ? htmlspecialchars($_GET['uname']) : "" ?>" placeholder="Enter Your Username">
					</div>
					<?php if (isset($_GET['error_uname'])) { ?>
						<div class="text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_uname']); ?>
						</div>
					<?php } ?>
					<?php if (isset($_GET['erroruser'])) { ?>
						<div class="text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['erroruser']); ?>
						</div>
					<?php } ?>

				</div>

				<div class="mb-3 w-[300px]">
					<label class="block mb-2 text-sm font-medium text-white">Password</label>
					<div class="flex">
						<span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
							<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
								<path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
							</svg>
						</span>
						<input type="password" class="rounded-r-lg rounded-rb-lg text-sm focus:ring-blue-900 focus:border-blue-900 block w-full p-2.5 placeholder:text-sm" name="pass" placeholder="*******">
					</div>
					<?php if (isset($_GET['error_pass'])) { ?>
						<div class=" text-sm text-red-600 dark:text-red-500 pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['error_pass']); ?>
						</div>
					<?php } ?>
					<?php if (isset($_GET['errorpass'])) { ?>
						<div class=" text-sm text-red-600 dark:text-red-500  pl-3 mt-1 mb-4 text-[18px] w-[300px] rounded-md">
							<?php echo htmlspecialchars($_GET['errorpass']); ?>
						</div>
					<?php } ?>
				</div>

				<div class="flex flex-col w-[300px]">
					<button type="submit" class="btn w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Login</button>
					<div class="inline-flex items-center justify-center w-full">
						<hr class="w-64 h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
					</div>
					<a href="admin-login.php" class="btn w-full focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Admin Login</a>
					<div class="mt-3 w-[300px]">
						<h1 class="text-xl text-white mb-3">Dont't have account?</h1>
						<a href="signup.php" class="btn text-gray-900 hover:text-white border w-full border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Create Account</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>

</html>