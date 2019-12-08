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
        //Tekst til fejl beskeder
        $mailwrong ="";
        $passwordwrong="";
        $msgUsername="";
        $msgemail="";
        $msgephone="";

        if(isset($_POST['submit'])){
            //Renser for elementer som f.eks. SQL angrab og henter informtioner
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
            $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $emailrepeat = mysqli_real_escape_string($conn, $_POST['emailrepeat']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $passwordrepeat = mysqli_real_escape_string($conn, $_POST['passwordrepeat']);

            //bolian til validering
            $flagEmail = false;
            $flagPassword = false;
            $usernameUniq = true;
            $emailUniq = true;
            $phoneUniq = true;

            //Tjekker at emailen er ens
            if($email == $emailrepeat){
                $flagEmail = true;
            } else{
                $mailwrong = "The email is not the same.";
            };

            //Tjekker at password er ens
            if($password == $passwordrepeat){
                $flagPassword = true;
            } else{
                $passwordwrong ="The password is not the same.";
            };

            //Henter brugernavn for at se om brugernavnet er taget.
            $sql = "SELECT * FROM `users` WHERE username = '$username'";
            $resultusername = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");
                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($resultusername) == 1){
                    $usernameUniq = false;
                    $msgUsername ="Username is already in use. <br>";
                };

            //Henter email for at se om emailen er taget.
            $sql = "SELECT * FROM `users` WHERE email = '$email'";
            $resultemail = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");
                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($resultemail) == 1){
                    $emailUniq = false;
                    $msgemail ="Email is already in use. <br>";
                };

            //Henter telefonnummer for at se om telefonnummeret er taget.
            $sql = "SELECT * FROM `users` WHERE phonenumber = '$phonenumber'";
            $resultphone = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");
                //Tjekker om brugernavnet er unikt 
                if(mysqli_num_rows($resultphone) == 1){
                    $phoneUniq = false;
                    $msgephone ="Phone number is already in use. <br>";
                };

            //Hvis alle bolianer er sande
            if($flagEmail == true AND $flagPassword == true AND $usernameUniq == true AND $emailUniq == true AND $phoneUniq == true){
                //Salter og haser passwordet
                $salt = "ldfjldjf34lksdf4kle" . $password . "dkj2fldsjljf34elk";
                $hashed = hash('sha512', $salt);

                //Indsættes i databasen
                $sql = "INSERT INTO users (`user_id`, `firstname`, `lastname`, `adresse`, `phonenumber`, `username`, `email`, `password`) VALUES (NULL, '$firstname', '$lastname', '$adresse', '$phonenumber', '$username', '$email', '$hashed');";
                $result = mysqli_query($conn, $sql) or die("Query virker overhoved ikke - upload");

                //starter en session
                session_start();
                $_SESSION['adgang'] = 'adgang';
                $_SESSION['username'] = $username;
                //header('location:'.$rooturl.'gamesite.php');
                echo "<script>window.location.href='gamesite.php';</script>";
            };
        };
    ?>

    
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="jumbotron">
                    <div class="container">
                        <h1>Create an Acount</h1>
                        <p><span><?php echo "$mailwrong $passwordwrong $msgUsername $msgemail $msgephone" ?></span></p>
                        <p id="errormsg"></p>
                        <form method="POST" id="validation" onsubmit="return valreg()">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>First name <span>*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter first name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last name <span>*</span></label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="enter last name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Adresse <span>*</span></label>
                                        <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Enter adresse" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number <span>*</span></label>
                                        <input type="number" class="form-control" name="phonenumber" id="phonenumber" placeholder="Enter phone number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>User name <span>*</span></label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter user name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email address <span>*</span></label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Repeat email address <span>*</span></label>
                                        <input type="email" class="form-control" name="emailrepeat" id="emailrepeat" placeholder="Repeat email"  required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password <span>*</span></label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Repeat password <span>*</span></label>
                                        <input type="password" class="form-control" name="passwordrepeat" id="passwordrepeat" placeholder="Repeat password" required>
                                    </div>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn" name="submit" id="subbutton">Submit</button>
                        </form>
                        <p><a href="<?php echo $rooturl;?>index.php">I have an acount</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php' ?>

    <script src="js/validation.js"></script>

</body>
</html>