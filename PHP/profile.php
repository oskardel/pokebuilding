<?php
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
    <link rel="stylesheet" href="../CSS/team-creation.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/profile.css">
    <title>Create team - PokeBuilding</title>
</head>
<body>
    <header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team">Create Teams</a>
            <a href="compareTeams.php" class="create-team">Compare</a>
        </div>
        <a href="profile.php" class="profile-picture">
            <img src="<?php echo "../img/".$_SESSION["user"]."/image.png"?>" alt="pfp">
        </a>
    </header>

    <div class="main-content">
        <div class="profile-data">
            <img src="<?php echo "../img/".$_SESSION["user"]."/image.png"?>" alt="pfp">
            <input type="text" name="change-name" value="<?php echo $_SESSION["user"]; ?>">
            <div class="profile-name"><?php echo $_SESSION["user"]; ?></div>
        </div>

        <div class="profile-teams">
            <?php
                try{
                    $database = new User();
                    $userId=$database->getIdUser($_SESSION["user"]);
                    $profileTeams=$database->showTeams($userId);

                    foreach($profileTeams as $teamItem) {
                        $teamName = $teamItem["teamName"];
                        $pokemonArray = [];
                        for($i = 1; $i <= 6; $i++){
                            $pokemonArray[$i] = $teamItem["pokemon".$i];
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
</body>
</html>