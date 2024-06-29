<?php  

session_start();

if (isset($_SESSION['user_id'])  && 
	isset($_SESSION['username'])){
    
    include "../db_conn.php";
	$user_id = $_SESSION['user_id'];
	$userid = $_POST['id'];
	$usern = $_POST['username'];
	if (empty($userid)) {
		echo "...";
	}else {
		
            $sql  = "INSERT INTO follow(following_by, user_id) VALUES(?,?)";
		    $stmt = $conn->prepare($sql);
		    $res  = $stmt->execute([$user_id, $userid]);
	}
	if ($res) {
		$sm = "You Follow Successfully";
		header("Location: ../Profile/profile-view.php?username=$usern&$sm");
		exit;
	} else {
		$em = "You Follow This Profile";
		header("Location: ../Profile/profile-view.php?username=$usern&$em");
		exit;
	}
	
    

}else {
	header("Location: ../Profile/profile-view.php ");
	exit;
}