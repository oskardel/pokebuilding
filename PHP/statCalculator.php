<?php
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
    require("functions.php");

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
    <title>Stat Calculator - PokéBuilding</title>
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
            <a href="statCalculator.php" class="create-team clicked">Stat Calculator</a>
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
        <div class="stat-table">
            <form id="aform" onsubmit="return false;">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <p>Choose a Pokémon</p>
                                <select name="select-pokemon" id="select-pokemon"></select>
                            </td>
                            <td colspan="2">
                                <p>Level</p>
                                <input type="number" id="level-pokemon" name="level-pokemon" min="1" max="100">
                            </td>
                            <td colspan="2">
                                <p>Nature</p>
                                <select name="select-nature" id="select-nature"></select>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>HP</th>
                            <th>ATK</th>
                            <th>DEF</th>
                            <th>SP.ATK</th>
                            <th>SP.DEF</th>
                            <th>SPD</th>
                        </tr>
                        <tr class="ev-row">
                            <td>
                                <p>EVs:</p>
                            </td>
                            <td><input type="number" name="ev-hp" id="ev-hp" min="0" max="255"/></td>
                            <td><input type="number" name="ev-atk" id="ev-atk" min="0" max="255"/></td>
                            <td><input type="number" name="ev-def" id="ev-def" min="0" max="255"/></td>
                            <td><input type="number" name="ev-spatk" id="ev-spatk" min="0" max="255"/></td>
                            <td><input type="number" name="ev-spdef" id="ev-spdef" min="0" max="255"/></td>
                            <td><input type="number" name="ev-spe" id="ev-spe" min="0" max="255"/></td>
                        </tr>
                        <tr>
                            <td>
                                <p>IVs:</p>
                            </td>
                            <td><input type="number" name="iv-hp" id="iv-hp" min="0" max="31"></td>
                            <td><input type="number" name="iv-atk" id="iv-atk" min="0" max="31"></td>
                            <td><input type="number" name="iv-def" id="iv-def" min="0" max="31"></td>
                            <td><input type="number" name="iv-spatk" id="iv-spatk" min="0" max="31"></td>
                            <td><input type="number" name="iv-spdef" id="iv-spdef" min="0" max="31"></td>
                            <td><input type="number" name="iv-spe" id="iv-spe" min="0" max="31"></td>
                        </tr>
                    </tbody>
                </table>

                <input type="submit" onclick="calculateStats()" value="Calculate"/>
                
                <div id="stat-results"></div>
            </form>
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
    
    <script src="../JS/stats.js"></script>
</body>
</html>