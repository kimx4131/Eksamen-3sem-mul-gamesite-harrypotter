<?php session_start(); ?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Registrer</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>

    <?php 
        $username = $_SESSION['username'];
        if(isset($_SESSION['adgang'])){

            if($username == 'Admin'){
                $id = mysqli_real_escape_string($conn, $_GET['id']);

                $sql = "SELECT * FROM users WHERE user_id = $id";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_assoc($result);

            } else {
                //header('location:'.$rooturl.'gamesite.php');
                echo "<script>window.location.href='gamesite.php';</script>";
            };
            
        } else{
            //header('location:'.$rooturl.'index.php');
            echo "<script>window.location.href='index.php';</script>";
        };

        $passworderror = "";
        if(isset($_POST['submit'])){
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $salt = "ldfjldjf34lksdf4kle" . $password . "dkj2fldsjljf34elk";
            $hashed = hash('sha512', $salt);

            //Henter admins informationer for at tjekke admin password
            $sql = "SELECT * FROM `users` WHERE username = '$username'";
            $result = mysqli_query($conn, $sql) or die("Query virker ikke");
            $admin = mysqli_fetch_assoc($result);

            //Når der klikkes på subtmit tjekkes admin passwordet
            if($admin['password'] == $hashed){
                $deleteuser = mysqli_real_escape_string($conn, $_POST['deleteuser']);

                //Userprofile
                $sql = "DELETE FROM users WHERE username = '$deleteuser'";

                // Fobindelse til at slette bruger
                $usersconn = false;
                if(mysqli_query($conn, $sql)){
                    $usersconn = true;
                } else {
                    echo "ERROR sql " . mysqli_error($conn);
                };

                //Sletter de gemte resultater
                $sqlgames = "DELETE FROM games WHERE username = '$deleteuser'";

                //Forbindelse til at slette game resultater
                $gamesconn = false;
                if(mysqli_query($conn, $sqlgames)){
                    $gamesconn = true;
                } else {
                    echo "ERROR sqlgames " . mysqli_error($conn);
                };

                //Hvis bolianerne er sande
                if($usersconn == true AND $gamesconn == true){
                    //header('Location:'.$rooturl.'admin.php');
                    echo "<script>window.location.href='admin.php';</script>";
                };

            } else {
                $passworderror = "Password is incorrect";
            };
        };
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Delete user:</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p>Username: <span><?php echo $user['username'];?></span></p>
                <p>First name: <span><?php echo $user['firstname'];?></span></p>
                <p>Last name: <span><?php echo $user['lastname'];?></span></p>
                <p>E-mail: <span><?php echo $user['email'];?></span></p>
                <p>Phone number: <span><?php echo $user['phonenumber'];?></span></p>
                <p>Adresse: <span><?php echo $user['adresse'];?></span></p>
                <p><a href="<?php echo $rooturl;?>admin.php" class="btn">Back</a></p>
            </div>
            <div class="col-md-6">
                <p><span>All information and all game results will be <b>permanently</b> delete.</span></p>
                <p><span><?php echo $passworderror; ?></span></p>
                <form method="POST">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <input type="hidden" name="deleteuser" value="<?php echo $user['username'];?>">
                        <button type="submit" class="btn" name="submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php' ?>

</body>
</html>