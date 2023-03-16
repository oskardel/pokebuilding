<?php
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
    <title>Home - PokeBuilding</title>
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
         <!-- "../img/".$_SESSION[user]."/image.png" -->
        <a href="profile.php" class="profile-picture">
            <img src="../img/option1.png" alt="pfp_icon">
        </a>
    </header>

    <div class="main-content">
        <!--Section to see your Pokémon team and search options-->
        <div class="pokemon-search">
            <div class="pokemon-team">
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
                <div class="pokemon-item">
                    <img src="../img/nopokemon.png" alt="pokemon-img">
                    <div class="pokemon-name"></div>
                    <div class="pokemon-types">
                        <div class="pokemon-type-1"></div>
                        <div class="pokemon-type-2"></div>
                    </div>
                </div>
            </div>
            <div class="search-options">
                <input type="text" id="search-options-name" name="search-options-name" placeholder="Enter a Pokémon">
                <select name="search-options-type" id="search-options-type">
                    <option value="all">All</option>
                </select>
                <select name="search-options-generation" id="search-options-generation">
                    <option value="all">All</option>
                </select>
                <label><input type="checkbox" class="legendary-checkbox" id="legendary-checkbox">Legendary</label>
                <input type="submit" class="submit-button" id="search-button" value="Search">
                <input type="submit" class="random-button" id="random-button" value="Random team">
            </div>
            <div class="save-team">
                <input type="text" class="save-team-name" name="save-team-name" placeholder="Team name">
                <input type="submit" class="submit-button" name="save-button" value="Save team">
            </div>
        </div>
        <!-- Section to see all the Pokémon -->
        <div id="pokedex-container"></div>
    </div>
    <script src="../JS/index.js"></script>
</body>
</html>