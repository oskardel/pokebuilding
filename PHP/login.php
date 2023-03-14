<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Sign in - PokéBuilding</title>
</head>
<body>
<header>
        <div class="header-options">
            <div class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <div class="icon-text">PokéBuilding</div>
            </div>
        </div>
        <div class="header-login">
            <div class="sign-in"><a href="checkLogin.php">Sign in</a></div>
            <div class="sign-up"><a href="checkRegister.php">Sign up</a></div>
        </div>
    </header>
    
    <div class="main-content">
        <div class="form-login">
            <form action="" method="post">
                <input type="text" class="login-username" name="login-username" placeholder="Username">
                <?php
                    echo (isset($errorArray["userEmpty"])) ? "<div class='error-message'>$errorArray[userEmpty]</div>" : "";
                ?>
                <input type="password" class="login-password" name="login-password" placeholder="Password">
                <?php
                    echo (isset($errorArray["passwordEmpty"])) ? "<div class='error-message'>$errorArray[passwordEmpty]</div>" : "";
                ?>
                <input type="submit" class="submit-button" name="login-button" value="Sign in">

                <div class="message-login">Don't have an account?<a href="checkRegister.php">Sign up</a></div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-options">
            <div class="terms-conditions"><a href="terms_conditions.php">PRIVACY POLICY</a></div>
            <div class="about-us"><a href="about_us.php">ABOUT US</a></div>
        </div>

        <div class="social-media">
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