<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require("functions.php");
    require("model/modelClass.php");
    require("model/userClass.php");
    require("../DB/config.php");
    $errorArray = [];

    function sendPasswordReset($email, $randCode, $username) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'pokebuilding.help@gmail.com';
            $mail->Password   = 'uwyn rofl ulus rmzk';
            //pass= pokemonbuild777
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;  
        
            $mail->setFrom('pokebuilding-help@gmail.com', 'PokéBuilding Help');
            $mail->addAddress($email);
        
            $mail->isHTML(true);
            $mail->Subject = 'Please reset your password - PokéBuilding';
            $mail->Body    = 
                "<table width='100%'' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                <td align='center'>
                <div class='header' style='background-color: transparent; padding:25px; border-top: 5px solid red;'>
                <a href=''><h1>PokéBuilding</h1></a> 
                </div><div style='background-color: white; border-radius: 5px; padding:25px;'><p>Hello, ".$username."<br> We received a request to change your password (".$email.")<br> Change your password here:</p> <br> <a href='http://localhost/TFG/PHP/confirmPass.php?token=".$randCode."' style='text-align:center; background-color: #eceff1; border-radius: 5px; padding: 25px; text-decoration: none; color: black;'>Reset your password</a><br><br> <p>If you did not request this code, it is possible that someone else is trying to access to your account. <strong>Do not share this code to anyone.</strong></p><br><br> <p>Sincerely yours,<br> <strong>The PokéBuilding team.</strong></p></div>
                </td>
                </tr>
                </table>";

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if(!isset($_REQUEST["forgot-button"])) {
        require("password.php");
    } else{
        $email = recoge("forgot-email");

        if($email === "") {
            $_SESSION["status"] = "Email cannot be blank";
        }

        if(count($errorArray) === 0) {
            try{
                $database = new User();
                if($checkMail=$database->checkEmail($email)) {
                    $_SESSION["status"] = "An email has been sent to your address.";
                    $randCode = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
                    if($username=$database->getUserWithEmail($email));
                    sendPasswordReset($email, $randCode, $username);
                    if($token=$database->setToken($randCode, $email));
                    require("password.php");
                } else{
                    $_SESSION["status"] = "Something went wrong, try again";
                    require("password.php");
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "There was an error <br>";
            }
        } else{
            require("password.php");
        }
    }
?>