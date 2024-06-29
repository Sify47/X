<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {
	# check if the key is submitted
	if (isset($_POST['key'])) {
		# database connection file
		include '../../../db_conn.php';

		# creating simple search algorithm :) 
		$key = "%{$_POST['key']}%";

		$sql = "SELECT * FROM users
	           WHERE username
	           LIKE ? OR fname LIKE ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$key, $key]);

		if ($stmt->rowCount() > 0) {
			$users = $stmt->fetchAll();

			foreach ($users as $user) {
				if ($user['id'] == $_SESSION['user_id']) continue;
?>
				<li class="list-group-item">
					<a href="chat.php?user=<?= $user['username'] ?>" class="flex
		          justify-between
		          items-center p-2">
						<div class="flex
			            items-center">

							<!-- <img src="../../../upload/Avatar/user-default.png"> -->
							

							<h3 class="text-2xl font-semibold m-2 hover:underline hover:text-white ">
								<?= $user['fname'] ?> @<?= $user['username']?>
							</h3>
						</div>
					</a>
				</li>
			<?php }
		} else { ?>
			<div class="alert alert-info 
    				 text-center">
				<i class="fa fa-user-times d-block fs-big"></i>
				The user "<?= htmlspecialchars($_POST['key']) ?>"
				is not found.
			</div>
<?php }
	}
} else {
	header("Location: ../../index.php");
	exit;
}