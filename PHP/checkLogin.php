<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
    $errorCheck = false;

    if(isset($_SESSION["user"])){
        header("Location:index.php");
    }

    if(!isset($_REQUEST["login-button"])){
        require("login.php");
    } else{
        $username = recoge("login-username");
        $password = recoge("login-password");

        if($username === "" || $password === ""){
            $_SESSION["status"] = "Invalid username or password";
            $errorCheck = true;
        }

        if(!$errorCheck){
            try{
                $database = new User();
                if($userBD=$database->checkLoginPassword($username, $password)){
                    session_start();
                    $_SESSION["user"] = $username;
                    $_SESSION["status"] = "Login successful!";
                    header("Location:index.php?user=".$username."&method=login");
                } else{
                    $_SESSION["status"] = "The email or password is incorrect";
                    require("login.php");
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            require("login.php");
        }
    }
?>