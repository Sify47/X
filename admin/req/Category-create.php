<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_FILES['cover']) && isset($_POST['category'])){
      include "../../db_conn.php";
      $category = $_POST['category'];

      if(empty($category)){
         $em = "Category is required"; 
         header("Location: ../category-add.php?error=$em");
         exit;
      }


    $image_name = $_FILES['cover']['name'];
    if ($image_name != "") {
      $image_size = $_FILES['cover']['size'];
      $image_temp = $_FILES['cover']['tmp_name'];
      $error = $_FILES['cover']['error'];
      if ($error === 0) {
        if ($image_size > 1300000) {
          $em = "Sorry, your file is too large.";
          header("Location: ../category-add.php?error=$em");
          exit;
        } else {
          $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
          $image_ex = strtolower($image_ex);

          $allowed_exs = array('jpg', 'jpeg', 'png');


          if (in_array($image_ex, $allowed_exs)) {
            $new_image_name = uniqid("Category_cover-", true) . '.' . $image_ex;
            $image_path = '../../upload/category/' . $new_image_name;
            move_uploaded_file($image_temp, $image_path);

            $sql = "INSERT INTO category(category , cover) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$category, $new_image_name]);
          } else {
            $em = "You can't upload files of this type";
            header("Location: ../category-add.php?error=$em");
            exit;
          }
        }
      }
    } else {
      $sql = "INSERT INTO category(category) VALUES (?)";
      $stmt = $conn->prepare($sql);
      $res = $stmt->execute([$category]);
    }

     if ($res) {
          $sm = "Successfully Created!"; 
          header("Location: ../category-add.php?success=$sm");
          exit;
      }else {
        $em = "Unknown error occurred"; 
        header("Location: ../category-add.php?error=$em");
        exit;
      }


    }else {
        header("Location: ../category-add.php");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 