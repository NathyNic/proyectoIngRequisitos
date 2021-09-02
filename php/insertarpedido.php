<?php
session_start();
include('../con_db.php');


//if (isset($_SESSION['carrito'])) {
//header('Location: ../index.php');
//}

$arreglo = $_SESSION['carrito'];
$total = 0;
for ($i = 0; $i < count($arreglo); $i++) {
    $total = $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'];
}
$password = "";
if (isset($_POST['c_account_password'])) {
    if ($_POST['c_account_password'] != "") {
        $password = $_POST['c_account_password'];
    }
}
$conex->query("insert into datos (name,apellido,telefono,email,password) 
values(
    '" . $_POST['c_fname'] . "',
    '" . $_POST['c_lname'] . "',
    '" . $_POST['c_phone'] . "',
    '" . $_POST['c_email_address'] . "',
    '" . $password . "'
)") or die($conex->error);
$id_usuario = $conex->insert_id;
$fecha = date('Y-m-d h:i:s');
$conex->query("insert into ventas(id_usuario,total,fecha,status) values($id_usuario,$total,'$fecha','confirmado')") or die($conex->error);
$id_venta = $conex->insert_id;
for ($i = 0; $i < count($arreglo); $i++) {
    $conex->query("insert into productos_venta(id_venta,id_producto,cantidad,precio,total) 
    values($id_venta,
    " . $arreglo[$i]['Id'] . ",
    " . $arreglo[$i]['Cantidad'] . ",
    " . $arreglo[$i]['Precio'] . ",
    " . $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'] . ")") or die($conex->error);
    $conex->query("update productoshardware set stock = stock- " . $arreglo[$i]['Cantidad'] . " where id=" . $arreglo[$i]['Id'] . "") or die($conex->error);
}

$conex->query("insert into envios(pais,direccion,distrito,cp,id_venta) values(
    '" . $_POST['country'] . "',
    '" . $_POST['c_address'] . "',
    '" . $_POST['c_state_country'] . "',
    '" . $_POST['c_postal_zip'] . "',
    $id_venta
) ") or die($conex->error);
include "./mail.php";
unset($_SESSION['carrito']);
header("Location: ../gracias.php?id_venta=$id_venta");
