<?php
// include header.php file
include('header.php');
/*include('con_db.php');

if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
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
$conex->query("insert into ventas(id_usuario,total,fecha,status,id_pago) values($id_usuario,$total,'$fecha','confirmado','1')") or die($conex->error);
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
include "./php/mail.php";
unset($_SESSION['carrito']);*/

if (isset($_GET['id_venta'])) {
    $id_venta = $_GET['id_venta'];
}
?>

<body>

    <div class="site-wrap">
        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <span class="icon-check_circle display-3 text-success"></span>
                        <h2 class="display-3 text-black">¡Gracias!</h2>
                        <p class="lead mb-5">Tu orden ha sido procesada correctamente</p>
                        <p><a href="verpedido.php?id_venta=<?php echo $id_venta; ?>" class="btn btn-sm btn-primary">Ver Pedido</a></p>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>

</body>

</html>