<?php session_start(); ?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title> Edit Profil</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php'?>

    <?php 
        //session_start();
        $username = $_SESSION['username'];
        if(isset($_SESSION['adgang'])){
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql) or die("Query virker ikke");
            $user = mysqli_fetch_assoc($result); 

        } else{
            //header('location:'.$rooturl.'index.php');
            echo "<script>window.location.href='index.php';</script>";
        };

        //Bolian til at tjekke passwordet med databasen
        $passwordmatch = false;

        //Når der klikkes på slet
        if(isset($_POST['submit'])){
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $salt = "ldfjldjf34lksdf4kle" . $password . "dkj2fldsjljf34elk";
            $hashed = hash('sha512', $salt);

            //Hvis det instatede password matcher med databasen
            if($user['password'] == $hashed){
                //Henter navnet på den bruger som skal slettes og sletter fra 'users'
                $deleteuser = mysqli_real_escape_string($conn, $_POST['deleteuser']);
                $sql = "DELETE FROM users WHERE username = '$deleteuser'";

                //Sletter de gemte resultater
                $sqlgames = "DELETE FROM games WHERE username = '$deleteuser'";

                // Fobindelse til at slette bruger
                $usersconn = false;
                if(mysqli_query($conn, $sql)){
                    $usersconn = true;
                } else {
                    echo "ERROR sql " . mysqli_error($conn);
                };

                //Forbindelse til at slette game resultater
                $gamesconn = false;
                if(mysqli_query($conn, $sqlgames)){
                    $gamesconn = true;
                } else {
                    echo "ERROR sqlgames " . mysqli_error($conn);
                };

                //Hvis bolianerne er sande
                if($usersconn == true AND $gamesconn == true){
                    //header('Location:'.$rooturl.'index.php');
                    echo "<script>window.location.href='index.php';</script>";
                    session_destroy();
                };
            }; 
        };
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Delete Profile</h1>
                <p><span>All you information and your game results will be <b>permanently</b> delete.</span></p>
                <p>Enter your password to delete your profile.</p>
                <p><?php echo $user['username']; ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <form method="POST">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                    </div>
                    <a href="<?php echo $rooturl;?>profil.php" class="btn">Back</a>
                    <input type="hidden" name="deleteuser" value="<?php echo $user['username'];?>">
                    <button type="submit" class="btn" name="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php' ?>

</body>
</html>