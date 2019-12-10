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
    
    } else{
        //header('location:index.php');
        echo "<script>window.location.href='index.php';</script>";
    }

    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $shorttext = mysqli_real_escape_string($conn, $_POST['shorttext']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);

        //Indsættes i databasen
        $sql = "INSERT INTO post (`id_post`, `title`, `username`, `time`, `shorttext`, `text`) VALUES (NULL, '$title', '$username', CURRENT_TIMESTAMP, '$shorttext', '$text');";
        $result = mysqli_query($conn, $sql) or die("Query virker overhoved ikke - upload");

        $sqlid = "SELECT * FROM post WHERE title = '$title'";
        $resultid = mysqli_query($conn, $sqlid) or die("Query virker ikke");
        $post = mysqli_fetch_assoc($resultid); 
        $id = $post['id_post'];

        echo "<script>window.location.href='blogpost.php?id=".$id."';</script>";

    }

    ?>

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h1>Add post</h1>
            </div>
        </div>
        
        <form method="POST">
            <div class="row">
                <div class="col-12">
                    <h2><input name="title" id="title" type="text" maxlength="40" placeholder="Title"></h2>
                    <p id="titleoutput"></p>
                   
                    <textarea name="shorttext" id="shorttext" class="postshorttext" maxlength="200" placeholder="Short text"></textarea>
                    <p id="shorttextoutput"></p>

                    <textarea name="text" id="text" class="posttext" maxlength="2000" placeholder="Text"></textarea>
                    <p id="textoutput"></p> 

                    <a href="blog.php" class="btn">Back</a>
                    <button name="submit" class="btn" type="submit">Submit</button>
                </div>
            </div>
        </form>
        

    </div>
    
    
    <?php include 'inc/footer.php' ?>

    <script src="js/feltpost.js"></script>

</body>
</html>