<?php 
$servername ="localhost";
$username = "root";
$password = "root";
$db = "harrypottersite";
$rooturl = "http://localhost:8888/eksamensopgave/site/";

$conn = mysqli_connect($servername,$username,$password,$db);

if(mysqli_connect_errno()){
    echo "Connection failed: " + mysqli_connect_errno();
}

?>
