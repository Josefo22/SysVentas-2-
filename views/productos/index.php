<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Producto/create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Nuevo Producto
    </a>
</div>

<?php if (isset($_GET['success'])) { ?>
    <?php if ($_GET['success'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Producto creado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['success'] == 2) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Producto actualizado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['success'] == 3) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Producto desactivado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['success'] == 4) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Producto activado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
<?php } ?>

<?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Ha ocurrido un error en la operación
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto) { ?>
                                <tr>
                                    <td><?php echo $producto['codproducto']; ?></td>
                                    <td><?php echo $producto['codigo']; ?></td>
                                    <td><?php echo $producto['descripcion']; ?></td>
                                    <td><?php echo number_format($producto['precio'], 2); ?></td>
                                    <td><?php echo $producto['existencia']; ?></td>
                                    <td>
                                        <?php if ($producto['estado'] == 1) { ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Inactivo</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>Producto/edit/<?php echo $producto['codproducto']; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if ($producto['estado'] == 1) { ?>
                                            <a href="<?php echo BASE_URL; ?>Producto/desactivar/<?php echo $producto['codproducto']; ?>" class="btn btn-danger btn-sm btn-desactivar">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo BASE_URL; ?>Producto/activar/<?php echo $producto['codproducto']; ?>" class="btn btn-success btn-sm btn-activar">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            }
        });
        
        // Confirmación de desactivación
        $('.btn-desactivar').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este producto será desactivado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, desactivar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
        
        // Confirmación de activación
        $('.btn-activar').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este producto será activado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, activar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>

<?php require_once 'views/layouts/footer.php'; ?> 