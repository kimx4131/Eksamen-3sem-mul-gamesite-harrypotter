<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
    <?php include 'inc/head.php' ?>

    <title>policy</title>
</head>
<body>
    <?php include 'inc/db.php'?>
    <?php include 'inc/nav.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Personal data processing</h1>
                <p>This website is a school project.</p>
                <p>All informations will only be used in this school project.</p>
                <p>You can always log on to your profil and delete your informations, or send a e-mail to <a href="mailto:kim@kragesand.dk?subject=delete%20informations">kim@kragesand.dk</a>. Alle your information will be deleted and can not be recovered.</p>
                <p>You can see all cookies and change or withdraw your consent in the cookie section below</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Coockiepolicy</h2>
                <script id="CookieDeclaration" src="https://consent.cookiebot.com/ba72c034-5499-403d-b93b-9937789a402b/cd.js" type="text/javascript" async></script>
            </div>
        </div>
    </div>
    
    <?php include 'inc/footer.php' ?>

</body>
</html>