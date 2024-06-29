<?php

function ge($conn)
{
   $sql = "SELECT * FROM category_sug";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
      $data = $stmt->fetchAll();
      return $data;
   } else {
      return 0;
   }
}

// Get All 
function getAll($conn){
   $sql = "SELECT * FROM category";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if($stmt->rowCount() >= 1){
   	   $data = $stmt->fetchAll();
   	   return $data;
   }else {
   	 return 0;
   }
}
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

// getById
function getById($conn, $id){
   $sql = "SELECT * FROM category WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if($stmt->rowCount() >= 1){
         $data = $stmt->fetch();
         return $data;
   }else {
       return 0;
   }
}

// Delete By ID
function deleteById($conn, $id){
   $sql = "DELETE FROM category WHERE id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if($res){
   	   return 1;
   }else {
   	 return 0;
   }
}