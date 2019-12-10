<?php 
$servername ="localhost";
$username = "root";
$password = "root";
$db = "harrypottersite";


$conn = mysqli_connect($servername,$username,$password,$db);

if(mysqli_connect_errno()){
    echo "Connection failed: " + mysqli_connect_errno();
}

?>
