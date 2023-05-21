<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Sign in - PokéBuilding</title>
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
        <div class="form-login">
            <form action="" method="post">
                <?php 
                    session_start();
                    if(isset($_GET["login"])) {
                        ?>
                        <div class="alert-message">
                            <h5><?php echo $_GET["login"]; ?></h5>
                        </div>
                        <?php
                        unset($_SESSION["status"]);
                    }
                ?>
                <div class="form-name">
                    <input type="text" class="login-username" name="login-username" value="<?php if (isset($_REQUEST['login-username'])) echo $_POST['login-username']; ?>">
                    <span class="floating-label">Username</span>
                </div>

                <a href="checkPassword.php" class="link-login forgot-pass">Forgot password?</a>

                <div class="form-password">
                    <input type="password" class="login-password" name="login-password">
                    <span class="floating-label">Password</span>
                </div>

                <input type="submit" class="submit-button" name="login-button" value="Sign in">

                <div class="message-login">Don't have an account? <a href="checkRegister.php" class="link-login">Sign up</a></div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-options">
            <div class="terms-conditions"><a href="terms_conditions.php">PRIVACY POLICY</a></div>
            <div class="about-us"><a href="about_us.php">ABOUT US</a></div>
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