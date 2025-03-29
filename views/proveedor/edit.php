<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Proveedor" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php } ?>

<div class="card">
    <div class="card-body">
        <form action="<?php echo BASE_URL; ?>Proveedor/update" method="POST">
            <input type="hidden" name="id" value="<?php echo $proveedor['idproveedor']; ?>">
            
            <div class="form-group">
                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $proveedor['nombre']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $proveedor['telefono']; ?>">
            </div>
            
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $proveedor['direccion']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?> 