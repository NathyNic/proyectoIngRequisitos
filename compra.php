<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/popper.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/index1.css?v=<?php echo time(); ?>">

    <title>HADTECSOFT</title>

</head>

<body>
    <div class="header">
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span>
            </div>
            <div class="logo">
                <a href="index.php"><img src="image/Logo HadtecSoft (1).png" width="125px" onclick="window.location.href='index.php'"></a>
            </div>
            <div class="nav-items" style="margin-top:18px;">
                <?php
                session_start();
                if (!empty($_SESSION['username'])) {
                    $nombre = $_SESSION['username'];
                    $apellido = $_SESSION['apellido'];
                    $email = $_SESSION['email'];
                ?>

                    <li><a href="productos.php">Catálogo</a></li>
                    <li><a href="soporte.php">Contacto</a></li>
                    <li class="anchar"><a href="#"><?php echo $nombre; ?></a></li>
                    <li><a href="login.php">Salir</a></li>
                <?php
                } else {
                    header("location:login.php");
                }
                ?>
                <div class="collapse navbar-collapse show" id="navbarCollapse" style="margin-left:300px;">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown show">
                            <img src="img/cart.jpeg" class="nav-link dropdown-toggle img-fluid" height="30px" width="30px" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></img>
                            <div id="carrito" class="dropdown-menu" aria-labelledby="navbarCollapse">
                                <table id="lista-carrito" class="table">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <a href="#" id="vaciar-carrito" class="btn btn-primary btn-block blanco" style="color:white;">Vaciar Carrito</a>
                                <a href="#" id="procesar-pedido" class="btn btn-danger btn-block blanco" style="color:white;">Procesar
                                    Compra</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="search-icon">
                <span class="fas fa-search"></span>
            </div>
            <div class="cancel-icon">
                <span class="fas fa-times"></span>
            </div>
            <form action="results.php" method="get" style="margin-top:17px;">
                <input type="search" class="search-data" name="busqueda" placeholder="Buscar" required>
                <button type="submit" name="enviar" class="fas fa-search"></button>
            </form>
        </nav>
    </div>


    <br>

    <main>
        <div class="container">
            <div class="row mt-3">
                <div class="col">
                    <h2 class="d-flex justify-content-center mb-3">Realizar Compra</h2>
                    <form id="procesar-pago">
                        <div class="form-group row">
                            <label for="cliente" class="col-12 col-md-2 col-form-label h2">Cliente :</label>
                            <div class="col-12 col-md-10">
                                <input type="text" class="form-control" id="cliente" placeholder="<?php echo $nombre . ' ' . $apellido; ?>" name="destinatario" value="<?php echo $nombre . ' ' . $apellido; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-12 col-md-2 col-form-label h2">Correo :</label>
                            <div class="col-12 col-md-10">
                                <input type="text" class="form-control" id="correo" placeholder="<?php echo $email; ?>" name="cc_to" value="<?php echo $email; ?>">
                            </div>
                        </div>

                        <div id="carrito" class="form-group table-responsive">
                            <table class="form-group table" id="lista-compra">
                                <thead>
                                    <tr>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col"></th>
                                        <th scope="col">Sub Total</th>

                                    </tr>

                                </thead>
                                <tbody>

                                </tbody>
                                <tr>
                                    <th colspan="4" scope="col" class="text-right">SUB TOTAL :</th>
                                    <th scope="col">
                                        <p id="subtotal"></p>
                                    </th>

                                </tr>
                                <tr>
                                    <th colspan="4" scope="col" class="text-right">IGV :</th>
                                    <th scope="col">
                                        <p id="igv"></p>
                                    </th>

                                </tr>
                                <tr>
                                    <th colspan="4" scope="col" class="text-right">TOTAL :</th>
                                    <th scope="col">
                                        <input id="total" name="monto" class="font-weight-bold border-0" readonly style="background-color: white;"></input>
                                    </th>

                                </tr>

                            </table>
                        </div>

                        <div class="row justify-content-center" id="loaders">
                            <img id="cargando" src="img/cargando.gif" width="220">
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="productos.php" class="btn btn-info btn-block">Seguir comprando</a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <input type="submit" class="btn btn-success btn-block" id="procesar-compra" value="Finalizar Compra">
                            </div>
                        </div>
                    </form>


                </div>


            </div>

        </div>
    </main>





    </div>

    <script src="js/jquery-3.4.1.min.js?v=<?php echo time(); ?>"></script>
    <script src="js/bootstrap.min.js?v=<?php echo time(); ?>"></script>
    <script src="js/sweetalert2.min.js?v=<?php echo time(); ?>"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js?v=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2/dist/email.min.js?v=<?php echo time(); ?>"></script>

    <script src="js/carrito.js?v=<?php echo time(); ?>"></script>
    <script src="js/compra.js?v=<?php echo time(); ?>"></script>


</body>

</html>