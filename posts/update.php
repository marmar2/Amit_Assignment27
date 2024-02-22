<?php

session_start();

include "../config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $contentt = $_POST['content'];
  $postID = $_POST['postid'];
  $pst = $connect->prepare(" UPDATE `posts` SET content =? WHERE `id`=?") ;
  $pst->execute([$contentt,$postID]);
  header("location:../home.php");
}


?>