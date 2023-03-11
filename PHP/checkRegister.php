<?php
    require("functions.php");
    $errorArray = [];

    if(isset($_SESSION["user"])){
        header("Location:index.php");
    }

    if(!isset($_REQUEST["register-button"])){
        require("register.php");
    } else{
        $email = recoge("register-email");
        $username = recoge("register-username");
        $password = recoge("register-password");
        $password2 = recoge("register-password-2");

        if($email === ""){
            $errorArray["emailEmpty"] = "Email cannot be empty";
        }
        if($username === ""){
            $errorArray["usernameEmpty"] = "Username cannot be empty";
        }
        if($password === ""){
            $errorArray["passwordEmpty"] = "Password cannot be empty";
        }

        if(count($errorArray) === 0){
            try{
                //REGISTER AND DATABASE CODE
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            require("register.php");
        }
    }
?>