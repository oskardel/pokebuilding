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
    <title>Rankings - PokéBuilding</title>
</head>
<body class="body">
    <header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team">Create Teams</a>
            <a href="compareTeams.php" class="create-team">Compare</a>
            <a href="rankings.php" class="create-team clicked">Rankings</a>
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
        <?php
            try{
                $database = new User();
                if(!$teamsCount=$database->checkExistTeam()){
                    ?>
                <div class="no-teams-exist">There aren't teams created yet! <a href="createTeams.php">Create your own teams now.</a></div>
                    <?php
                } else{
                    //* CONTINUE CODE HERE (ALL TEAMS WILL BE DISPLAYED BY VOTES, WITH FILTERS OF TIME: 24hours, 7 days, 30 month) *
                    $allTeams=$database->showAllTeams();
                    for($i = 0; $i < count($allTeams); $i++) {
                        $teamId=$database->getTeamId($allTeams[$i]["teamName"]);
                        $userId=$database->getUserByTeamId($teamId);
                        $userTeam=$database->getUserById($userId);
                        echo '<div class="team-item '.$teamId.'">'; 
                            echo '<div class="team-name">';
                            echo $allTeams[$i]["teamName"];
                            echo '</div>';
                            for($j = 1; $j <= 6; $j++){
                                echo '<div class="team-pokemon">';
                                    echo '<img src="" alt="" class="team-pokemon-img">';
                                    echo '<div class="team-pokemon-name">'. ucfirst($allTeams[$i]["pokemon".$j]).'</div>';
                                echo '</div>';
                            }
                            echo '<div class="team-username">'. $userTeam .'</div>';
                            echo '<div class="votes">'. $allTeams[$i]["votes"] .'</div>';
                            echo '<button class="vote-button" onclick="addVote('. $teamId .', '. $userId .')">+</button>';
                        echo '</div>';
                    }
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        ?>
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
    
    <script src="../JS/dark-mode.js"></script>
    <script>
        const teamItem = document.querySelectorAll('.team-item');

        // IDEA: MOVER ESTE CÓDIGO AL PHP DE RANKINGS.PHP PARA ACTUALIZAR LOS VOTOS EN LA BASE DE DATOS

        const addVote = (teamId, userId) => {
            <?php 
                try{
                    $database = new User();
                    $teamId = ?> teamId; <?php // ACABAR (NO FUNCIONA + FALTA CREAR FUNCIÓN)
                    $voteArray = $database->searchVotes();
                    $addVote = $database->addVote()

                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                    $errores['datos'] = "There was an error <br>";
            }
            ?>
            teamItem[teamId-1].querySelector(".votes").innerHTML = parseInt(teamItem[teamId-1].querySelector(".votes").innerHTML) + 1;
        } 
    </script>
</body>
</html>