<?php session_start(); ?>
<?php include 'inc/db.php'?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Blog</title>
</head>
<body>
    <?php include 'inc/nav.php' ?>

    <?php 
    $username = $_SESSION['username'];

    if(isset($_SESSION['adgang'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM post WHERE id_post = $id";
        $result = mysqli_query($conn, $sql);
        $post = mysqli_fetch_assoc($result);
    
    } else{
        //header('location:'.$rooturl.'index.php');
        echo "<script>window.location.href='index.php';</script>";
    }

    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $shorttext = mysqli_real_escape_string($conn, $_POST['shorttext']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);

        //Opdatere tabelen
        $sql = "UPDATE post SET title='$title', shorttext='$shorttext', text='$text' WHERE id_post = '$id'";

        $postconn = false;
        if(mysqli_query($conn, $sql)){
            $postconn = true;
        } else {
            echo "ERROR sql " . mysqli_error($conn);
        };

        if($postconn == true){
            echo "<script>window.location.href='".$rooturl."blogpost.php?id=".$id."';</script>";
        }
    }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Edit post</h1>
            </div>
        </div>
        
        <form method="POST">
            <div class="row">
                <div class="col-12">
                    <h2><input name="title" id="title" type="text" maxlength="40" value="<?php echo $post['title']; ?>" placeholder="Title"></h2>
                    <p id="titleoutput"></p>

                    <small><span>By <?php echo $post['username']; ?>, at <?php echo $post['time']; ?></span></small>
                   
                    <textarea name="shorttext" id="shorttext" class="postshorttext" maxlength="200" placeholder="Short text"><?php echo $post['shorttext']; ?></textarea>
                    <p id="shorttextoutput"></p>

                    <textarea name="text" id="text" class="posttext" maxlength="2000" placeholder="Text"><?php echo $post['text']; ?></textarea>
                    <p id="textoutput"></p> 

                    <a href="<?php echo $rooturl;?>blogpost.php?id=<?php echo $post['id_post'];?>" class="btn">Back</a>
                    <button name="submit" class="btn" type="submit">Submit</button>
                </div>
            </div>
        </form>
        
    </div>
    
    
    <?php include 'inc/footer.php' ?>

    <script src="js/inputfelt.js"></script>

</body>
</html>