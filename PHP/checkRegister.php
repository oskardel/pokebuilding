<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
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
        $profilePicture = recoge("profile-picture");

        if($email === ""){
            $errorArray["emailEmpty"] = "Email cannot be empty";
        } else{
            if(!isTrueMail($email)){
                $errorArray["emailEmpty"] = "Not a valid email address";
            }
        }

        if($username === ""){
            $errorArray["usernameEmpty"] = "Username cannot be empty";
        } else{
            if(!isTrueUsername($username)){
                $errorArray["usernameEmpty"] = "Not a valid username";
            }
        }

        if($password === ""){
            $errorArray["passwordEmpty"] = "Password cannot be empty";
        } else{
            if(!isTruePassword($password)){
                $errorArray["passwordEmpty"] = "Password is not strong";
            } else{
                if($password != $password2){
                    $errorArray["passwordEmpty"] = "Passwords do not match";
                }
            }
        }

        if($profilePicture === ""){
            $errorArray["pictureEmpty"] = "Select a profile picture";
        }

        if(count($errorArray) === 0){
            try{
                $database = new User();

                //Check if the username/email is already registered
                if($userGet = $database->checkUsername($username)){
                    $errorArray["usernameEmpty"] = "The username is already taken";
                } else{
                    if($emailGet = $database->checkEmail($email)){
                        $errorArray["emailEmpty"] = "That mail is already registered";
                    } else{
                        $cryptPassword = crypt_blowfish($password);
                        $userDB = $database->insertUser($username, $cryptPassword, $email);
                        mkdir("../img/".$username, 0777);
                        copy("../img/".$profilePicture.".png", "../img/".$username."/image.png");
                        session_start();
                        $_SESSION["user"] = $username;
                        header("Location:index.php?user=".$username."&method=register");
                    }
                }
                
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            require("register.php");
        }
    }
?>