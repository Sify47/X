<?php 
session_start();

if(isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include "../db_conn.php";

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=".$uname;
    
    if(empty($uname)){
    	$em = "User Name is required";
    	header("Location: ../login.php?error_uname=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../login.php?error_pass=$em&$data");
	    exit;
    }else {

    	$sql = "SELECT * FROM users WHERE username = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$uname]);

      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();

          $username =  $user['username'];
          $password =  $user['password'];
          $fname =  $user['fname'];
          $id =  $user['id'];
          if($username === $uname){
             if(password_verify($pass, $password)){
                 $_SESSION['user_id'] = $id;
                 $_SESSION['username'] = $username;

                 header("Location: ../blog.php");
                 exit;
             }else {
               $em = "Incorect Password";
               header("Location: ../login.php?errorpass=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect User Name ";
            header("Location: ../login.php?erroruser=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect User Name ";
         header("Location: ../login.php?erroruser=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../login.php?error=error");
	exit;
}
