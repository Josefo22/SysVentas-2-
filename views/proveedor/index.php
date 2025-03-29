<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Proveedor/create" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nuevo Proveedor
    </a>
</div>

<?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['success']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php } ?>

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
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tblProveedores" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($proveedores)) { ?>
                        <?php foreach ($proveedores as $proveedor) { ?>
                            <tr>
                                <td><?php echo $proveedor['idproveedor']; ?></td>
                                <td><?php echo $proveedor['nombre']; ?></td>
                                <td><?php echo $proveedor['telefono']; ?></td>
                                <td><?php echo $proveedor['direccion']; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL . 'Proveedor/edit/' . $proveedor['idproveedor']; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL . 'Proveedor/delete/' . $proveedor['idproveedor']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este proveedor?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay proveedores registrados</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tblProveedores').DataTable({
            language: {
                url: '<?php echo BASE_URL; ?>assets/js/spanish.json'
            }
        });
    });
</script>

<?php require_once 'views/layouts/footer.php'; ?> 