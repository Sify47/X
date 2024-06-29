<?php
function se($conn, $sug, $new_image_name){
   $sql = "INSERT INTO category(category , cover) VALUES (?,?)";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$sug, $new_image_name]);
}

function total($conn)
{
   $sql = "SELECT COUNT(Cat) FROM category_sug";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   if ($stmt->rowCount() >= 1) {
      $data = $stmt->fetchColumn();
      return $data;
   } else {
      return 0;
   }
   // print_r($stmt->fetchColumn());
}

function deleteBy($conn, $id)
{
   $sql = "DELETE FROM category_sug WHERE id=?";
   $stmt = $conn->prepare($sql);
   $res = $stmt->execute([$id]);

   if ($res) {
      return 1;
   } else {
      return 0;
   }
}

function gesug($conn)
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