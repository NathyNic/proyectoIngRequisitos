<?php

if ($llego == true) {
    $to = $_POST['email'];
    $subject = 'Sobre su consulta realizada';
    $from = 'hadtecsoftfisi@gmail.com';
    $name = $_POST['name'];
    $header = 'MIME-Version 1.0' . "\r\n";
    $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $message = '<html>
        <body>
        <p> Para: ' . $name . ' </p>
        <br>
        <p>Gracias por contactarnos. Estaremos atendiendo su pregunta pronto</p>
    </body>
    </html>';
    header("Location: ../soporte.php?success");
} else {
    header("Location: ../soporte.php?error=No se pudo enviar el mensaje. Inténtelo más tarde ");
}
