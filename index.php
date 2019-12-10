<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Log On</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>
    <?php 
        //Variable til fejl meddelelse 
        $logonerror="";

        //Når der klikkes på logind 
        if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            //Salter og haser password
            $salt = "ldfjldjf34lksdf4kle" . $password . "dkj2fldsjljf34elk";
            $hashed = hash('sha512', $salt);

            $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$hashed'";
            $result = mysqli_query($conn, $sql) or die ("Query virker ikke " . $sql);

            if(mysqli_num_rows($result) == 1){
                session_start();
                $_SESSION['adgang'] = 'adgang';
                $_SESSION['username'] = $username;

                if($username == "Admin"){
                    //header('location:admin.php');
                    echo "<script>window.location.href='admin.php';</script>";
                }else{
                    //header('location:gamesite.php'); 
                    echo "<script>window.location.href='gamesite.php';</script>";
                };

            } else {
                $logonerror = "Wrong login";
            };
        };  
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 ml-auto mr-auto">
                <div class="jumbotron">
                    <div class="container">
                        <h1>Log On</h1>
                        <p>Log in to play browsergames.</p>
                        <p><span><?php echo $logonerror ?></span></p>
                        <form method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn" name="submit">Submit</button>
                        </form>
                        <p><a href="registrer.php">Create acount</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php include 'inc/footer.php' ?>


    <script>
    window.onload = function() {
        let audio = new Audio('sound/intro.mp3');
        audio.play();
    };
    </script>


</body>
</html>