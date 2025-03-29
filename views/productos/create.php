<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nuevo Producto</h1>
    <a href="<?php echo BASE_URL; ?>Producto" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<?php if (isset($errores['campos_obligatorios'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $errores['campos_obligatorios']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($errores['codigo_existente'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $errores['codigo_existente']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (isset($errores['error_creacion'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $errores['error_creacion']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo BASE_URL; ?>Producto/store" method="POST">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
                    </div>
                    <div class="form-group">
                        <label for="existencia">Stock</label>
                        <input type="number" min="0" class="form-control" id="existencia" name="existencia" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?> 