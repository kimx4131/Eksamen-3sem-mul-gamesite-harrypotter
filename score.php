<?php session_start(); ?>
<!DOCTYPE html> 
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
        $btnyourscore = "";
        $username = $_SESSION['username'];
        if(isset($_SESSION['adgang'])){
            //Henter 10 rækker af brugerens data og sortere dem med den højeste score hørst
            $sqlgame = "SELECT * FROM games WHERE username = '$username' ORDER BY score DESC LIMIT 10";
            $resultgame = mysqli_query($conn, $sqlgame) or die("Query virker ikke");
            $games = mysqli_fetch_all($resultgame, MYSQLI_ASSOC); 

            //Henter 10 rækker af alle data og sortere dem med den højeste score hørst
            $sqlgameall = "SELECT * FROM games ORDER BY score DESC LIMIT 10";
            $resultgameall = mysqli_query($conn, $sqlgameall) or die("Query virker ikke");
            $gamesall = mysqli_fetch_all($resultgameall, MYSQLI_ASSOC); 

            if($username == 'Admin'){
                $btnyourscore = "";
            }else{
                $btnyourscore = '
                <div class="btn-switch">
                    <button class="btn-topscore" id="btn-topscore">Top 10 scores</button>
                    <button class="btn-yourscore" id="btn-yourscore">Your top 10 scores</button>
                </div>
                ';
            };
        
        } else{
            //header('location:index.php');
            echo "<script>window.location.href='index.php';</script>";
        };
    ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-8">
                <h1>Scores</h1>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-4 contentmove">
                <?php echo $btnyourscore; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="topscore">
                <h3>Top 10 scores</h3>
                <table>
                    <tr>
                        <td>Total score</td>
                        <td class="desktoponly">Points</td>
                        <td class="desktoponly">lives</td>
                        <td class="desktoponly">Dobby</td>
                        <td class="desktoponly">Time left</td>
                        <td>Username</td>
                    </tr>
                    <?php foreach($gamesall as $gameall): ?>
                        <tr>
                            <td><?php echo $gameall['score']; ?></td>
                            <td class="desktoponly"><?php echo $gameall['points']; ?></td>
                            <td class="desktoponly"><?php echo $gameall['lives']; ?></td>
                            <td class="desktoponly"><?php echo $gameall['dobby']; ?></td>
                            <td class="desktoponly"><?php echo $gameall['timeleft']; ?> Seconds</td>
                            <td><?php echo $gameall['username']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="col-12" id="yourscore">
                <h3>Your top 10 scores</h3>
                <table>
                    <tr>
                        <td>Total score</td>
                        <td class="desktoponly">Points</td>
                        <td class="desktoponly">lives</td>
                        <td class="desktoponly">Dobby</td>
                        <td class="desktoponly">Time left</td>
                        <td>Time</td>
                    </tr>
                    <?php foreach($games as $game): ?>
                        <tr>
                            <td><?php echo $game['score']; ?></td>
                            <td class="desktoponly"><?php echo $game['points']; ?></td>
                            <td class="desktoponly"><?php echo $game['lives']; ?></td>
                            <td class="desktoponly"><?php echo $game['dobby']; ?></td>
                            <td class="desktoponly"><?php echo $game['timeleft']; ?> Seconds</td>
                            <td><?php echo $game['time']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <?php include 'inc/footer.php' ?>

    <script src="js/switchbtn.js"> </script>

</body>
</html>