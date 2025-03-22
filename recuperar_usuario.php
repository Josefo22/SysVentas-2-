<?php
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['email'])) {
        $alert = '<div class="alert alert-danger" role="alert">Por favor, ingrese su correo electrónico</div>';
    } else {
        require_once "conexion.php";
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        
        // Verificar si el correo existe en la base de datos
        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo = '$email' AND estado = 1");
        mysqli_close($conexion);
        $resultado = mysqli_num_rows($query);
        
        if ($resultado > 0) {
            // Aquí puedes agregar el envío de un correo electrónico para la recuperación
            $alert = '<div class="alert alert-success" role="alert">
                Se han enviado las instrucciones a tu correo.
            </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                No se encontró una cuenta con este correo.
            </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SysVenta</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="assets/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                    <img class="img-thumbnail" src="assets/img/logo.jpeg" width="150">
                                    <h3 class="font-weight-light my-4">Recuperar Usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="email"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                            <input class="form-control py-4" id="email" name="email" type="email" placeholder="Ingrese su correo electrónico" required />
                                        </div>
                                        <?php echo isset($alert) ? $alert : ''; ?>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Recuperar cuenta</button>
                                            <a href="index.php" class="small">Volver al inicio de sesión</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Hecho por Juan José &copy; Copyright &copy; <?php echo date("Y"); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
