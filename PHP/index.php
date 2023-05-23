<?php
session_start();

if(isset($_GET["so"])){
    if($_GET["so"] === "true"){
        session_destroy();
        session_abort();
        header("Location:index.php");
    }
} else{
    if(isset($_SESSION["user"])){
        header("Location:createTeams.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/index.css">
    <title>Home - PokeBuilding</title>
</head>
<body class="index-body">
    <header class="index-header">
        <div class="home-header">
        </div>
    </header>

    <div class="main-content-index">
        <h1 class="home-tittle">PokéBuilding</h1>
        <div class="home-text">
            <div class="home-text-box">A cool website to create your own teams and compare them with other!</div>
            <div class="home-text-box">Create an account or login to get started.</div>
        </div>
        <div class="home-options">
            <a href="checkLogin.php" class="home-button-1">LOGIN</a>
            <a href="checkRegister.php" class="home-button-2">REGISTER <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></a>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-options">
            <div class="youtube">
                <a href="youtube.com">YOUTUBE</a>
            </div>
            <div class="twitter">
                <a href="twitter.com">TWITTER</a>
            </div>
            <div class="instagram">
                <a href="instagram.com">INSTAGRAM</a>
            </div>
        </div>
    </footer>
</body>
</html>