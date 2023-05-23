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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/team-creation.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/stat-calculator.css">
    <title>Stat Calculator - PokéBuilding</title>
</head>
<body class="body">
<header>
        <div class="header-options">
            <a href="index.php" class="icon-parts">
                <img src="../img/pokeball_icon.png" alt="pokeball_icon">
                <h1 class="icon-text">PokéBuilding</h1>
            </a>
            <a href="createTeams.php" class="create-team">Create Teams &nbsp;<i class="fa fa-plus-square"></i></a>
            <a href="rankings.php" class="create-team">Rankings &nbsp;<i class="fa fa fa-line-chart"></i></a>
            <a href="statCalculator.php" class="create-team clicked">Stat Calculator &nbsp;<i class="fa fa-calculator"></i></a>
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
                                <select name="select-pokemon" id="select-pokemon">
                                    <option value></option>
                                </select>
                            </td>
                            <td colspan="2">
                                <p>Level</p>
                                <input type="number" id="level-pokemon" name="level-pokemon" min="1" max="100">
                            </td>
                            <td colspan="2">
                                <p>Nature</p>
                                <select name="select-nature" id="select-nature">
                                    <option value></option>
                                </select>
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
                            <td><input type="number" class="ev-selector" name="ev-hp" id="ev-hp" min="0" max="255"/></td>
                            <td><input type="number" class="ev-selector" name="ev-atk" id="ev-atk" min="0" max="255"/></td>
                            <td><input type="number" class="ev-selector" name="ev-def" id="ev-def" min="0" max="255"/></td>
                            <td><input type="number" class="ev-selector" name="ev-spatk" id="ev-spatk" min="0" max="255"/></td>
                            <td><input type="number" class="ev-selector" name="ev-spdef" id="ev-spdef" min="0" max="255"/></td>
                            <td><input type="number" class="ev-selector" name="ev-spe" id="ev-spe" min="0" max="255"/></td>
                        </tr>
                        <tr class="iv-row">
                            <td>
                                <p>IVs:</p>
                            </td>
                            <td><input type="number" class="iv-selector" name="iv-hp" id="iv-hp" min="0" max="31"></td>
                            <td><input type="number" class="iv-selector" name="iv-atk" id="iv-atk" min="0" max="31"></td>
                            <td><input type="number" class="iv-selector" name="iv-def" id="iv-def" min="0" max="31"></td>
                            <td><input type="number" class="iv-selector" name="iv-spatk" id="iv-spatk" min="0" max="31"></td>
                            <td><input type="number" class="iv-selector" name="iv-spdef" id="iv-spdef" min="0" max="31"></td>
                            <td><input type="number" class="iv-selector" name="iv-spe" id="iv-spe" min="0" max="31"></td>
                        </tr>
                    </tbody>
                </table>

                <input type="submit" onclick="checkFields()" value="Calculate"/>
            </form>
            <div id="error-message"></div>
        </div>

        <table id="stat-results" style="display:none;">
            <tr>
                <th></th>
                <th>HP</th>
                <th>ATK</th>
                <th>DEF</th>
                <th>SP.ATK</th>
                <th>SP.DEF</th>
                <th>SPD</th>
            </tr>
        </table>
    </div>
    
    <footer>
        <div class="footer-options">
            <div class="youtube">
                <a href="https://youtube.com">YOUTUBE</a>
            </div>
            <div class="twitter">
                <a href="https://twitter.com/">TWITTER</a>
            </div>
            <div class="instagram">
                <a href="https://www.instagram.com">INSTAGRAM</a>
            </div>
        </div>
    </footer>
    
    <script src="../JS/stats.js"></script>
    <script src="../JS/dark-mode.js"></script>
</body>
</html>