<?php
    function recoge($var)
    {
        if (isset($_REQUEST[$var]))
            $tmp = strip_tags(sinEspacios($_REQUEST[$var]));
        else
            $tmp = "";
        return $tmp;
    }

    function sinEspacios($frase) {
        $texto = trim(preg_replace('/ +/', ' ', $frase));
        return $texto;
    }

    function isTrueUsername($username) {
        if(preg_match('/^[a-z\d_]{4,20}$/i', $username)){
            return true;
        } else{ return false; }
    }

    function isTruePassword($password) {
        if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{5,20}$/', $password)){
            return true;
        } else{ return false; }
    }

    function isTrueMail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false; 
        }
    }

    function crypt_blowfish($password) {
        $salt = '$2a$07$usesomesillystringforsalt$';
        $cryptPassword= crypt($password, $salt);

        return $cryptPassword;
    }
?>