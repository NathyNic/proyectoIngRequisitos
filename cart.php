<?php
// include header.php file
include('header.php');
include("con_db.php");
if (isset($_SESSION['carrito'])) {
    //Buscar si el producto está agregado
    if (isset($_GET['id'])) {
        $arreglo = $_SESSION['carrito'];
        $encontro = false;
        $numero = 0;
        for ($i = 0; $i < count($arreglo); $i++) {
            if ($arreglo[$i]['Id'] == $_GET['id']) {
                $encontro = true;
                $numero = $i;
            }
        }
        if ($encontro == true) {
            $arreglo[$numero]['Cantidad'] = $arreglo[$numero]['Cantidad'] + 1;
            $_SESSION['carrito'] = $arreglo;
        } else {
            $nombre = "";
            $precio = "";
            $imagen = "";
            $res = $conex->query('select * from productoshardware where id=' . $_GET['id'] . ' ') or die($conex->error);
            $fila = mysqli_fetch_row($res);
            $nombre = $fila[1];
            $precio = $fila[4];
            $imagen = $fila[8];
            $arregloNuevo = array(
                'Id' => $_GET['id'],
                'Nombre' => $nombre,
                'Precio' => $precio,
                'Imagen' => $imagen,
                'Cantidad' => 1
            );
            array_push($arreglo, $arregloNuevo);
            $_SESSION['carrito'] = $arreglo;
            header("Location: ./cart.php");
        }
    }
} else {
    //Crear variable de sesión
    if (isset($_GET['id'])) {
        $nombre = "";
        $precio = "";
        $imagen = "";
        $res = $conex->query('select * from productoshardware where id=' . $_GET['id'] . ' ') or die($conex->error);
        $fila = mysqli_fetch_row($res);
        $nombre = $fila[1];
        $precio = $fila[4];
        $imagen = $fila[8];
        $arreglo[] = array(
            'Id' => $_GET['id'],
            'Nombre' => $nombre,
            'Precio' => $precio,
            'Imagen' => $imagen,
            'Cantidad' => 1
        );
        $_SESSION['carrito'] = $arreglo;
    }
}
?>



<body>

    <div class="site-wrap">
        <div class="site-section">
            <div class="container">
                <h2 style="margin-top: 5px">Carrito de compras</h2>
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table" style="margin-top: 20px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Imagen</th>
                                        <th class="product-name">Producto</th>
                                        <th class="product-price">Precio</th>
                                        <th class="product-quantity">Cantidad</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    if (isset($_SESSION['carrito'])) {
                                        $arregloCarrito = $_SESSION['carrito'];
                                        for ($i = 0; $i < count($arregloCarrito); $i++) {
                                            $total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
                                            $subtotal = $total - (0.18 * $total);
                                    ?>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <img src="<?php echo $arregloCarrito[$i]['Imagen'] ?>" alt="Image" class="img-fluid">
                                                </td>
                                                <td class="product-name">
                                                    <h2 class="h5 text-black"><?php echo $arregloCarrito[$i]['Nombre'] ?></h2>
                                                </td>
                                                <td>$<?php echo $arregloCarrito[$i]['Precio'] ?></td>
                                                <td>
                                                    <div class="input-group mb-3" style="max-width: 120px;">
                                                        <div class="input-group-prepend">
                                                            <button class="btncomp btn-outline-primary js-btn-minus btnIncrementar" type="button">&minus;</button>
                                                        </div>
                                                        <input type="text" class="form-control text-center txtCantidad" data-precio="<?php echo $arregloCarrito[$i]['Precio'] ?>" data-id="<?php echo $arregloCarrito[$i]['Id'] ?>" value="<?php echo $arregloCarrito[$i]['Cantidad'] ?>" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                        <div class="input-group-append">
                                                            <button class="btncomp btn-outline-primary js-btn-plus btnIncrementar" type="button">&plus;</button>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="cant<?php echo $arregloCarrito[$i]['Id'] ?>">$<?php echo $arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad'] ?></td>
                                                <td><a href="#" class="btn btn-primary btn-sm btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id']; ?>">X</a></td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <button class="btn btn-primary btn-sm btn-block">Actualizar carrito</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-primary btn-sm btn-block">Seguir comprando</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-black h4" for="coupon">Cupón</label>
                                <p>Ingresa el código de cupón si tienes uno.</p>
                            </div>
                            <div class="col-md-8 mb-3 mb-md-0">
                                <input type="text" class="form-control py-3" id="coupon" placeholder="Cósigo del cupón">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-sm">Aplicar cupón</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Total del carrito</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$<?php echo $subtotal; ?></strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black">$<?php echo $total; ?></strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Ir a Pagar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="js/cart.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnEliminar").click(function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var boton = $(this);
                $.ajax({
                    method: 'POST',
                    url: './php/eliminarCarrito.php',
                    data: {
                        id: id
                    }
                }).done(function(respuesta) {
                    boton.parent('td').parent('tr').remove();
                });
            });
            $(".txtCantidad").keyup(function() {
                var cantidad = $(this).val();
                var precio = $(this).data("precio");
                var id = $(this).data("id");
                incrementar(cantidad, precio, id);
            });
            $(".btnIncrementar").click(function() {
                var precio = $(this).parent('div').parent('div').find('input').data('precio');
                var id = $(this).parent('div').parent('div').find('input').data('id');
                var cantidad = $(this).parent('div').parent('div').find('input').val();
                incrementar(cantidad, precio, id);
            });

            function incrementar(cantidad, precio, id) {
                var mult = parseFloat(cantidad) * parseFloat(precio);
                $(".cant" + id).text(mult);
                $.ajax({
                    method: 'POST',
                    url: './php/actualizar.php',
                    data: {
                        id: id,
                        cantidad: cantidad
                    }
                }).done(function(respuesta) {

                });
            }
        });
    </script>

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