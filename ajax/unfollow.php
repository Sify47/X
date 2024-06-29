<?php

session_start();

if (
    isset($_SESSION['user_id'])  &&
    isset($_SESSION['username'])
) {

    include "../db_conn.php";
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['id'];
    $usern = $_POST['username'];

    $sql  = "DELETE FROM follow
		            WHERE user_id=? AND following_by=?";
    $stmt = $conn->prepare($sql);
    $res  = $stmt->execute([$post_id, $user_id]);
    if ($res) {
        $sm = "Successfully Created!";
        header("Location: ../Profile/profile-view.php?username=$usern&$sm");
        exit;
    } else {
        $em = "Unknown error occurred";
        header("Location: ../Profile/profile-view.php?username=$usern&$em");
        exit;
    }
} else {
    echo "...";
}
