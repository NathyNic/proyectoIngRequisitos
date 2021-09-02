<?php
include("../con_db.php");
session_start();

if (!isset($_SESSION['datos_logad'])) {
    header("Location: ./login.php");
}

$arregloAd = $_SESSION['datos_logad'];

$resultado = $conex->query("select ventas.*, datos.name, datos.apellido, 
datos.telefono, datos.email from ventas
inner join datos on ventas.id_usuario = datos.id ") or die($conex->error);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php include "./layouts/header.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pedidos</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Insertar producto
                            </button>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php
                    if (isset($_GET['error'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['error'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($_GET['successin'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se ha insertado correctamente
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <?php
                    if (isset($_GET['successed'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se ha editado el producto correctamente
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <?php
                    if (isset($_GET['errored'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_GET['errored'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>

                    <div id="accordion">
                        <?php
                        while ($f = mysqli_fetch_array($resultado)) {

                        ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $f['id']; ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $f['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo $f['fecha'] . '-' . $f['name'] . $f['apellido']; ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?php echo $f['id']; ?>" class="collapse" aria-labelledby="heading<?php echo $f['id']; ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>Nombre Cliente: <?php echo $f['name'] . $f['apellido']; ?> </p>
                                        <p>Email Cliente: <?php echo $f['email']; ?> </p>
                                        <p>Teléfono Cliente: <?php echo $f['telefono']; ?> </p>
                                        <p>Status: <b><?php echo $f['status']; ?> </b></p>
                                        <p class="h2">Datos de envío</p>
                                        <?php
                                        $re = $conex->query("select * from envios where id_venta=" . $f['id'] . "") or die($conex->error);
                                        $fila = mysqli_fetch_row($re);
                                        ?>
                                        <p>Dirección: <?php echo $fila[2]; ?> </p>
                                        <p>Distrito: <?php echo $fila[3]; ?> </p>
                                        <p>Código postal: <?php echo $fila[4]; ?> </p>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $res = $conex->query("select productos_venta.*, productoshardware.nombre
                                                from productos_venta inner join productoshardware on productos_venta.id_producto = productoshardware.id
                                                where productos_venta.id_venta=" . $f['id'] . " ") or die($conex->error);

                                                while ($f2 = mysqli_fetch_array($res)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo $f['id']; ?></td>
                                                        <td><?php echo $f2['nombre']; ?></td>
                                                        <td>S/ <?php echo number_format($f2['precio'], 2, '.', '');  ?></td>
                                                        <td><?php echo $f2['cantidad']; ?></td>
                                                        <td><?php echo $f2['total']; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    </div>

                <?php } ?>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- Modal Insertar Producto-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="./php/insertarproducto.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insertar producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" placeholder="Marca" id="marca" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" name="descripcion" placeholder="Descripcion" id="descripcion" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="number" min="0" name="precio" placeholder="Precio" id="precio" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" min="0" name="stock" placeholder="Stock" id="stock" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <input type="text" name="tipo" placeholder="Tipo" id="tipo" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar Producto-->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEliminarLabel">Insertar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Desea eliminar el producto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Sí</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Editar Producto-->
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="./php/editarproducto.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarLabel">Editar producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idEdit" name="id">
                            <div class="form-group">
                                <label for="nombreEdit">Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="marcaEdit">Marca</label>
                                <input type="text" name="marca" placeholder="Marca" id="marcaEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcionEdit">Descripción</label>
                                <input type="text" name="descripcion" placeholder="Descripcion" id="descripcionEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="precioEdit">Precio</label>
                                <input type="number" min="0" name="precio" placeholder="Precio" id="precioEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="stockEdit">Stock</label>
                                <input type="number" min="0" name="stock" placeholder="Stock" id="stockEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoEdit">Tipo</label>
                                <input type="text" name="tipo" placeholder="Tipo" id="tipoEdit" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary editar">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include "./layouts/footer.php" ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./dashboard/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./dashboard/plugins/moment/moment.min.js"></script>
    <script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dashboard/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dashboard/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./dashboard/dist/js/pages/dashboard.js"></script>

    <script>
        $(document).ready(function() {
            var idEliminar = -1;
            var idEditar = -1;
            var fila;
            $(".btnEliminar").click(function() {
                idEliminar = $(this).data('id');
                fila = $(this).parent('td').parent('tr');
            });
            $(".eliminar").click(function() {
                $.ajax({
                    url: './php/eliminarproducto.php',
                    method: 'POST',
                    data: {
                        id: idEliminar,
                    }
                }).done(function(res) {
                    $(fila).fadeOut(1000);
                });
            });
            $(".btnEditar").click(function() {
                idEditar = $(this).data('id');
                var nombre = $(this).data('nombre');
                var marca = $(this).data('marca');
                var precio = $(this).data('precio');
                var descripcion = $(this).data('descripcion');
                var stock = $(this).data('stock');
                var tipo = $(this).data('tipo');
                $("#idEdit").val(idEditar);
                $("#nombreEdit").val(nombre);
                $("#marcaEdit").val(marca);
                $("#precioEdit").val(precio);
                $("#descripcionEdit").val(descripcion);
                $("#stockEdit").val(stock);
                $("#tipoEdit").val(tipo);
            });
        });
    </script>
</body>

</html>