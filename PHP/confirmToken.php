<?php
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");

    if(!isset($_REQUEST["code-button"])) {
        require("addToken.php");
    } else{
        session_start();
        $token = recoge("code-text");

        try{
            $database = new User();

            if($tokenArray=$database->getAllToken($token));
            echo print_r($tokenArray);
            if(in_array($token, $tokenArray)){
                header("Location:confirmPass.php?token=".$token);
            } else{
                $_SESSION["status"] = "Incorrect code, try again";
                require("addToken.php");
            }
        } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
        }
    }
?>