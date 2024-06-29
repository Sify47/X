<?php 

if(isset($_POST['fname']) && 
   isset($_POST['uname']) && 
   isset($_POST['pass'])){
	// $message = '';
    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "fname=".$fname."&uname=".$uname;
	// $check_query = "
	// SELECT * FROM users 
	// WHERE username = :username
	// ";
	// $statement = $conn->prepare($check_query);
	// $check_data = array(
	// 	':username'		=>	$uname
	// );
	// if ($statement->execute($check_data)) {
	// 	if ($statement->rowCount() > 0) {
	// 		$message .= '<p><label>Username already taken</label></p>';
	// 	}
	// }
	// if ()
	// $sql1 = "SELECT * FROM users";
	// $stmt1 = $conn->prepare($sql1);
	// $stmt1->execute();
	// if ($stmt1->rowCount() >= 1) {
	// 	$data1 = $stmt1->fetchAll();
	// 	return $data1;
	// } else {
	// 	return 0;
	// }
	// if($stmt1 == $uname){
	// 	header("Location: ../signup.php?error=error");
	// 	exit;
	// }
    if (empty($fname)) {
    	$em = "Full name is required";
    	header("Location: ../signup.php?error_fname=$em&$data");
	    exit;
    }else if(empty($uname)){
    	$em = "User name is required";
    	header("Location: ../signup.php?error_username=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../signup.php?error_pass=$em&$data");
	    exit;
    }
	$sql_u = "SELECT * FROM users WHERE username=?";
	$res_u = $conn->prepare($sql_u);
	$res_u->execute([$uname]);
	if ($res_u->rowCount() >= 1) {
		$data = $res_u->fetchAll();
		$error = "This Username Is Taken";
		header("Location: ../signup.php?error_username1=$error");
		exit;
		// return $data;
	}else {
		

    	// hashing the password
    	$pass = password_hash($pass, PASSWORD_DEFAULT);

    	$sql = "INSERT INTO users(fname, username, password) 
    	        VALUES(?,?,?)";
    	
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$fname, $uname, $pass]);
    	

    	header("Location: ../signup.php?success=Your account has been created successfully");
	    exit;
    }


}else {
	header("Location: ../signup.php?error=error");
	exit;
}
