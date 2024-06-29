<?php
session_start();

if (
    isset($_SESSION['admin_id']) && isset($_SESSION['username'])
) {
    $sug = $_POST['sug'];
    $id = $_POST['id'];
    $id2 = $_POST['id2'];
    $img = $_POST['cover'];

    // include_once("data/Post.php");
    include_once("data/Category.php");
    include_once("../db_conn.php");
    $res = se($conn,$sug , $img);
    $res2 = deleteBy($conn , $id2);
    if ($res) {
        $sm = "Error!";
        header("Location: Category.php?error=$em");
        exit;
    } else {
        $sm = "Successfully Created!";
        header("Location: Category.php?success=$sm");
        exit;
    }
} else {
    header("Location: ../admin-login.php");
    exit;
}
