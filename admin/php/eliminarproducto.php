<?php
include("../../con_db.php");
$fila = $conex->query("select linkImagen1 from productoshardware where id=" . $_POST['id'] . "");
$idI = mysqli_fetch_row($fila);
if (file_exists('../../' . $idI[0])) {
    unlink('../../' . $idI[0]);
}
$conex->query("delete from productoshardware where id=" . $_POST['id'] . "");
