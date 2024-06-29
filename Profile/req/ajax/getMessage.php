<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {

	if (isset($_POST['id_2'])) {

		# database connection file
		include '../../../db_conn.php';
		include '../../User.php';

		$id_1  = $_SESSION['user_id'];
		$id_2  = $_POST['id_2'];
		$opend = 0;
		$chatWith = getid($conn, $id_2);

		$sql = "SELECT * FROM chats
	        WHERE to_id=?
	        AND   from_id= ?
	        ORDER BY chat_id ASC";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$id_1, $id_2]);

		if ($stmt->rowCount() > 0) {
			$chats = $stmt->fetchAll();

			# looping through the chats
			foreach ($chats as $chat) {
				if ($chat['opened'] == 0) {

					$opened = 1;
					$chat_id = $chat['chat_id'];

					$sql2 = "UPDATE chats
	    		         SET opened = ?
	    		         WHERE chat_id = ?";
					$stmt2 = $conn->prepare($sql2);
					$stmt2->execute([$opened, $chat_id]);

?>
					<div class="flex justify-start items-end">
						<img src="../upload/Avatar/<?= $chatWith['avatar'] ?>" class="inline-block h-10 w-10 rounded-full mr-1">
						<div class="flex items-center border rounded-lg my-2 p-2.5">
							<p class="text-left ml-1">
								<?= $chat['message'] ?>
								<small class="block">
									<?= $chat['created_at'] ?>
								</small>
							</p>
						</div>
					</div>
<?php
				}
			}
		}
	}
} else {
	header("Location: ../../index.php");
	exit;
}
