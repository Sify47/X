<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	$logged = true;
	$user_id = $_SESSION['user_id'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home Page</title>
	<script src="tailwind.js"></script>
	<script src="js/alpine.js"></script>
	<script src="js/flowbite.js"></script>
	<script src="js/font.js"></script>
	<link rel="stylesheet" href="Profile/full.min.css">
	<link rel="stylesheet" href="Profile/daist.css">
</head>

<body>
	<?php
	include 'login.php';
	?>
</body>

</html>