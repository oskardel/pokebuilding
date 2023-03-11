<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Home - PokeBuilding</title>
</head>
<body>
    <!-- HEADER -->
    <?php
        session_start();
        if(isset($_SESSION["user"])){ 
    ?>
    <header>
        <div class="header-options">
            <div class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <div class="icon-text">PokéBuilding</div>
            </div>
            <div class="create-team"><a href="create_team.php">Create Teams</a></div>
            <div class="create-team"><a href="create_team.php">Battle</a></div>
        </div>
        <div class="header-login">
            <div class="welcome-message"><?php echo "Welcome, ".$user ?></div>
            <img src='<?php echo "lo que sea" ?>' alt="pfp_icon">
        </div>
    </header>
    <?php
        } else{ 
    ?>
    <header>
        <div class="header-options">
            <div class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <div class="icon-text">PokéBuilding</div>
            </div>
        </div>
        <div class="header-login">
            <div class="sign-in"><a href="login.php">Sign in</a></div>
            <div class="sign-up"><a href="reister.php">Sign up</a></div>
        </div>
    </header>
    <?php } ?>

    <!-- BODY -->
    <div class="main-content">
        <div class="home-tittle">PokéBuilding</div>
        <div class="home-cards">
            <div class="tutorial-card">
                <div class="tutorial-card-tittle">TUTORIAL</div>
                <div class="tutorial-card-content">Create your own Pokémon teams to fight against other. 
                    With PokéBuilding you will be able to fight up to 6vs6 Pokémon, creating your own Pokémon teams. 
                    You can remove, edit and create up to 5 teams per user. 
                    <a href="register.php">Create an account</a> or <a href="login.php">log in</a> to get started!</div>
            </div>

            <div class="teams-card">
                <div class="teams-card-tittle">TEAMS</div>
                <div class="teams-card-content">When registered you will be able to create teams choosing your favorite teams. 
                    Each team will have a maximum of 6 Pokémon with different attacks each. 
                    You will be able to search Pokémon manually in a list or order by type. 
                    You can also create team with random Pokémon and random attacks!</div>
            </div>

            <div class="battle-card">
                <div class="battle-card-tittle">BATTLE</div>
                <div class="battle-card-content">Once created at least one team, you are able to engage in battle other team you have created. 
                    You can also fight against a random team!</div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-options">
            <div class="terms-conditions"><a href="terms_conditions.php">Terms and conditions</a></div>
            <div class="about-us"><a href="about_us.php">About us</a></div>
        </div>

        <div class="social-media">
            <div class="youtube">
                <a href="youtube.com"><img src="../img/youtube-logo.png" alt="youtube-logo"></a>
            </div>
            <div class="twitter">
                <a href="twitter.com"><img src="../img/twitter-logo.png" alt="twitter-logo"></a>
            </div>
            <div class="instagram">
                <a href="instagram.com"><img src="../img/insta-logo.png" alt="insta-logo"></a>
            </div>
        </div>
    </footer>
</body>
</html>