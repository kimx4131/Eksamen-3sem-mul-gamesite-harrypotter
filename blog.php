<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Blog</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>

    <?php 
    $username = $_SESSION['username'];

    if(isset($_SESSION['adgang'])){
        $sql = "SELECT * FROM post ORDER BY time DESC";
        $result = mysqli_query($conn, $sql) or die("Query virker ikke");
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    } else{
        //header('location:index.php');
        echo "<script>window.location.href='index.php';</script>";
    }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-7">
                <h1>Blog</h1>
            </div>
            <div class="col-5 btn-right">
                <a href="blogpostadd.php" class="btn">Add post</a>
            </div>
        </div>

        <div class="row">
            <?php foreach($posts as $post): ?>
            <div class="col-md-6">
                <h3><?php echo $post['title']; ?></h3>
                <small><span>By <?php echo $post['username']; ?>, at <?php echo $post['time']; ?></span></small>
                <p class="blogshorttext"><?php echo $post['shorttext']; ?></p>
                <a href="blogpost.php?id=<?php echo $post['id_post'];?>" class="btn">Read more</a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
    
    
    <?php include 'inc/footer.php' ?>

</body>
</html>