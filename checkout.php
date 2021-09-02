<?php
// include header.php file
include('header.php');
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
$arreglo = $_SESSION['carrito'];
?>


<!-- Include the PayPal JavaScript SDK; replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AZjrDYhsZbDBeEPrVvpd1WuFI1-F3FzvTSVR84qs89H1g2GZYy2vwY9I0Op1-y2h6r6by01zXRzZ0AWc&disable-funding=card"></script>
<div class="site-wrap">
    <form action="./php/insertarpedido.php" method="post" id="formulariodatos">
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="border p-4 rounded" role="alert">
                            ¿Ya tienes una cuenta? <a href="#">Haga click aquí</a> para iniciar sesión
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Detalles de Pago</h2>
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group">
                                <label for="c_country" class="text-black">País <span class="text-danger">*</span></label>
                                <select id="c_country" class="form-control" name="country">
                                    <option value="1">Seleccione un país</option>
                                    <option value="2">Perú</option>
                                    <!--
                                    <option value="3">Algeria</option>
                                    <option value="4">Afghanistan</option>
                                    <option value="5">Ghana</option>
                                    <option value="6">Albania</option>
                                    <option value="7">Bahrain</option>
                                    <option value="8">Colombia</option>
                                    <option value="9">Dominican Republic</option> -->
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Apellido Paterno <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                                </div>
                            </div>

                            <!--<div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_companyname" class="text-black">Company Name </label>
                                    <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Calle/Av./Jr.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_state_country" class="text-black">Distrito <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_postal_zip" class="text-black">Código Postal<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                                </div>
                            </div>

                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_phone" class="text-black">Teléfono <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Nro. de teléfono">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> ¿Crear una cuenta?</label>
                                <div class="collapse" id="create_an_account">
                                    <div class="py-2">
                                        <p class="mb-3">Crea una cuenta ingresando la siguiente información. Si ya tiene una, inicie sesión en la parte superior</p>
                                        <div class="form-group">
                                            <label for="c_account_password" class="text-black">Contraseña nueva</label>
                                            <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--<div class="form-group">
                                <label for="c_ship_different_address" class="text-black" data-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
                                <div class="collapse" id="ship_different_address">
                                    <div class="py-2">

                                        <div class="form-group">
                                            <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
                                            <select id="c_diff_country" class="form-control">
                                                <option value="1">Select a country</option>
                                                <option value="2">bangladesh</option>
                                                <option value="3">Algeria</option>
                                                <option value="4">Afghanistan</option>
                                                <option value="5">Ghana</option>
                                                <option value="6">Albania</option>
                                                <option value="7">Bahrain</option>
                                                <option value="8">Colombia</option>
                                                <option value="9">Dominican Republic</option>
                                            </select>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="c_diff_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_fname" name="c_diff_fname">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="c_diff_lname" class="text-black">Apellido Paterno <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_lname" name="c_diff_lname">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="c_diff_companyname" class="text-black">Company Name </label>
                                                <input type="text" class="form-control" id="c_diff_companyname" name="c_diff_companyname">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label for="c_diff_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_address" name="c_diff_address" placeholder="Street address">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="c_diff_state_country" class="text-black">Estado/País<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_state_country" name="c_diff_state_country">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="c_diff_postal_zip" class="text-black">Código Postal <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-5">
                                            <div class="col-md-6">
                                                <label for="c_diff_email_address" class="text-black">Correo electrónico <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_email_address" name="c_diff_email_address">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="c_diff_phone" class="text-black">Teléfono <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="c_diff_phone" name="c_diff_phone" placeholder="Teléfono">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>-->

                            <div class="form-group">
                                <label for="c_order_notes" class="text-black">Notas de la orden</label>
                                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Escribe tus instrucciones aquí..."></textarea>
                            </div>

                        </div>-->
                    </div>
                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Código de cupón</h2>
                                <div class="p-3 p-lg-5 border">

                                    <label for="c_code" class="text-black mb-3">Ingresa el código de cupón si tienes uno</label>
                                    <div class="input-group w-75">
                                        <input type="text" class="form-control" id="c_code" placeholder="Código de cupón" aria-label="Coupon Code" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Tu orden</h2>
                                <div class="p-3 p-lg-5 border">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Producto</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            for ($i = 0; $i < count($arreglo); $i++) {
                                                $total =  ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
                                            ?>
                                                <tr>
                                                    <td><?php echo $arreglo[$i]['Nombre'] ?> <strong class="mx-2">x</strong> 1</td>
                                                    <td>$<?php echo number_format($arreglo[$i]['Precio'], 2, '.', ''); ?></td>
                                                </tr>
                                            <?php
                                            }
                                            $subtotal = $total - (0.18 * $total);
                                            ?>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Subtotal del carrito</strong></td>
                                                <td class="text-black">$<?php echo number_format($subtotal, 2, '.', ''); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Total</strong></td>
                                                <td class="text-black font-weight-bold"><strong>$<?php echo number_format($total, 2, '.', ''); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!--
                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Transferencia bancaria</a></h3>

                                        <div class="collapse" id="collapsebank">
                                            <div class="py-2">
                                                <p class="mb-0">Realice el pago directamente a nuestra cuenta bancaria. Por favor, utilice el nro. de orden como referencia para el pago. La orden no será enviada hasta que se haya procesado la transferencia.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border p-3 mb-3">
                                        <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                        <div class="collapse" id="collapsecheque">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>-->

                                    <div class="border p-3 mb-5">
                                        <h3 class="h6 mb-0">
                                            <!--<a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">-->PayPal
                                        </h3>
                                        <div class="py-2">
                                            <p class="mb-0">Para generar su orden, deberá continuar con el pago usando PayPal.</p>
                                        </div>
                                        <!--<div class="collapse" id="collapsepaypal">
                                            <div class="py-2">
                                                <p class="mb-0">Para generar su orden, deberá continuar con el pago usando PayPal.</p>
                                            </div>
                                            //Set up a container element for the button
                                            <div id="paypal-button-container"></div>
                                        </div>-->
                                    </div>

                                    <!-- Set up a container element for the button -->
                                    <div id="paypal-button-container"></div>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </form>


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


<script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill'
        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                //console.log(details);
                // This function shows a transaction success message to your buyer.
                //alert('Transaction completed by ' + details.payer.name.given_name);
                if (details.status == 'COMPLETED') {
                    var payment_ID = details.id;
                    var formulario = document.getElementById("formulariodatos");
                    formulario.submit();
                }
            });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>


</body>

</html>