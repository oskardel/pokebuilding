<?php
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
    require("functions.php");

    session_start();
    if(!isset($_SESSION["user"])){
        header("Location:index.php");
    }
    
    if(isset($_GET["edit"])) {
        if($_GET["edit"] === "true") {
            header("Location:profile.php");
        }
    }

    if(isset($_GET["p1"]) || isset($_GET["p2"]) || isset($_GET["p3"]) || isset($_GET["p4"]) || isset($_GET["p5"]) || isset($_GET["p6"])){
        $_SESSION["status"] = "New team has been created";
        for($i = 0; $i <= 6; $i++) {
            if(isset($_GET["p".$i])){
                $pokemonEdit[$i-1] = $_GET["p".$i];
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/team-creation.css">
    <title>Create team - PokeBuilding</title>
    <link rel="icon" type="image/x-icon" href="../img/pokeball_icon.png">
</head>
<body class="body">
    <header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team clicked">Create Teams &nbsp;<i class="fa fa-plus-square"></i></a>
            <a href="rankings.php" class="create-team">Rankings &nbsp;<i class="fa fa fa-line-chart"></i></a>
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

    <div class="background-image"></div>
    <div class="background-image-2"></div>

    <div id="loader" class="">
        <img src="../img/loading.gif" alt="">
        <p class="pokemon-fetch">0 Pokémon fetched</p>
        <div class="loader-bar">
            <div class="loader-progress"></div>
        </div>
    </div>

    <div id="loader-overlay" class=""></div>

    <div class="main-content">
        <div class="pokemon-search">
            <div class="pokemon-team">
                <div class="team-id"><?php
                        try{
                            $database = new User();
                            if(isset($_GET["edit"])){
                                $nameTeam = $_GET["n"];

                                if($teamId=$database->getTeamId($nameTeam));
                                echo $teamId;
                            } else{
                                $teamId = "";
                                echo $teamId;
                            }

                        } catch(PDOException $e){
                            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                            $errores['datos'] = "There was an error <br>";
                        }
                        
                    ?>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[0])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[0]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[1])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[1]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[2])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[2]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[3])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[3]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[4])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[4]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img" class="pokemon-img nopokemon">
                    <div class="pokemon-name"><?php 
                        if(isset($pokemonEdit[5])){
                            echo str_replace("-", " ", ucfirst($pokemonEdit[5]));
                    } ?></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
            </div>
            <div class="search-options">
                <input type="text" id="search-options-name" name="search-options-name" placeholder="Enter a Pokémon">
                <label>Types:
                <select name="search-options-type" id="search-options-type">
                    <option value="all">All</option>
                </select>
                </label>
                <label>Regions: 
                <select name="search-options-generation" id="search-options-generation">
                    <option value="all">All</option>
                </select>
                </label>
                <label><input type="checkbox" class="legendary-checkbox" id="legendary-checkbox">Legendary</label>
                <br>
                <input type="submit" class="submit-button" id="search-button" value="Search">
                <input type="submit" class="random-button" id="random-button" value="Random team">
            </div>
            <input type="text" class="save-team-name" name="save-team-name" placeholder="Team name" value="<?php if(isset($_GET["n"])){ echo $_GET["n"]; } ?>">
            <input type="submit" class="save-team" id="save-team" value="<?php 
                    if(isset($_GET["edit"])){
                        echo "Update team";
                    } else{
                        echo "Save team";
                    }
                ?>">
            <div class="error-team-name"><?php $nameError = ""; echo $nameError; ?></div>
            <?php
                if(isset($_SESSION["status"])) {
                    if(isset($_GET["edit"])) {
                        unset($_SESSION["status"]);
                    } else{
                ?>
                    <div class="alert-message">
                        <h5><?php echo $_SESSION["status"]; ?></h5>
                    </div>
                <?php
                    unset($_SESSION["status"]);
                }
                }
            ?>

            <div class="pokemon-image-div"><img src="" alt="" class="pokemon-image-hover"></div>
        </div>

        <div id="overlay" class=""></div>

        <div id="hidden-id"></div>
        <div class="pokemon-card" id="pokemon-card">
            <div class="pokemon-card-info">
                <div class="image-div">
                    <div class="image-div-left">
                        <div class="pokemon-card-name">Pokémon</div>
                        <div class="pokemon-card-id">???</div>
                        <div class="pokemon-card-genera">Generation</div>
                        <div class="pokemon-card-types">
                            <div class="card-type-1"></div>
                            <div class="card-type-2"></div>
                        </div>
                        <input type="submit" class="add-button" name="add-pokemon-button" value="+">
                        <select id="pokemon-forms" class="pokemon-forms"></select>
                    </div>
                    <div class="image-div-right">
                        <div class="pokemon-card-img">
                            <img src="" alt="" id="default-sprite">
                        </div>
                        <div class="pokemon-info">
                            <div class="pokemon-height">
                                <div class="tittle">Height</div>
                                <div class="height-info">???</div>
                            </div>
                            <div class="pokemon-weight">
                                <div class="tittle">Weight</div>
                                <div class="weight-info">???</div>
                            </div>
                        </div>
                    </div>
                    <img src="../img/pokeball-background.png" alt="" class="pokeball-background">
                </div>

                <div class="pokemon-info-div">
                    <div class="pokedex-entry">
                        <div class="tittle">Pokédex Entry</div>
                        <div class="pokedex-entry-info">???</div>
                    </div>

                    <div class="pokemon-card-abilities">
                        <div class="tittle">Abilities</div>
                        <div class="abilities-info">
                            <div class="ability-1">
                                <div class="ability-1-name">Ability 1</div>
                                <div class="ability-1-info">This ability does things</div>
                            </div>
                            <div class="ability-2">
                                <div class="ability-2-name">Ability 2</div>
                                <div class="ability-2-info">This ability does things</div>
                            </div>
                        </div>
                    </div>

                    <div class="pokemon-stats">
                        <div class="tittle">Stats</div>
                        <div class="stats-info">
                            <div class="hp-stats">
                                <div class="hp-tittle">HP</div>
                                <div class="hp-info stat">???</div>
                                <div class="hp-bar bar">
                                    <div class="hp-progress progress"></div>
                                </div>
                            </div>
                            <div class="atk-stats">
                                <div class="atk-tittle">ATK</div>
                                <div class="atk-info stat">???</div>
                                <div class="atk-bar bar">
                                    <div class="atk-progress progress"></div>
                                </div>
                            </div>
                            <div class="def-stats">
                                <div class="def-tittle">DEF</div>
                                <div class="def-info stat">???</div>
                                <div class="def-bar bar">
                                    <div class="def-progress progress"></div>
                                </div>
                            </div>
                            <div class="spatk-stats">
                                <div class="spatk-tittle">SpA</div>
                                <div class="spatk-info stat">???</div>
                                <div class="spatk-bar bar">
                                    <div class="spatk-progress progress"></div>
                                </div>
                            </div>
                            <div class="spdef-stats">
                                <div class="spdef-tittle">SpD</div>
                                <div class="spdef-info stat">???</div>
                                <div class="spdef-bar bar">
                                    <div class="spdef-progress progress"></div>
                                </div>
                            </div>
                            <div class="spd-stats">
                                <div class="spd-tittle">SPE</div>
                                <div class="spd-info stat">???</div>
                                <div class="spd-bar bar">
                                    <div class="spd-progress progress"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pokemon-moves">
                        <div class="tittle">Moves</div>
                        <table id="moves-table"></table>
                    </div>
                </div>
            </div>
        </div>

        <div id="pokedex-container"></div>
    </div>

    <script src="../JS/index.js"></script>
    <script src="../JS/dark-mode.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</body>
