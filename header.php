<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HADTECSOFT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css?v=<?php echo time(); ?>" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="js/popper.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/w3.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/w3-theme-pink.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/index1.css?v=<?php echo time(); ?>">
    <script src="js/jquery-3.6.0.js?v=<?php echo time(); ?>"></script>
    <script src="js/mostrar.js?v=<?php echo time(); ?>"></script>
    <script src="https://kit.fontawesome.com/647c5e73f8.js?v=<?php echo time(); ?>" crossorigin="anonymous"></script>



</head>

<body>

    <div class="header">
        <nav>
            <div class="menu-icon">
                <span class="fas fa-bars"></span>
            </div>
            <div class="logo">
                <img type="button" src="image/Logo HadtecSoft (1).png" width="125px" onclick="window.location.href='index.php'">
            </div>
            <div class="nav-items" style="margin-top:18px;">
                <?php
                session_start();
                ?>
                <li><a href="productos.php">Catálogo</a></li>
                <li><a href="soporte.php">Contacto</a></li>
                <li><a href="#">Cuenta</a></li>
                <li>
                    <a href="cart.php" class="site-cart">
                        <span class="fas fa-shopping-cart"></span>
                        <span class="count">
                            <?php
                            if (isset($_SESSION['carrito'])) {
                                echo count($_SESSION['carrito']);
                            } else {
                                echo (0);
                            }
                            ?>
                        </span>
                    </a>
                </li>
                <form class="busc" action="results.php" method="get" style="margin-left:auto">
                    <input type="search" class="search-data" name="busqueda" placeholder="Buscar" required>
                    <button type="submit" name="enviar" class="fas fa-search"></button>
                </form>
                <div class="search-icon">
                    <span class="fas fa-search"></span>
                </div>
                <div class="cancel-icon">
                    <span class="fas fa-times"></span>
                </div>

        </nav>
    </div>