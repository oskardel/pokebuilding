<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Forgot password? - PokéBuilding</title>
</head>
<body>
    <header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
        </div>
        <div class="header-login">
            <a href="checkLogin.php" class="sign-in">Sign in</a>
            <a href="checkRegister.php" class="sign-up">Sign up</a>
        </div>
    </header>
    
    <div class="main-content">
        <div class="form-forgot">
            <form action="" method="post">
            <?php 
                if(isset($_SESSION["status"])) {
                ?>
                    <div class="alert-message">
                        <h5><?php echo $_SESSION["status"] ?></h5>
                    </div>
                    <?php
                    unset($_SESSION["status"]);
                }
            ?>
                <div class="form-name">
                    <input type="text" class="forgot-email" name="forgot-email" value="<?php if (isset($_REQUEST['forgot-email'])) echo $_POST['forgot-email']; ?>">
                    <span class="floating-label">Enter your email address</span>
                </div>

                <input type="submit" class="submit-button" name="forgot-button" value="Reset password">

                <div class="message-login">Already have an account? <a href="checkLogin.php" class="link-login">Sign in</a></div>
            </form>
        </div>
    </div>

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