<?php

function getid($conn, $id)
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
function get($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetch();
        return $data;
    } else {
        return 0;
    }
}

function g($conn, $userid)
{
    $sql = "SELECT avatar FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userid]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchColumn();
        return $data;
    } else {
        return 0;
    }
}
function h($conn, $userid)
{
    $sql = "SELECT avatar FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userid]);

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchColumn();
        return $data;
    } else {
        return 0;
    }
}

function getAlll($conn)
{
    $sql = "SELECT id, fname, username , avatar FROM users ORDER BY cr_tweet DESC LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $data = $stmt->fetchAll();
        return $data;
    } else {
        return 0;
    }
}
// Get All USERS
function getAlluser($conn)
{
    $sql = "SELECT fname FROM users";
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
function deleteByIduser($conn, $id)
{
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);

    if ($res) {
        return 1;
    } else {
        return 0;
    }
}
