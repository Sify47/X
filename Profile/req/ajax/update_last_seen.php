<?php  

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {
	
	# database connection file
	include '../../../db_conn.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['user_id'];

	$sql = "UPDATE users
	        SET lastseen = NOW() 
	        WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

}else {
	header("Location: ../../blog.php");
	exit;
}