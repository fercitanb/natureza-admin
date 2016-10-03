<?php


    $mensaje = "Contraseña:";

    $to = 'nonicito@gmail.com';
    $subject ='Email ';
    $header = 'From: mfndpb@gmail.com'.
        'MIME-Version: 1.0'.'\r\n'.
        'Content-type: text/html; charset=utf-8';

    if (mail($to,$subject,$mensaje,$header)) {
        echo "Enviado!";
    } else {
        echo "Fallo!";
    }

?>