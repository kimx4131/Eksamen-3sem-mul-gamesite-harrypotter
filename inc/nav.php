<?php 
    //session_start();
    $navet = "";
    $navto = "";
    $url = "";
    $admin = "";

    if(isset($_SESSION['adgang'])){
        include 'inc/db.php';
        $username = $_SESSION['username'];

        $url = $rooturl."gamesite.php";

        if($username == 'Admin'){
            $admin = '
                <li class="nav-item">
                    <a class="nav-link" href="'.$rooturl.'admin.php">Admin</a>
                </li>
            ';
        } else {
            $admin = '
                <li class="nav-item">
                    <a class="nav-link" href="'.$rooturl.'gamesite.php">Game</a>
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
                    <a class="nav-link" href="'.$rooturl.'score.php">Score</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="'.$rooturl.'profil.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="'.$rooturl.'blog.php">Blog</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="'.$rooturl.'logout.php">Log out</a>
                </li>
            </ul>
        </div>
        ';
    } else {
        $url = $rooturl."index.php";
    };

?>


<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="<?php echo $url; ?>"><img src="<?php echo $rooturl ?>img/logo.png" alt="Logo"></a>
    <?php echo $navet; ?>
    <?php echo $admin; ?>
    <?php echo $navto; ?>
</nav>
