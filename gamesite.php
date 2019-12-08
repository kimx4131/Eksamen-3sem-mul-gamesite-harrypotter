<?php session_start(); ?>
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>Game site</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>
    
    <?php 
        //session_start();
        $username = $_SESSION['username'];
        if(isset($_SESSION['adgang'])){

            if($username == "Admin"){
                //header('location:'.$rooturl.'admin.php');
                echo "<script>window.location.href='admin.php';</script>";
            };
        
        } else{
            //header('location:'.$rooturl.'index.php');
            echo "<script>window.location.href='index.php';</script>";
        };

        //Indsætter scores ind i tabellen "games" hvis brugeren ønsker at gemme resultaterne
        if(isset($_POST['submit'])){
            $finalscore = mysqli_real_escape_string($conn, $_POST['finalscore']);
            $finallives = mysqli_real_escape_string($conn, $_POST['finallives']);
            $helpeddobby = mysqli_real_escape_string($conn, $_POST['helpeddobby']);
            $totalscore = mysqli_real_escape_string($conn, $_POST['totalscore']);
            $timeleft = mysqli_real_escape_string($conn, $_POST['timeleft']);

            $sql = "INSERT INTO games (`game_id`, `username`, `time`, `points`, `lives`, `score`, `dobby`, `timeleft`) 
                    VALUES (NULL, '$username', CURRENT_TIMESTAMP, '$finalscore', '$finallives', '$totalscore', '$helpeddobby', '$timeleft');";
            $result = mysqli_query($conn, $sql) or die("Query virker overhoved ikke - upload");
        };
    ?>

    <div class="container gamessite">
        <div class="row">
            <div class="col-12">
                <h1 id="mazename"></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <canvas id="canvas" class="maze" width="500" height="500"></canvas>

                <p id="gameover"></p>

                <button class="btn" id="startgame">Start the game</button>
                <p class="mobilonly"><span>The game can only be play on desktops/laptops.</span></p>

                <div id="gameresult">
                    <p>You got <span id="finalscore"></span> points</p>
                    <p>You have <span id="finallives"></span> lives back</p>
                    <p>You have helped dobby <span id="helpeddobby"></span> times</p>
                    <p>You have seconds <span id="timeleft"></span> left</p>
                    
                    <p class="totalscore">Your total score is <span id="totalscore"></span></p>

                    <p class="savescore">Do you want to save your score?</p>

                    <form id="submit-form" method="POST">
                        <input type="hidden" id="finalscore-db" name="finalscore">
                        <input type="hidden" id="finallives-db" name="finallives">
                        <input type="hidden" id="helpeddobby-db" name="helpeddobby">
                        <input type="hidden" id="totalscore-db" name="totalscore">
                        <input type="hidden" id="timeleft-db" name="timeleft">
                        <button class="btn" id="yes-btn" type="submit" value="submit" name="submit">Yes</button>
                        <a href="<?php echo $rooturl;?>gamesite.php" class="btn">No</a>
                    </form>
                </div>
                
            </div>

            <div class="col-lg-5">
                <p class="score-display">You have <span id="score"></span> points</p>
                <p class="score-display">You have <span id="lives"></span> lives</p>
                <p class="score-display">You have helped Dobby <span id="helped"></span> times</p>
                <p class="score-display">Time <span id="time-display"></span> seconds</p>
                
                <h3>Playingrules</h3>
                <ul>
                    <li>Find your way to Hogwarts to win</li>
                    <li>Collect galleons as points</li>
                    <li>Help Dobby to continue to the next lavel</li>
                    <li>Aviode the death eater to survive</li>
                </ul>
            </div>
        </div>
    </div>


    <?php include 'inc/footer.php' ?>

    <script src="js/maze.js"></script>
</body>
</html>