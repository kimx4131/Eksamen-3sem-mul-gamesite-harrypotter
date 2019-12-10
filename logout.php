<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Log out</title>
</head>
<body>
    <?php include 'inc/nav.php' ?>
    <?php include 'inc/db.php'?>

    <?php 
    session_destroy();
    //header('location:index.php');
    echo "<script>window.location.href='index.php';</script>";
    ?>

    <?php include 'inc/footer.php' ?>
    
</body>
</html>