<?php
include("../../con_db.php");
if (
    isset($_POST['nombre']) && isset($_POST['marca'])
    && isset($_POST['descripcion'])  && isset($_POST['precio'])
    && isset($_POST['stock']) && isset($_POST['tipo'])
) {
    $carpeta = "../../image/";
    $varcar = "image/";
    $nombre = $_FILES['imagen']['name'];
    $temp = explode('.', $nombre);
    $extension = end($temp);
    $nombreFinal = time() . '.' . $extension;
    if ($extension == 'jpg' || $extension == 'png') {
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nombreFinal)) {
            $conex->query("insert into productoshardware (nombre,marca,tipo,precio,stock,descripcion,especificaciones,linkImagen1) values(
                '" . $_POST['nombre'] . "',
                '" . $_POST['marca'] . "',
                '" . $_POST['tipo'] . "',
                " . $_POST['precio'] . ",
                " . $_POST['stock'] . ",
                '" . $_POST['descripcion'] . "',
                '',
                '$varcar$nombreFinal'
            ) ") or die($conex->error);
            header("Location: ../productos.php?successin");
        } else {
            header("Location: ../productos.php?error=No se pudo subir la imagen ");
        }
    } else {
        header("Location: ../productos.php?error=Favor de subir una imagen válida ");
    }
} else {
    header("Location: ../productos.php?error=Favor de llenar todos los campos ");
}
