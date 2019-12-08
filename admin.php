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
        if(isset($_SESSION['adgang'])){
            $username = $_SESSION['username'];

            if($username == "Admin"){
                $sql = "SELECT * FROM users WHERE username != 'Admin' ORDER BY username DESC";
                $result = mysqli_query($conn, $sql) or die("Query virker ikke");
                $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

            } else {
                //header('location:'.$rooturl.'gamesite.php');
                echo "<script>window.location.href='gamesite.php';</script>";
            };

        } else{
            //header('location:'.$rooturl.'index.php');
            echo "<script>window.location.href='index.php';</script>";
        };
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>All Profiles</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table>
                    <tr>
                        <td>Username</td>
                        <td class="desktoponly">Name</td>
                        <td>E-mail</td>
                        <td class="desktoponly">Phone number</td>
                        <td>Delete</td>
                    </tr>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user['username']; ?></td>
                            <td class="desktoponly"><?php echo $user['firstname'] . " " . $user['lastname']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td class="desktoponly"><?php echo $user['phonenumber']; ?></td>
                            <td><a href="<?php echo $rooturl;?>admindelete.php?id=<?php echo $user['user_id'];?>" class="btn admin">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php' ?>


</body>
</html>