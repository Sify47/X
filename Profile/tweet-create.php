<?php
session_start();
$userid = $_SESSION['username'];
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    if(
        isset($_FILES['cover']) &&
        isset($_POST['category']) &&
        isset($_POST['tweet'])
    ) {
        include_once("User.php");
        include_once("../db_conn.php");
        $users = get($conn, $userid);
        $fname = $users['fname'];
        $text = $_POST['tweet'];
        $userid = $_SESSION['username'];
        $category = $_POST['category'];

        if (empty($text)) {
            $em = "Tweet is required";
            header("Location: tweet-add.php?error=$em");
            exit;
        } else if (empty($category)) {
            $category = 0;
        }

        $image_name = $_FILES['cover']['name'];
        if ($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
            if ($error === 0) {
                if ($image_size > 1300000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: tweet-add.php?error=$em");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');


                    if (in_array($image_ex, $allowed_exs)) {
                        $new_image_name = uniqid("COVER-", true) . '.' . $image_ex;
                        $image_path = '../upload/blog/' . $new_image_name;
                        move_uploaded_file($image_temp, $image_path);

                        $sql = "INSERT INTO post(tweet,category, cover_url, username , fname) VALUES (?,?,?,?,?)";
                        $stmt = $conn->prepare($sql);
                        $res = $stmt->execute([$text, $category, $new_image_name, $userid, $fname]);
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: tweet-add.php?error=$em");
                        exit;
                    }
                }
            }
        } else {
            $sql = "INSERT INTO post(tweet, category, username , fname) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$text, $category, $userid, $fname]);
        }

        if ($res) {
            $sm = "You Create Tweet Successfully";
            header("Location: ../blog.php?success=$sm");
            exit;
        } else {
            $em = "Unknown error occurred";
            header("Location: tweet-add.php?error=$em");
            exit;
        }
    } else {
        header("Location: tweet-add.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
