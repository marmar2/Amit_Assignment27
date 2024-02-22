<?php session_start() ?>
<?php include "../config.php"?>
<?php include "../header.php"?>
<?php include "../navbar.php"?>

<?php


 $post_id = $_GET['post'];
 $stmt = $connect->prepare("DELETE  FROM  `comments`  WHERE  `post_id` =? ");
 $stmt->execute([$post_id]);
 $stmtt = $connect->prepare("DELETE FROM `posts` WHERE `id`=? ");
 $stmtt->execute([$post_id]);

// $post_id = $_GET['post'];
// $stmt = $connect->prepare("DELETE `posts`,`comments` FROM `posts` INNER JOIN `comments` WHERE `posts`.`id`=?  ");
// $stmt->execute([$post_id]);

$_SESSION['status'] = "Post Deleted successfully";


header("location:../home.php");

// echo "<pre>";
// print_r($post);
// echo "</pre>";
?>



<?php include "../footer.php"?>