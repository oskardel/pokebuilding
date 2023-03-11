<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - PokéBuilding</title>
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
            <div class="sign-in"><a href="login.php">Sign in</a></div>
            <div class="sign-up"><a href="reister.php">Sign up</a></div>
        </div>
    </header>

    <div class="main-content">
        <div class="register-form">
            <form action="" method="post">
            <input type="text" class="register-email" name="register-email" placeholder="Email">
            <?php
                echo (isset($errorArray["emailEmpty"])) ? "<div class='error-message'>$errorArray['emailEmpty']</div>" : "";
            ?>
            <input type="text" class="register-username" name="register-username" placeholder="Username">
            <?php
                echo (isset($errorArray["usernameEmpty"])) ? "<div class='error-message'>$errorArray['usernameEmpty']</div>" : "";
            ?>
            <input type="password" class="register-password" name="register-password" placeholder="Password">
            <?php
                echo (isset($errorArray["passwordEmpty"])) ? "<div class='error-message'>$errorArray['passwordEmpty']</div>" : "";
            ?>
            <input type="password" class="register-password-2" name="register-password-2" placeholder="Repeat password">
            <input type="submit" class="register-button" name="register-button" value="Sign up">

            <div class="message-login">Already have an account?<a href="checkLogin.php">Sign in</a></div>
            </form>
        </div>
    </div>

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