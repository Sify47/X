<?php

if (isset($key) && $key == "hhdsfs1263z") {
	include_once("../db_conn.php");
	include_once("data/Category.php");
	$t = total($conn);
?>

	<!-- <script src="../tailwind.js"></script> -->
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name">X
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<div class="flex align-center main-profile-link">
			<div>
				<i class="fa fa-user" aria-hidden="true"></i>&nbsp;
				<span>@<?php echo $_SESSION['username']; ?></span>
			</div>
		</div>
	</header>
	<style>

	</style>
	<div class="body">
		<nav class="side-bar w-[300px] ">

			<ul id="navList">
				<li>
					<a href="Users.php">
						<i class="fa fa-users" aria-hidden="true"></i>
						<span class="e">Users</span>
					</a>
				</li>
				<li>
					<a href="tweet.php">
						<i class="fa fa-wpforms" aria-hidden="true"></i>
						<span>Tweet</span>
					</a>
				</li>
				<li>
					<a href="Category.php">
						<i class="fa fa-window-restore" aria-hidden="true"></i>
						<span>Category</span>

					</a>
				</li>
				<li>
					<a href="Category_sug.php">
						<i class="fa fa-window-restore" aria-hidden="true"></i>
						<span>Category Suggestion</span>
						<span class="inline-flex items-center justify-center w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
							<?= $t ?>
						</span>
					</a>
				</li>
				<li>
					<a href="Comment.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Comment</span>
					</a>
				</li>
				<li>
					<a href="../logout.php">
						<i class="fa fa-power-off" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		</nav>
		<section class="section-1">

		<?php
	}
		?>