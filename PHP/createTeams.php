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

        <div id="overlay" class=""></div>

        <!-- Section to see all the Pokémon -->
        <div class="pokemon-card" id="pokemon-card">
            <div class="pokemon-card-info">
                <select id="pokemon-forms" class="pokemon-forms">
                    
                </select>
                <div class="image-div">
                    <div class="image-div-left">
                        <div class="pokemon-card-name">Pokémon</div>
                        <div class="pokemon-card-id">???</div>
                        <div class="pokemon-card-genera">Generation</div>
                        <div class="pokemon-card-types">
                            <div class="card-type-1"></div>
                            <div class="card-type-2"></div>
                        </div>
                    </div>
                    <div class="image-div-right">
                        <div class="pokemon-card-img">
                            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/169.png" alt="" id="default-sprite">
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
                                <div class="spd-tittle">SPD</div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</body>
</html>