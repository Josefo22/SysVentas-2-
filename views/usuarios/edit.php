<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Usuario" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<?php if (isset($_GET['error'])) { ?>
    <?php if ($_GET['error'] == 1) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Todos los campos son obligatorios
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['error'] == 2) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Error al actualizar el usuario
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
<?php } ?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Usuario/update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario['idusuario']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_rol">Rol</label>
                        <select class="form-control" id="id_rol" name="id_rol" required>
                            <option value="">Seleccione un rol</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?php echo $rol['id']; ?>" <?php echo ($usuario['id_rol'] == $rol['id']) ? 'selected' : ''; ?>><?php echo $rol['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?> 