<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    if (
        isset($_FILES['avatar']) &&
        isset($_POST['bio']) &&
        isset($_POST['fname'])&&
        isset($_POST['avatar_url'])
        
    ) {
        include "../../db_conn.php";
        $bio = $_POST['bio'];
        $name = $_POST['fname'];
        $user_id = $_SESSION['user_id'];
        $avatar = $_FILES['avatar'];
        $cu = $_POST['avatar_url'];
    
        $user = $_POST['username'];
        if (empty($name)) {
            $em = "Name is required";
            header("Location: ../useedit.php?error=$em");
            exit;
        } else if (empty($bio)) {
            $em = "Bio is required";
            header("Location: ../useedit.php?error=$em");
            exit;
        }

        // $sql = "UPDATE users SET fname=? , bio=? , avatar=?  WHERE id=?";
        // $stmt = $conn->prepare($sql);
        // $res = $stmt->execute([$name, $bio, $imagename, $user_id]);
        // if ($res) {
        //     $sm = "Updated Successfully";
        //     header("Location: ../profile.php?success=$sm");
        //     exit;
        // } else {
        //     $em = "Unknown error occurred";
        //     header("Location: ../profile.php?error=$em");
        //     exit;
        // }

        $image_name = $_FILES['avatar']['name'];
        if ($image_name != "") {
            $image_size = $_FILES['avatar']['size'];
            $image_temp = $_FILES['avatar']['tmp_name'];
            $error = $_FILES['avatar']['error'];
            if ($error === 0) {
                if ($image_size > 1300000000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: ../profile.php");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');


                    if (in_array($image_ex, $allowed_exs)) {
                        $new_image_name = uniqid("avatar-", true) . '.' . $image_ex;
                        $image_path = '../../upload/Avatar/' . $new_image_name;
                        move_uploaded_file($image_temp, $image_path);

                        $sql = "UPDATE users SET fname=? , bio=? , avatar=?  WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$name, $bio, $new_image_name,  $user_id]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../profile.php?$em");
                        exit;
                    }
                }
            }
        } else {
            $sql = "UPDATE users SET fname=? , bio=?   WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $bio, $user_id]);
        }

        $image_name1 = $_FILES['cover']['name'];
        if ($image_name1 != "") {
            $image_size1 = $_FILES['cover']['size'];
            $image_temp1 = $_FILES['cover']['tmp_name'];
            $error1 = $_FILES['cover']['error'];
            if ($error1 === 0) {
                if ($image_size1 > 1300000000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: ../profile.php");
                    exit;
                } else {
                    $image_ex1 = pathinfo($image_name1, PATHINFO_EXTENSION);
                    $image_ex1 = strtolower($image_ex1);

                    $allowed_exs1 = array('jpg', 'jpeg', 'png');


                    if (in_array($image_ex1, $allowed_exs1)) {
                        $new_image_name1 = uniqid("cover-", true) . '.' . $image_ex1;
                        $image_path1 = '../../upload/Cover/' . $new_image_name1;
                        move_uploaded_file($image_temp1, $image_path1);

                        $sql = "UPDATE users SET fname=? , bio=? , cover=?  WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$name, $bio, $new_image_name1,  $user_id]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../profile.php?$em");
                        exit;
                    }
                }
            }
        } else {
            $sql = "UPDATE users SET fname=? , bio=?   WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $bio, $user_id]);
        }

        if ($res) {
            $sm = "Successfully Created!";
            header("Location: ../profile.php?$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: ../profile.php?$sm");
            exit;
        }
    } else {
        header("Location: ../profile.php");
        exit;
    }
} else {
    header("Location: ../../login.php");
    exit;
}








//         $image_name = $_FILES['avatar']['name'];

//         if ($cu != "default.jpg" && $image_name != "") {
//             $clocation = "../../upload/blog/" . $cu;

//             // delete the img
//             if (!unlink($clocation)) {
//             }
//         }

