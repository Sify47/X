<?php

// Get All USERS
function getAllusers($conn){
   $sql = "SELECT * FROM users";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if($stmt->rowCount() >= 1){
   	   $data = $stmt->fetchAll();
   	   return $data;
   }else {
   	 return 0;
   }
}

function totaltweet($conn, $username)
{
   $sql = "SELECT COUNT(tweet) FROM post WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$username]);
   if ($stmt->rowCount() >= 1) {
      $data = $stmt->fetchColumn();
      return $data;
   } else {
      return 0;
   }
   // print_r($stmt->fetchColumn());
}



function get($conn, $userid)
{
   $sql = "SELECT username FROM users WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$userid]);

   if ($stmt->rowCount() >= 1) {
      $data = $stmt->fetchColumn();
      return $data;
   } else {
      return 0;
   }
}


// Delete By ID
function delleteById($conn, $id){
   $sql = "DELETE FROM users WHERE id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
   	   return 1;
   }else {
   	 return 0;
   }
}