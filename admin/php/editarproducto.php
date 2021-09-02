<?php
include("../../con_db.php");
if (
    isset($_POST['nombre']) && isset($_POST['marca'])
    && isset($_POST['descripcion'])  && isset($_POST['precio'])
    && isset($_POST['stock']) && isset($_POST['tipo'])
) {

    if ($_FILES['imagen']['name'] != '') {
        $carpeta = "../../image/";
        $varcar = "image/";
        $nombre = $_FILES['imagen']['name'];

        $temp = explode('.', $nombre);
        $extension = end($temp);
        $nombreFinal = time() . '.' . $extension;
        if ($extension == 'jpg' || $extension == 'png') {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $nombreFinal)) {
                $fila = $conex->query("select linkImagen1 from productoshardware where id=" . $_POST['id'] . "");
                $idI = mysqli_fetch_row($fila);
                if (file_exists('../../' . $idI[0])) {
                    unlink('../../' . $idI[0]);
                }
                $conex->query("update productoshardware set linkImagen1='$varcar$nombreFinal' where id=" . $_POST['id'] . " ");
            }
        }
    }
    $conex->query("update productoshardware set 
    nombre='" . $_POST['nombre'] . "',
    marca='" . $_POST['marca'] . "',
    descripcion='" . $_POST['descripcion'] . "',
    precio=" . $_POST['precio'] . ",
    stock=" . $_POST['stock'] . ",
    tipo='" . $_POST['tipo'] . "'
    where id=" . $_POST['id'] . " ") or die($conex->error);
    header("Location: ../productos.php?successed");
} else {
    header("Location: ../productos.php?errored=No se pudo editar. Inténtelo nuevamente ");
}
