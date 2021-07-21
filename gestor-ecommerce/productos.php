<?php include('config/con_db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.css">
    <title>Administración|Principal</title>
</head>

<body>
    <div class="main-container">
        <div class="body-nav-bar">
            <img src="assets/Logo HadtecSoft (1).png" alt="">
            <center>
                <h3>Administrador</h3>
            </center>
            <ul class="mt10">
                <li><a href="main.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="">Salir</a></li>
            </ul>
        </div>
        <div class="body-page">
            <h2>Mis productos</h2>
            <table class="mt-10">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th class="td-option">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from productoshardware";
                    $resultado = mysqli_query($conex, $sql);
                    while ($row = mysqli_fetch_array($resultado)) {
                        echo
                        ' <tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['nombre'] . '</td>
                            <td>' . $row['tipo'] . '</td>
                            <td>' . $row['descripcion'] . '</td>
                            <td>' . $row['precio'] . '</td>
                            <td class="td-option">
                                <div class="div-flex div-td-button">
                                    <button><i class="fas fa-edit"></i></button>
                                    <button><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <button class="mt-10">Agregar nuevo</button>
        </div>
    </div>
</body>

</html>