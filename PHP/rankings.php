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

<?php
    if(isset($_GET["del"])){
        try{
            $database = new User();
            $teamDelete = $_GET["teamdel"];
            if($deleteTeam=$database->deleteTeam($teamDelete));

        }catch(PDOException $e){}
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
    <link rel="stylesheet" href="../CSS/rankings.css">
    <title>Rankings - PokéBuilding</title>
    <link rel="icon" type="image/x-icon" href="../img/pokeball_icon.png">
</head>
<body class="body">
<header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team">Create Teams &nbsp;<i class="fa fa-plus-square"></i></a>
            <a href="rankings.php" class="create-team clicked">Rankings &nbsp;<i class="fa fa fa-line-chart"></i></a>
            <a href="statCalculator.php" class="create-team">Stat Calculator &nbsp;<i class="fa fa-calculator"></i></a>
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

    <div class="overlay"></div>
    <div class="delete-box">
        <p>Are you sure you want to delete this team?</p>
        <button type="button" class="delete-button" id="yes-button">Yes</button>
        <button type="button" class="delete-button" id="no-button">No</button>
    </div>

    <div class="main-content-rankings">
        <div class="teams-content">
            <div class="order-button">
                <button class="option-button" value="1" id="recent-button">Most recent</button>
                <button class="option-button" value="2" id="liked-button">Most liked</button>
            </div>
                <?php
                    try{
                        $database = new User();
                        if(!$teamsCount=$database->checkExistTeam()){
                            ?>
                        <div class="no-teams-exist">There aren't teams created yet! <a href="createTeams.php">Create your own teams now.</a></div>
                            <?php
                        } else{
                            if(isset($_GET["range"])){
                                if($_GET["range"] === "2") {
                                    $allTeams=$database->showAllTeamsVotes();
                                } else{
                                    $allTeams=$database->showAllTeamsRecent();
                                }
                            } else{
                                $allTeams=$database->showAllTeamsRecent();
                            }

                            for($i = 0; $i < count($allTeams); $i++) {
                                $teamId=$database->getTeamId($allTeams[$i]["teamName"]);
                                $sessionUser=$database->getIdUser($_SESSION["user"]);
                                $userId=$database->getUserByTeamId($teamId);
                                $userTeam=$database->getUserById($userId);

                                echo '<div class="team-chart">';
                                    if($adminValue=$database->checkAdmin($sessionUser)){
                                        echo '<button class="admin-button" type="button" onclick="sureDelete('.$teamId.')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
                                    }
                                echo '<div class="team-item '.$teamId.'">'; 
                                    for($j = 1; $j <= 6; $j++){
                                        echo '<div class="team-pokemon">';
                                            echo '<div class="team-pokemon-name">'. ucfirst($allTeams[$i]["pokemon".$j]).'</div>';
                                            echo '<img src="" alt="" class="team-pokemon-img">';
                                        echo '</div>';
                                    }
                                    echo '<div class="team-name">';
                                        echo $allTeams[$i]["teamName"];
                                    echo '</div>';
                                    if($_SESSION["user"] === $userTeam) {
                                        $disabled = "disabled";
                                    } else{
                                        $disabled = "";
                                    }
                                    echo '<div class="button-div">';
                                        echo '<button type="button" class="vote-button'?> <?php try{
                                            $database = new User();
                                            $voteArray = $database->searchVotes($teamId);

                                            if(str_contains($voteArray, $sessionUser)) {
                                                echo "voted";
                                            }
                                        } catch(PDOException $e){} ?> 
                                        <?php echo '" onclick="addVote('. $teamId .', '. $sessionUser .')"'. $disabled. '>❤</button>';
                                    echo '</div>';
                                    echo '<div class="votes">'. $allTeams[$i]["votes"] .'</div>';
                                echo '</div>';
                                echo '<div class="user-info">';
                                    echo '<img class="user-picture" src="../img/'.$userTeam.'/image.png">';
                                    echo '<div class="team-username">'. $userTeam .'</div>';
                                echo '</div>';
                                echo '</div>';
                            }
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
            <div class="youtube">
                <a href="https://www.youtube.com/@pokemon">YOUTUBE</a>
            </div>
            <div class="twitter">
                <a href="https://twitter.com/Pokemon">TWITTER</a>
            </div>
            <div class="instagram">
                <a href="https://www.instagram.com/pokemon/">INSTAGRAM</a>
            </div>
        </div>
    </footer>
    
    <script src="../JS/dark-mode.js"></script>
    <script src="../JS/rankings.js"></script>
</body>
</html>

<?php
    if(isset($_GET["t"])) {
        try{
            $database = new User();
            $teamId = $_GET["t"];
            $votedBy = $_GET["v"];
            $voteArray = $database->searchVotes($teamId);

            if(!str_contains($voteArray, $sessionUser)) {
                $addVote = $database->addVote($teamId);
                $addRestriction = $database->addRestrictionVote($teamId, $sessionUser);
                ?>
                <script>
                    window.location.href = "rankings.php";
                </script>
                <?php
            } else{
                $removeVote = $database->removeVote($teamId);
                $removeRestriction = $database->removeRestrictionVote($teamId, $sessionUser);
                ?>
                <script>
                    window.location.href = "rankings.php";
                </script>
                <?php
            }
            
        } catch(PDOException $e){
            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
            $errores['datos'] = "There was an error <br>";
        }
    }
?>