<?php
session_start();

if (
    isset($_SESSION['admin_id']) && isset($_SESSION['username'])
) {
    $sug = $_POST['sug'];
    $id = $_POST['id'];

    // $img = $_POST['cover'];

    // include_once("data/Post.php");
    include_once("../data/Category.php");
    include_once("../../db_conn.php");
    // $res = se($conn, $sug, $img);
    $res2 = deleteBy($conn, $id);
    if ($res2) {
        $sm = "Successfully Delete!";
        header("Location: ../Category_sug.php?success=$sm");
        exit;
    } else {
        $sm = "Error!";
        header("Location: Category_sug.php?error=$sm");
        exit;
    }
} else {
    header("Location: ../admin-login.php");
    exit;
}
