<?php
include("../../con_db.php");
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {
    $usuario = $_POST['email'];
    $pass = $_POST['password'];
    $resultado = $conex->query("select * from usuariosadmin where email='$usuario' and pass='$pass' limit 1") or die($conex->error);
    if (mysqli_num_rows($resultado) > 0) {
        $datos_usuarioad = mysqli_fetch_row($resultado);
        $nombre = $datos_usuarioad[3];
        $id_usuarioadmin = $datos_usuarioad[0];
        $email = $datos_usuarioad[1];
        $imagen_perfil = $datos_usuarioad[4];

        $_SESSION['datos_logad'] = array(
            'nombre' => $nombre,
            'id_usuarioad' => $id_usuarioadmin,
            'email' => $email,
            'imagen' => $imagen_perfil,
        );
        header("Location: ../index.php");
    } else {
        header("Location:../login.php?error=Credenciales incorrectas");
    }
} else {
    header(".../login.php");
}