//         if ($image_name != "") {
//             $image_size = $_FILES['cover']['size'];
//             $image_temp = $_FILES['cover']['tmp_name'];
//             $error = $_FILES['cover']['error'];
//             if ($error === 0) {
//                 if ($image_size > 1300000000) {
//                     $em = "Sorry, your file is too large.";
//                     header("Location: ../profile.php?error=$em");
//                     exit;
//                 } else {
//                     $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
//                     $image_ex = strtolower($image_ex);

//                     $allowed_exs = array('jpg', 'jpeg', 'png');


//                     if (in_array($image_ex, $allowed_exs)) {
//                         $new_image_name = uniqid("AVATAAR-", true) . '.' . $image_ex;
//                         $image_path = '../../upload/blog/' . $new_image_name;
//                         move_uploaded_file($image_temp, $image_path);

//                         $sql = "UPDATE post SET fname=? ,avatar=? , bio=? WHERE id=?";
//                         $stmt = $conn->prepare($sql);
//                         $res = $stmt->execute([$name, $new_image_name, $bio, $user_id]);
//                     } else {
//                         $em = "You can't upload files of this type";
//                         header("Location: ../post-add.php?error=$em");
//                         exit;
//                     }
//                 }
//             }
//         } else {
//             $sql = "UPDATE post SET tweet=? ,username=? WHERE tweet_id=?";
//             $stmt = $conn->prepare($sql);
//             $res = $stmt->execute([$text, $user, $tweet_id]);
//         }

//     }
// }






// session_start();

// if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {



// if(isset($_POST['fname']) &&
// isset($_POST['bio'])){

// include "../../db_conn.php";

// $fname = $_POST['fname'];
// $bio = $_POST['bio'];
// $old_pp = $_POST['old_pp'];
// $id = $_SESSION['user_id'];

// if (empty($fname)) {
// $em = "Name is required";
// header("Location: ../profile.php?error=$em");
// exit;
// } else if (empty($bio)) {
// $em = "Bio is required";
// header("Location: ../profile.php?error=$em");
// exit;
// } else {

// if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {


// $img_name = $_FILES['pp']['name'];
// $tmp_name = $_FILES['pp']['tmp_name'];
// $error = $_FILES['pp']['error'];

// if($error === 0){
// $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
// $img_ex_to_lc = strtolower($img_ex);

// $allowed_exs = array('jpg', 'jpeg', 'png');
// if(in_array($img_ex_to_lc, $allowed_exs)){
// $new_img_name = uniqid($fname, true).'.'.$img_ex_to_lc;
// $img_upload_path = '../../upload/blog/'.$new_img_name;
// // Delete old profile pic
// $old_pp_des = "../../upload/blog/$old_pp";
// if(unlink($old_pp_des)){
// // just deleted
// move_uploaded_file($tmp_name, $img_upload_path);
// }else {
// // error or already deleted
// move_uploaded_file($tmp_name, $img_upload_path);
// }


// // update the Database
// $sql = "UPDATE users
// SET fname=?, bio=?, avatar=?
// WHERE id=?";
// $stmt = $conn->prepare($sql);
// $stmt->execute([$fname, $bio, $new_img_name, $id]);
// // $_SESSION['fname'] = $fname;
// header("Location: ../profile.php?success=Your account has been updated successfully1");
// exit;
// }else {
// $em = "You can't upload files of this type";
// header("Location: ../profile.php?error=$em");
// exit;
// }
// }else {
// $em = "unknown error occurred!";
// header("Location: ../profile.php?error=$em");
// exit;
// }


// }else {
// $sql = "UPDATE users
// SET fname=?, bio=?
// WHERE id=?";
// $stmt = $conn->prepare($sql);
// $stmt->execute([$fname, $bio, $id]);

// header("Location: ../profile.php?success=Your account has been updated successfully");
// exit;
// }
// }


// }else {
// header("Location: ../edit.php?error=error");
// exit;
// }


// }else {
// header("Location: login.php");
// exit;
// }