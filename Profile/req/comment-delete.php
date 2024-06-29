<?php 
session_start();

if ( isset($_SESSION['username']) 
    && $_GET['comment_id']) {
  $post_id = $_POST['tweet_id'];
  $id = $_GET['comment_id'];
  


  include_once("Comment.php");
  include_once("../../db_conn.php");
  $res = deleteCommentById($conn, $id);
  $f = getCommentsByPostID1($conn,$id);
  $o = $f['post_id'];
  if ($res) {
      $sm = "Successfully deleted Comment!"; 
      header("Location: ../../blog.php?=success=$sm");
      exit;
  }else {
    $em = "Unknown error occurred"; 
    header("Location: ../Profile/profile.php?=&error=$em");
    exit;
  }

}else{
  header("Location: ../Profile/profile.php");
  exit;
}
