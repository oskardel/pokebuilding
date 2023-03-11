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
?>