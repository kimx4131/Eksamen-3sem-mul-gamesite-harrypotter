<?php 
    //session_start();
    $navet = "";
    $navto = "";
    $url = "";
    $admin = "";

    if(isset($_SESSION['adgang'])){
        include 'inc/db.php';
        $username = $_SESSION['username'];

        $url = "gamesite.php";

        if($username == 'Admin'){
            $admin = '
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
            ';
        } else {
            $admin = '
                <li class="nav-item">
                    <a class="nav-link" href="gamesite.php">Game</a>
                </li>
            ';
        }

        $navet = '
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
        ';

        
        $navto = '
                <li class="nav-item">
                    <a class="nav-link" href="score.php">Score</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
        ';
    } else {
        $url = "index.php";
    };

?>


<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="<?php echo $url; ?>"><img src="img/logo.png" alt="Logo"></a>
    <?php echo $navet; ?>
    <?php echo $admin; ?>
    <?php echo $navto; ?>
</nav>
