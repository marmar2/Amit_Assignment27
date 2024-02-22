<?php session_start() ?>
<?php include "../config.php"?>
<?php include "../header.php"?>
<?php include "../navbar.php"?>

<?php
$post_id = $_GET['post'];
$stmt = $connect->prepare("SELECT *  FROM `posts`  WHERE `id`= ? ");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

echo "<pre>";
print_r($post);
echo "</pre>";
?>


<div class="container">
  <form action="update.php" method="POST">
    <input type="hidden" value="<?= $post['id'] ?>" name="postid">
     <div class="mb-3">
       <label  class="form-label">Write you post here</label>
       <textarea class="form-control"  rows="3" name="content">
         <?= $post['content'] ?>
       </textarea>
     </div>
  
     <button type="submit" class="btn btn-dark">Update</button>
     </form>
</div>

<?php include "../footer.php"?>