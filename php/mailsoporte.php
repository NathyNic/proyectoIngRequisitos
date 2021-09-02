<?php
if (isset($_POST["submit"])) {
    $to = 'hadtecsoftfisi@gmail.com';
    $subject = $_POST["subject"];
    $from = $_POST["email"];
    $name = $_POST["name"];
    $header = 'MIME-Version 1.0' . "\r\n";
    $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $message = '<html>
    <body>
        <p>De: ' . $name . ' </p>
        <br>
        <p>' . $_POST["message"] . '</p>
    </body>
    </html>';

    if (mail($to, $subject, $message, $header)) {
        $to = $_POST["email"];
        $subject = 'Sobre su consulta realizada';
        $from = 'hadtecsoftfisi@gmail.com';
        $name = $_POST["name"];
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


        if (mail($to, $subject, $message, $header)) {
            header("Location: ../soporte.php?success");
        } else {
            header("Location: ../soporte.php?error=No se pudo enviar el mensaje. Inténtelo más tarde ");
        }
    } else {
        header("Location: ../soporte.php?error=No se pudo enviar el mensaje. Revise que los campos estén llenos correctamente. ");
    }
}
