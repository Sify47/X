<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['category']) && isset($_POST['id'])){
      include "../../db_conn.php";
      $category = $_POST['category'];
      $id = $_POST['id'];
    $cu = $_POST['cover_url'];

      if(empty($category)){
         $em = "Category is required"; 
         header("Location: ../category-edit.php?error=$em&id=$id");
         exit;
      }
    $image_name = $_FILES['cover']['name'];


    if ($image_name != "") {
      $image_size = $_FILES['cover']['size'];
      $image_temp = $_FILES['cover']['tmp_name'];
      $error = $_FILES['cover']['error'];
      if ($error === 0) {
        if ($image_size > 13000000) {
          $em = "Sorry, your file is too large.";
          header("Location: ../category-edit.php?error=$em&id=$id");
          exit;
        } else {
          $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
          $image_ex = strtolower($image_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');


          if (in_array($image_ex, $allowed_exs)) {
            $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
            $image_path = '../../upload/category/' . $new_image_name;
            move_uploaded_file($image_temp, $image_path);

            $sql = "UPDATE category SET category=? ,cover=?  WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$category, $new_image_name, $id]);
          } else {
            $em = "You can't upload files of this type";
            header("Location: ../category-edit.php?error=$em&id=$id");
            exit;
          }
        }
      }
    
      $sql = "UPDATE category SET category=? WHERE id=?";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$category, $id]);
    
      
     if ($res) {
          $sm = "Successfully edited!"; 
          header("Location: ../category-edit.php?success=$sm&category=$category&id=$id");
          exit;
      }else {
        $em = "Unknown error occurred"; 
        header("Location: ../category-edit.php?error=$em&id=$id");
        exit;
      }


    }else {
        header("Location: ../category-edit.php");
        exit;
    }

  }
}else {
    header("Location: ../admin-login.php");
    exit;
}