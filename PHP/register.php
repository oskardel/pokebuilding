<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Sign up - PokéBuilding</title>
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
        <div class="register-form">
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
            <form action="" method="post">
            <input type="text" class="register-email" name="register-email" placeholder="Email" value="<?php if (isset($_REQUEST['register-email'])) echo $_POST['register-email']; ?>">
            <?php
                echo (isset($errorArray["emailEmpty"])) ? "<div class='error-message'>$errorArray[emailEmpty]</div>" : "";
            ?>
            <input type="text" class="register-username" name="register-username" placeholder="Username" value="<?php if (isset($_REQUEST['register-username'])) echo $_POST['register-username']; ?>">
            <?php
                echo (isset($errorArray["usernameEmpty"])) ? "<div class='error-message'>$errorArray[usernameEmpty]</div>" : "";
            ?>
            <input type="password" class="register-password" name="register-password" placeholder="Password">
            <?php
                echo (isset($errorArray["passwordEmpty"])) ? "<div class='error-message'>$errorArray[passwordEmpty]</div>" : "";
            ?>
            <input type="password" class="register-password-2" name="register-password-2" placeholder="Repeat password">
            <input type="radio" id="option1" name="profile-picture" value="option1">
                <img src="../img/option1.png" alt="option1">
            <input type="radio" id="option2" name="profile-picture" value="option2">
                <img src="../img/option2.png" alt="option2">
            <input type="radio" id="option3" name="profile-picture" value="option3">
                <img src="../img/option3.png" alt="option3">
            <input type="radio" id="option4" name="profile-picture" value="option4">
                <img src="../img/option4.png" alt="option4">
            <?php
                echo (isset($errorArray["pictureEmpty"])) ? "<div class='error-message'>$errorArray[pictureEmpty]</div>" : "";
            ?>

            <input type="submit" class="submit-button" name="register-button" value="Sign up">

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