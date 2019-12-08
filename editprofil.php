<?php session_start(); ?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title> Edit Profil</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>

    <?php 
        $username = $_SESSION['username'];
        if(isset($_SESSION['adgang'])){
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $sql) or die("Query virker ikke");
            $user = mysqli_fetch_assoc($result); 
        
        } else{
            //header('location:'.$rooturl.'index.php');
            echo "<script>window.location.href='index.php';</script>";
        };

        $msgUsername = "";
        $msgemail = "";
        $msgephone = "";

        //Når der klikkes opdater til ændringerne
        if(isset($_POST['submit'])){
            $usernamenew = mysqli_real_escape_string($conn, $_POST['username']);
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

            $usernameUniq = true;
            $emailUniq = true;
            $phoneUniq = true;

            //Hvis det nye username ikke er det samme som det nye skal den tjekke i databasen
            if($username != $usernamenew){
                //Henter brugernavn for at se om brugernavnet er taget.
                $sql = "SELECT * FROM `users` WHERE username = '$usernamenew'";
                $result = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");

                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($result) == 1){
                    $usernameUniq = false;
                    $msgUsername ="Username is already in use.";
                };
            };

            //Tjekker om database emailen og den indtastede email er forskellige 
            if($user['email'] != $email){
                //Henter email for at se om emailen er taget.
                $sql = "SELECT * FROM `users` WHERE email = '$email'";
                $resultemail = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");

                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($resultemail) == 1){
                    $emailUniq = false;
                    $msgemail ="Email is already in use.";
                };
            };

            //Tjkker om telefonnummeret fra databasen er forskelligt med det indtastede
            if($user['phonenumber'] != $phonenumber){
                //Henter telefonnummer for at se om telefonnummeret er taget.
                $sql = "SELECT * FROM `users` WHERE phonenumber = '$phonenumber'";
                $resultphone = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");

                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($resultphone) == 1){
                    $phoneUniq = false;
                    $msgephone ="Phone number is already in use.";
                };
            };
            
            if($usernameUniq == true AND $emailUniq == true AND $phoneUniq == true){
                //Opdatere tabelen
                $sql = "UPDATE users SET username='$usernamenew', firstname='$firstname', lastname='$lastname', email='$email', phonenumber='$phonenumber', adresse='$adresse' WHERE username = '$username' ";

                //Opdatere games tabellen 
                $sqlgames = "UPDATE games SET username='$usernamenew' WHERE username = '$username' ";

                $usersconn = false;
                if(mysqli_query($conn, $sql)){
                    $usersconn = true;
                } else {
                    echo "ERROR sql " . mysqli_error($conn);
                };

                $gamesconn = false;
                if(mysqli_query($conn, $sqlgames)){
                    $gamesconn = true;
                } else {
                    echo "ERROR sqlgames " . mysqli_error($conn);
                };

                //Hvis bolianerne er sande
                if($usersconn == true AND $gamesconn == true){
                    
                    $_SESSION['username'] = $usernamenew;
                    //header('Location:'.$rooturl.'profil.php');
                    echo "<script>window.location.href='profil.php';</script>";
                };
            };
            
        };
    ?>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Edit Profile</h1>
                <p id="errormsg"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">            
                <form method="POST" onsubmit="return valchangeprofil()">
                    <div class="form-group">
                        <label>Username</label>
                        <?php 
                            //Kan ikke ændre brugernavn hvis det er Admin
                            if($username != "Admin"){
                                echo '
                                    <input type="text" class="form-control" name="username" id="username" value="'.$user['username'].'">
                                    <p><span>'.$msgUsername.'</span></p>
                                ';
                            } else {
                                echo '
                                    <input type="hidden" class="form-control" name="username" id="username" value="'.$user['username'].'">
                                    <p><span>Username can not be changed because the profil is the Admin profil</span></p>
                                ';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user['firstname'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user['lastname'] ?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>">
                        <p><span><?php echo $msgemail; ?></span></p>
                    </div>
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="number" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo $user['phonenumber'] ?>">
                        <p><span><?php echo $msgephone; ?></span></p>
                    </div>
                    <div class="form-group">
                        <label>adresse</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $user['adresse'] ?>">
                    </div>
                    
                    <a href="<?php echo $rooturl;?>profil.php" class="btn">Back</a>
                    <button type="submit" class="btn" name="submit">Submit</button>
                </form>
            </div>
        </div>

    <?php include 'inc/footer.php' ?>

    <script src="js/validation.js"></script>
</body>
</html>