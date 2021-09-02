<?php
// include header.php file
include('header.php');
?>

<body>

    <body class="bg-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mt-3">
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
                    if (isset($_GET['success'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se ha enviado el correo correctamente. Le estaremos respondiendo en un plazo breve.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="card border-danger shadow">
                        <div class="card-header bg-danger text-light">
                            <h3 class="card-title">Contacta con Soporte</h3>
                        </div>
                        <div class="card-body px-4">
                            <form action="./php/mailsoporte.php" method="POST">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Asunto</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Escribe el asunto" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Mensaje</label>
                                    <textarea name="message" id="message" rows="5" class="form-control" placeholder="Escribe el mensaje" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Enviar" class="btn btn-danger btn-block" id="sendBtn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>