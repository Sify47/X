<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $tweet_id = $_POST['tweet_id'];
    if (
        isset($_POST['category']) &&
        isset($_FILES['cover']) &&
        isset($_POST['tweet'])  &&
        isset($_POST['tweet_id']) &&
        isset($_POST['cover_url'])
    ) {
        include "../../db_conn.php";
        // $title = $_POST['title'];
        $text = $_POST['tweet'];
        $tweet_id = $_POST['tweet_id'];
        $user = $_POST['username'];
        $cu = $_POST['cover_url'];
        $cato = $_POST['category'];

        if (empty($text)) {
            $em = "Tweet is required";
            header("Location: ../tweet-edit.php?error=$em&tweet_id=$tweet_id");
            exit;
        }

        $image_name = $_FILES['cover']['name'];

        if ($cu != "default.jpg" && $image_name != "") {
            $clocation = "../../upload/blog/" . $cu;

            // delete the img
            if (!unlink($clocation)) {
            }
        }

        if ($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
            if ($error === 0) {
                if ($image_size > 13000000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: ../profile.php?error=$em&post_id=$tweet_id");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');


                    if (in_array($image_ex, $allowed_exs)) {
                        $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
                        $image_path = '../../upload/blog/' . $new_image_name;
                        move_uploaded_file($image_temp, $image_path);

                        $sql = "UPDATE post SET tweet=? ,cover_url=? , username=? , category=? WHERE tweet_id=?";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$text, $new_image_name, $user, $cato , $tweet_id]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: ../tweet-edit.php?error=$em&tweet_id=$tweet_id");
                        exit;
                    }
                }
            }
        } else {
            $sql = "UPDATE post SET tweet=? ,username=? ,category=? WHERE tweet_id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$text, $user, $cato , $tweet_id]);
        }

        if ($res) {
            $sm = "Edit Tweet Successfully";
            header("Location: ../tweet-view.php?success=$sm&tweet_id=$tweet_id");
            exit;
        } else {
            $em = "Edit Tweet Error";
            header("Location: ../tweet-view.php?error=$em&tweet_id=$tweet_id");
            exit;
        }
    } else {
        header("Location: ../profile");
        exit;
    }
} else {
    header("Location: ../../login.php");
    exit;
}
