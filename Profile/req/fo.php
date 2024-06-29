<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    if (
        isset($_POST['sug']) &&
        isset($_FILES['cover'])
        
    ) {
        include "../../db_conn.php";
        $sug = $_POST['sug'];
        $user_id = $_SESSION['user_id'];
        $user = $_SESSION['username'];
        if (empty($sug)) {
            $em = "Suggestion is required";
            header("Location: ../../Category_sugg.php?error=$em");
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
                    header("Location: ../../Category_sugg.php?error=$em");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');


                    if (in_array($image_ex, $allowed_exs)) {
                        $new_image_name = uniqid("Category_cover-", true) . '.' . $image_ex;
                        $image_path = '../../upload/category/' . $new_image_name;
                        move_uploaded_file($image_temp, $image_path);

                        $sql = "INSERT INTO category_sug(cat , cover , user_id) VALUES (?,?,?)";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$sug, $new_image_name,$user_id]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../../Category_sugg.php?error=$em");
                        exit;
                    }
                }
            }
        } else {
            $sql = "INSERT INTO category_sug(cat, user_id) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$sug, $user_id]);
        }

        
        if ($res) {
            $sm = "Suggestion is Sent To Admin Successfully";
            header("Location: ../../Category_sugg.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: ../../Category_sugg.php?error=$em");
            exit;
        }
    }
}