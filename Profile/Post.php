<?php

// $notFound = 0;

// Get All
    function totaltweet($conn , $userid){
        $sql = "SELECT COUNT(tweet_id) FROM post WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userid]);
        if ($stmt->rowCount() >= 1) {
            $data = $stmt->fetchColumn();
            return $data;
        } else {
            return 0;
        }
        // print_r($stmt->fetchColumn());
    }
// Get All 
function getAll1($conn,$username)
{
    $sql = "SELECT * FROM post WHERE username=? ORDER BY tweet_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
function getAll2($conn, $username,$id)
{
    $sql = "SELECT * FROM post WHERE username=? and tweet_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username,$id]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}

function getAll($conn)
{
    $sql = "SELECT * FROM post ORDER BY tweet_id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
    // getAllDeep admin
    function getAllDeep($conn)
    {
    $sql = "SELECT * FROM post";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetchAll();
    return $data;
    } else {
    return 0;
    }
    }
    // getAllPostsByCategory
    function getAllPostsByCategory($conn, $category_id)
    {
    $sql = "SELECT * FROM post WHERE category=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category_id]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetchAll();
    return $data;
    } else {
    return 0;
    }
    }
    // getById
    function getById($conn,$id)
    {
    $sql = "SELECT * FROM post
    WHERE tweet_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetch();
    return $data;
    } else {
    return 0;
    }
    }
    // getById Deep - Admin
    function getByIdDeep($conn, $id)
    {
    $sql = "SELECT * FROM post WHERE tweet_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetch();
    return $data;
    } else {
    return 0;
    }
    }

    // serach
    function serach($conn, $key)
    {
    # creating simple search temple :)
    $key = "%{$key}%";

    $sql = "SELECT * FROM post
    WHERE tweet LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetchAll();
    return $data;
    } else {
    return 0;
    }
    }
    // getCategoryById
    function getCategoryById($conn, $id)
    {
    $sql = "SELECT * FROM category WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetch();
    return $data;
    } else {
    return 0;
    }
    }

    //get 5 Categoies

    function get3Categoies($conn)
    {
    $sql = "SELECT * FROM category LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetchAll();
    return $data;
    } else {
    return 0;
    }
    }



    function getUserByID($conn, $id)
    {
    $sql = "SELECT * FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetch();
    return $data;
    } else {
    return 0;
    }
    }

    // getAllCategories
    function getAllCategories($conn)
    {
    $sql = "SELECT * FROM category ORDER BY category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
    $data = $stmt->fetchAll();
    return $data;
    } else {
    return 0;
    }
    }

    // Delete By ID
    function deleteById($conn, $id)
    {
    $sql = "DELETE FROM post WHERE tweet_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if ($res) {
    return 1;
    } else {
    return 0;
    }
}