<?php
// include header.php file
include('header.php');
include('con_db.php');

if (!isset($_GET['id_venta'])) {
    header("Location: ./");
}
$datos = $conex->query("select ventas.*,
        datos.name, datos.apellido, datos.telefono, datos.email
        from ventas
        inner join datos on ventas.id_usuario = datos.id
        where ventas.id=" . $_GET['id_venta'] . "") or die($conex->error);
$datosUsuario = mysqli_fetch_row($datos);
$datos2 = $conex->query("select * from envios where id_venta =" . $_GET['id_venta'] . "") or die($conex->error);
$datosEnvio = mysqli_fetch_row($datos2);

$datos3 = $conex->query("select productos_venta.*,
            productoshardware.nombre as nombre_producto, productoshardware.linkImagen1
            from productos_venta inner join productoshardware on productos_venta.id_producto = productoshardware.id
            where id_venta = " . $_GET['id_venta'] . "
            ") or die($conex->error);
?>

<div class="site-wrap">

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 mb-3 text-black">Datos del pedido</h2>
                </div>
                <div class="col-md-7">

                    <form action="#" method="post">

                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> <b>Venta #<?php echo $_GET['id_venta']; ?></b> </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Nombre: <?php echo $datosUsuario[5]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Apellido: <?php echo $datosUsuario[6]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Email: <?php echo $datosUsuario[8]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Teléfono: <?php echo $datosUsuario[7]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Dirección: <?php echo $datosEnvio[2]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black"> Distrito: <?php echo $datosEnvio[3]; ?></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Código postal: <?php echo $datosEnvio[4]; ?></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 ml-auto">
                    <?php
                    while ($f = mysqli_fetch_array($datos3)) {
                    ?>

                        <div class="p-4 border mb-3">
                            <img src="<?php echo $f['linkImagen1']; ?>" alt="" width="50px" />
                            <span class="d-block text-primary h6 text-uppercase"><?php echo $f['nombre_producto']; ?></span>
                            <p class="mb-0">Cantidad: <?php echo $f['cantidad']; ?></p>
                            <p class="mb-0">Precio: $ <?php echo $f['precio']; ?></p>
                            <p class="mb-0">Subtotal: $ <?php echo $f['total']; ?></p>
                        </div>
                    <?php } ?>
                    <h4>Total: <?php echo $datosUsuario[2]; ?> </h4>
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


<!--Footer-->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <h3>ipsum dolor.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, consectetur.</p>
            </div>
            <div class="footer-col-2">
                <img src="image/Logo HadtecSoft (1).png">
                <p>Nuestro propósito es hacer la compra de hardware y servicios técnicos de forma placentera</p>
            </div>
            <div class="footer-col-3">
                <h3>Links</h3>
                <ul>
                    <li>Cupones</li>
                    <li>Blog</li>
                    <li>Política de devolución</li>
                    <li>Política de privacidad</li>
                </ul>
            </div>
            <div class="footer-col-4">
                <h3>Síguenos</h3>
                <ul>
                    <li>Facebook</li>
                    <li>Instagram</li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="copyright">HadtecSoft - Todos los derechos reservados 2021</p>
    </div>
</div>

</body>

</html>