</html>


<?php
    // IF THERE'S AT LEAST ONE POKEMON ON THE LINK, IT MEANS THAT THE TEAM HAS BEEN SUCCESSFULLY CHECKED AND CAN BE SAVED INTO THE DATABSE
    if(isset($_GET["p1"]) || isset($_GET["p2"]) || isset($_GET["p3"]) || isset($_GET["p4"]) || isset($_GET["p5"]) || isset($_GET["p6"])){
        if(isset($_GET["edit"])){ //If user is editing team = UPDATE TEAM IN DATABASE
            $pokemonArray = [];
            $newName = $_GET["n"];
            $idTeam = $_GET["id"];
            
            for($i = 0; $i <= 6; $i++) {
                if(isset($_GET["p".$i])){
                    $pokemonArray[$i] = $_GET["p".$i];
                }
            }

            if($_GET["edit"] == "true"){
                try{
                    $database = new User();
                    if($updateTeam=$database->updateTeam($newName, $pokemonArray, $idTeam));
                    
                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                    $errores['datos'] = "There was an error <br>";
                }
            }
            

        } else{ //If user is creating team = CREATE TEAM IN DATABASE
            $pokemonName = [];
            $teamName = $_GET["n"];
            
            for($i = 0; $i <= 6; $i++) {
                if(isset($_GET["p".$i])){
                    $pokemonName[$i] = $_GET["p".$i];
                }
            }

            try{
                $database = new User();
                if($userId=$database->getIdUser($_SESSION["user"]));
                if($nameCheck=$database->checkTeamName($teamName)){
                    $_SESSION["status"] = "Team name already exists";
                } else{
                    if($addTeam=$database->addTeam($teamName, $pokemonName, $userId)){
                        if($plusNumber=$database->addNumberTeam($userId));
                    }
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        }
    }
?>  