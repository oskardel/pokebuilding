<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/team-creation.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/profile.css">
    <title><?php echo $_SESSION["user"]; ?> - PokéBuilding</title>
</head>
<body class="body light-theme">
<header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team">Create Teams</a>
            <a href="compareTeams.php" class="create-team">Compare</a>
            <a href="rankings.php" class="create-team">Rankings</a>
            <a href="statCalculator.php" class="create-team">Stat Calculator</a>
        </div>

        <div href="" class="profile-picture" onclick="toggleMenu()">
            <img src="<?php echo "../img/".$_SESSION["user"]."/image.png" ?>" alt="pfp">
        </div>
        <div class="drop-menu-wrap">
            <div class="drop-menu">
                <div class="user-info"><?php echo "Welcome, ".$_SESSION["user"]; ?></div>
                <hr>

                <a href="profile.php" class="drop-menu-link">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <p>Edit Profile</p>
                    <span>></span>
                </a>

                <div onclick='switchAppearance()' class="drop-menu-link">
                    <i class="fa fa-moon-o"></i>
                    <p>Switch appearance</p>
                    <span>></span>
                </div>

                <a href="index.php?so=true" class="drop-menu-link">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <p>Sign out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <div class="profile-data">
            <img src="<?php echo "../img/".$_SESSION["user"]."/image.png"?>" alt="pfp">
            <div class="profile-name"><?php echo $_SESSION["user"]; ?></div>
            <div class="edit-popup">Edit profile</div>
        </div>

        <div id="overlay" class="<?php 
            if(isset($_GET["edit"])) {
                echo "active";
            } ?>"></div>

        <div class="profile-edit <?php 
            if(isset($_GET["edit"])) {
                echo "active";
            } ?>" id="profile-edit">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="image-edit">
                    <img src="<?php echo "../img/".$_SESSION["user"]."/image.png"?>" alt="pfp" class="image-edit-profile" onclick="openImageMenu()">
                    <div class="select-new-pfp">
                        <input type="radio" id="radio-image1" name="radio-image" value="option1">
                            <label for="radio-image1"><img src="../img/option1.png" alt="option1" class="new-image-pfp"></label>
                        <input type="radio" id="radio-image2" name="radio-image" value="option2">
                            <label for="radio-image2"><img src="../img/option2.png" alt="option2" class="new-image-pfp"></label>
                        <input type="radio" id="radio-image3" name="radio-image" value="option3">
                            <label for="radio-image3"><img src="../img/option3.png" alt="option3" class="new-image-pfp"></label>
                        <input type="radio" id="radio-image4" name="radio-image" value="option4">
                            <label for="radio-image4"><img src="../img/option4.png" alt="option4" class="new-image-pfp"></label>
                    </div>
                </div>
                <div class="new-name-form">
                    <input type="text" name="form-name" value="<?php echo $_SESSION["user"]; ?>">
                    <span class="floating-label">Name</span>
                </div>
                <div class="new-email-form">
                    <input type="text" name="form-email" value="<?php 
                        try{
                            $database = new User();
                            if($userEmail=$database->getEmail($_SESSION["user"])){
                                echo $userEmail;
                            }
                        } catch(PDOException $e){
                            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                            $errores['datos'] = "There was an error <br>";
                        }
                    ?>">
                    <span class="floating-label">Email</span>
                </div>
                <div class="confirm-password-form">
                    <input type="password" name="form-password">
                    <span class="floating-label">Confirm password</span>
                </div>
                <input type="submit" name="form-submit" value="Save">
            </form>
        </div>

        <div class="profile-teams"><?php
            try{
                $database = new User();
                $userId=$database->getIdUser($_SESSION["user"]);
                $profileTeams=$database->showTeams($userId);

                foreach($profileTeams as $teamItem) {
                    $teamName = $teamItem["teamName"];
                    $teamId = $teamItem["id"];
                    $pokemonArray = [];
                    for($i = 1; $i <= 6; $i++){
                        $pokemonArray[$i] = $teamItem["pokemon".$i];
                        $pokemonArray[$i] = ucfirst($pokemonArray[$i]);
                    }

                    echo '<div class="team-item">';
                        echo '<div class="team-name">';
                        echo $teamName;
                        echo '</div>';
                        for($j = 1; $j <= 6; $j++){
                            echo '<div class="team-pokemon">';
                                echo '<img src="" alt="" class="team-pokemon-img">';
                                echo '<div class="team-pokemon-name">'.$pokemonArray[$j].'</div>';
                            echo '</div>';
                        }
                        echo '<div class="edit-team" id="edit-'.$j.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>';
                        echo '<div class="team-id" style="display:none">'.$teamId.'</div>';
                    echo '</div>';
                }
                
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
            ?>
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
    <script src="../JS/profile.js"></script>
    <script src="../JS/dark-mode.js"></script>
</body>
</html>

<?php
    if(isset($_REQUEST["form-submit"])){
        $errorEdit = [];
        $newName = $_REQUEST["form-name"];
        $newEmail = $_REQUEST["form-email"];
        $confirmPass = $_REQUEST["form-password"];

        if($newName === "" | !isTrueUsername($newName)) {
            $errorEdit["NoName"] = "Username cannot be empty";
        }
        if($newEmail === "" | !isTrueMail($newEmail)) {
            $errorEdit["NoEmail"] = "Email address not valid";
        }
        if($confirmPass === "") {
            $errorEdit["NoPassword"] = "Incorrect password, try again";
        }

        if(count($errorEdit) === 0) {
            try{
                $database = new User();
                if($userId=$database->getIdUser($_SESSION["user"]));               
                $cryptPassword = crypt_blowfish($confirmPass);
                if($checkPass=$database->checkPassword($_SESSION["user"], $cryptPassword)){
                    if(isset($_REQUEST["radio-image"])){
                        unlink("../img/".$_SESSION["user"]."/image.png");
                        $valueImage = recoge("radio-image");
                        copy("../img/".$valueImage.".png", "../img/".$_SESSION["user"]."/image.png");
                    }
                    $editPrefix = false;
                    if(!$userGet = $database->checkUsername($newName)){
                        if($updateName=$database->updateUsername($newName, $userId));
                        rename("../img/".$_SESSION["user"], "../img/".$newName);
                        $_SESSION["user"] = $newName;
                    } else{
                        $editPrefix = true;
                    }
                    
                    if(!$userEmail = $database->checkEmail($newEmail)){
                        if($updateEmail=$database->updateEmail($newEmail, $userId));
                    } else{
                        $editPrefix = true;
                    }
                    if($editPrefix) {
                        ?>
                        <script type="text/javascript">
                            window.location.href = 'profile.php?edit=true';
                        </script>
                    <?php
                    } else{
                        ?>
                        <script type="text/javascript">
                            window.location.href = 'profile.php';
                        </script>
                    <?php
                    }
                    
                    
                } else{
                    $errorEdit["NoPassword"] = "Password is incorrect"; //CHANGE TO $_SESSION["status]
                    ?>
                        <script type="text/javascript">
                            window.location.href = 'profile.php?edit=true';
                        </script>
                    <?php
                }

            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }    
        }
    }
?>