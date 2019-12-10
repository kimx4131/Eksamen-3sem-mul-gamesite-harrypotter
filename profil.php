<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Profil</title>
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

        if($username == "Admin"){
            $urldelete = '';
        } else {
            $urldelete = '<a href="deleteprofil.php" class="btn">Delete</a>';
        };
    
    } else{
        //header('location:index.php');
        echo "<script>window.location.href='index.php';</script>";
    }


    //Tekst og bolian til opdatering af password
    $passwordchangemsg = "";
    $oldpasswordmatch = false;
    $passwordmatch = false;

    //Opdate password
    if(isset($_POST['submit'])){
        $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
        $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $newpasswordrepeat = mysqli_real_escape_string($conn, $_POST['newpasswordrepeat']);

        //salter og hasher det gamle indtastede password så det kan tjekkes med det i databasen
        $salt = "ldfjldjf34lksdf4kle" . $oldpassword . "dkj2fldsjljf34elk";
        $hashed = hash('sha512', $salt);

        //Tjekker om passwordet passer med det i databasen
        $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$hashed'";
        $result = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");

            if(mysqli_num_rows($result) == 1){
                $oldpasswordmatch = true;
            } 

        //Passer de to nye passwords
        if($newpassword == $newpasswordrepeat){
            $passwordmatch = true;
        }

        //Hvis boolianerne er sande 
        if($oldpasswordmatch == true AND $passwordmatch == true){
            //salter og hasher det nye password inden det opdateres i databasen
            $salt = "ldfjldjf34lksdf4kle" . $newpassword . "dkj2fldsjljf34elk";
            $hashed = hash('sha512', $salt);
            $sql = "UPDATE users SET password='$hashed' WHERE username = '$username'";

            if(mysqli_query($conn, $sql)){
                $passwordchangemsg = "You password has ben changed";
            } else {
                echo "ERROR " . mysqli_error($conn);
            }
        } else {
            $passwordchangemsg = "Your password is not correct or the new password do not match ";
        }

    }

    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Profile</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p>Username: <span><?php echo $user['username']; ?></span></p>
                <div class="row">
                    <div class="col-md-5"><p>First name: <span><?php echo $user['firstname'];?></p></span></div>
                    <div class="col-md-5"><p>First name: <span><?php echo $user['lastname']; ?></p></span></div>
                </div>
                <p>E-mail: <span><?php echo $user['email']; ?></span></p>
                <p>Phone number: <span><?php echo $user['phonenumber']; ?></span></p>
                <p>Adresse: <span><?php echo $user['adresse']; ?></span></p>
                <a href="editprofil.php" class="btn">Edit</a>
                <?php echo $urldelete; ?>

            </div>
            <div class="col-md-6">
                <h3>Change Password</h3>
                <p><span><?php echo $passwordchangemsg; ?></span></p>
                <p id="errormsg"></p>
                <form method="POST" onsubmit="return valchangepass()">
                    <div class="form-group">
                        <label>Old password <span>*</span></label>
                        <input type="password" class="form-control" name="oldpassword" placeholder="Old password" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New passwod <span>*</span></label>
                                <input type="password" class="form-control" name="newpassword" id="password" placeholder="New password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$" title="You need at least one lowercase and uppercase letter and a number." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Repeat new password <span>*</span></label>
                                <input type="password" class="form-control" name="newpasswordrepeat" id="passwordrepeat" placeholder="Repeat password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,}$" title="You need at least one lowercase and uppercase letter and a number." required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php' ?>

    <script src="js/validation.js"></script>
</body>
</html>