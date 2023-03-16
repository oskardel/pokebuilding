<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
    $errorArray = [];

    if(isset($_SESSION["user"])){
        header("Location:index.php");
    }

    if(!isset($_REQUEST["login-button"])){
        require("login.php");
    } else{
        $username = recoge("login-username");
        $password = recoge("login-password");

        if($username === ""){
            $errorArray["userEmpty"] = "Username cannot be empty";
        }

        if($password === ""){
            $errorArray["passwordEmpty"] = "Password cannot be empty";
        }

        if(count($errorArray) === 0){
            try{
                $database = new User();
                if($userBD=$database->checkPassword($username, $password)){
                    session_start();
                    $_SESSION["user"] = $username;
                    header("Location:index.php?user=".$username."&method=login");
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            require("login.php");
        }
    }