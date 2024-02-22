<?php session_start() ?>

<?php include "config.php" ?>
<?php include "header.php" ?>
<?php include "navbar.php" ?>


<?php
$pst = $connect->prepare("SELECT posts.*  , users.name FROM `posts`  INNER JOIN `users` ON posts.user_id = users.id WHERE `status`= 'active' ");
$pst->execute();
$posts = $pst->fetchAll();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['content'] = $_POST['content'];
}

// if( !empty( $_SESSION['status'] )) {
//     echo "<script>alert($_SESSION['status']);</script>";
//     unset($_SESSION['status']);
// }


// echo "<pre>";
// print_r($posts);
// echo "</pre>";
// 
?>

<div class="container">

    <a href="posts/create.php" class="btn btn-dark mt-3">Create Post</a>
    
      <?php if( !empty( $_SESSION['status'] )) : ?> 

        <div class="alert alert-success alert-dismissible mt-3">
             <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
             <strong>Success!</strong> <?= $_SESSION['status'] ?>
        </div>

        <?php unset($_SESSION['status']) ?>
    
      <?php endif  ?>  
    
    <?php foreach ($posts as $post) : ?>

        <div class="card my-3 w-75 p-3" >

            <?php if ($_SESSION['userid'] === $post['user_id']) :  ?>

                

                <div class="dropdown" >
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="posts/edit.php?post=<?= $post['id'] ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you Sure you want to Delete The below post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" href="posts/delete.php?post=<?= $post['id'] ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif  ?>

            <div class="card-body" name='content'>
                <?= $post['content'] ?>
            </div>

            <div>
                Created By : <?= $post['name'] ?><br>
                Created on: <?= $post['created_at'] ?><br>
            </div>
        </div>
    <?php endforeach ?>
</div>



<?php include "footer.php" ?>