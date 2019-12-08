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

        //Viser slet og rediger knap hvis post brugeren og logind brugeren er den samme
        $postbutton ="";
        if($username == $post['username'] OR $username == "Admin"){
            $postbutton = '
            <a href="'.$rooturl.'blogpostedit.php?id='.$id.'" class="btn">Edit</a>
            <button type="submit" name="delete" class="btn">Delete</button>
            ';
        }

        //Henter kommentarerne 
        $sqlcomments = "SELECT * FROM comments WHERE id_post = '$id' ORDER BY time DESC";
        $resultcomments = mysqli_query($conn, $sqlcomments);
        $comments = mysqli_fetch_all($resultcomments, MYSQLI_ASSOC);
    
    } else{
        //header('location:'.$rooturl.'index.php');
        echo "<script>window.location.href='index.php';</script>";
    }

    //Sletter posten 
    if(isset($_POST['delete'])){
        //Slet post
        $sql = "DELETE FROM post WHERE id_post = '$id'";
            // Fobindelse til at slette bruger
            $postconn = false;
            if(mysqli_query($conn, $sql)){
                $postconn = true;
            } else {
                echo "ERROR sql " . mysqli_error($conn);
            };

        //slet kommentarerne
        $sql = "DELETE FROM comments WHERE id_post = '$id'";
            // Fobindelse til at slette bruger
            $commentconn = false;
            if(mysqli_query($conn, $sql)){
                $commentconn = true;
            } else {
                echo "ERROR sql " . mysqli_error($conn);
            };

        echo "<script>window.location.href='blog.php';</script>";
    } 

    //Gemmer kommentar til tabellen
    if(isset($_POST['comment'])){
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $text = mysqli_real_escape_string($conn, $_POST['text']);

        //Indsættes i databasen
        $sql = "INSERT INTO comments (`id_comment`, `title`, `username`, `time`, `text`, `id_post`) VALUES (NULL, '$title', '$username', CURRENT_TIMESTAMP, '$text', '$id');";
        $result = mysqli_query($conn, $sql) or die("Query virker overhoved ikke - upload");

        echo "<script>window.location.href='".$rooturl."blogpost.php?id=".$id."';</script>";
    }

    //Sletter kommentar
    if(isset($_POST['deletecomment'])){
        $commentid = mysqli_real_escape_string($conn, $_POST['commentid']);

        //slet kommentarerne
        $sql = "DELETE FROM comments WHERE id_comment = '$commentid'";
            // Fobindelse til at slette bruger
            $commentconn = false;
            if(mysqli_query($conn, $sql)){
                $commentconn = true;
            } else {
                echo "ERROR sql " . mysqli_error($conn);
            };

        echo "<script>window.location.href='".$rooturl."blogpost.php?id=".$id."';</script>";
    }

    ?>

    <div class="container">
        <!-- POST -->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-9">
                        <h1><?php echo $post['title']; ?></h1>
                        <small><span>By <?php echo $post['username']; ?>, at <?php echo $post['time']; ?></span></small>
                    </div>
                    <div class="col-md-3 right-align">
                        <form method="POST" class="btn-right">
                            <a href="<?php echo $rooturl;?>blog.php" class="btn">Back</a>
                            <?php echo $postbutton ?>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="postrubrik"><?php echo $post['shorttext']; ?></p>
                    </div>
                </div>
                <p class="columns2" id="columns2"><?php echo $post['text']; ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 id="commentheading">Comments</h3>
            </div>
        </div>

        <div class="row commentarea">
            <!-- SE KOMMENTAER -->
            <div class="col-md-6">
                <?php foreach($comments as $comment): ?>
                <form method="POST">
                    <p class="commenttitle"><?php echo $comment['title']; ?></p>
                        <div class="row">
                            <div class="col-8">
                                <small><span>By <?php echo $comment['username']; ?>, at <?php echo $comment['time']; ?></span></small>
                            </div>
                            <div class="col-4">
                                <?php if($username == $comment['username'] OR $username == "Admin"){
                                    echo '<button name="deletecomment" class="btncomment">Delete</button>';
                                    } else {
                                        echo '<a href="mailto:kim@kragesand.dk?subject=Report%20comment%20(comment%20id%20'.$comment['id_comment'].')&amp;body=I%20would%20like%20to%20report%20comment:%20'.$comment['title'].' (Id '.$comment['id_comment'].')%0d%0aPlease%20comment%20why:" class="report">Report comment</a>';
                                    }?>
                            </div>
                        </div>
                    <p><?php echo $comment['text']; ?></p>
                    <input type="hidden" name="commentid" value="<?php echo $comment['id_comment'] ?>">
                    
                </form>
                <?php endforeach; ?>
            </div>

            <!-- SKRIV EN KOMMENTAR -->
            <div class="col-md-6">
                <p class="writecomment">Write a comment</p>
                <form method="POST">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" id="title" maxlength="40">
                        <p id="titleoutput"></p>
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea name="text" id="textcomment" class="postshorttext" maxlength="250" rows="5"></textarea>
                        <p id="textoutputcomment"></p>
                    </div>
                    <button type="submit" name="comment" class="btn">Comment</button>
                </form>
            </div>
        </div>

    </div>
    
    
    <?php include 'inc/footer.php' ?>

    <script src="js/inputfelt.js"></script>

</body>
</html> 