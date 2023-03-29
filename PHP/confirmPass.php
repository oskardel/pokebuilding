<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");

    if(!isset($_REQUEST["password-button"])) {
        require("newPass.php");
    } else{
        $newPass = recoge("new-password-1");
        $confirmPass = recoge("new-password-2");
        $tokenEmail = $_GET["token"];

        if($newPass === $confirmPass) {
            try{
                $database = new User();
                if(isTruePassword($newPass)){
                    $cryptPass = crypt_blowfish($newPass);
                    if($userId=$database->getIdToken($tokenEmail));
                    if($changePass=$database->updatePassword($cryptPass, $userId)){
                        $randCode = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
                        if($emailToken=$database->getEmailById($userId));
                        if($token=$database->setToken($randCode, $emailToken)); //REVISAR (NO LO HE PROBADO) *CAMBIA EL TOKEN*
                    }
                    header( "Refresh:5;url=index.php");
                } else{
                    $_SESSION["status"] = "Password not strong";
                    require("newPass.php");
                }

            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            $_SESSION["status"] = "Passwords do not match";
            require("newPass.php");
        }
    }
?>