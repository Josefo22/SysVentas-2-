<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Cliente/create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Nuevo Cliente
    </a>
</div>

<?php if (isset($_GET['success'])) { ?>
    <?php if ($_GET['success'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Cliente creado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['success'] == 2) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Cliente actualizado correctamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($_GET['success'] == 3) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Cliente eliminado correctamente
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
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Cédula</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $cliente) { ?>
                                <tr>
                                    <td><?php echo $cliente['idcliente']; ?></td>
                                    <td><?php echo $cliente['nombre']; ?></td>
                                    <td><?php echo $cliente['telefono']; ?></td>
                                    <td><?php echo $cliente['direccion']; ?></td>
                                    <td><?php echo $cliente['cedula']; ?></td>
                                    <td>
                                        <?php if ($cliente['estado'] == 1) { ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Inactivo</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>Cliente/edit/<?php echo $cliente['idcliente']; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>Cliente/delete/<?php echo $cliente['idcliente']; ?>" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
        
        // Confirmación de eliminación
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este cliente será eliminado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
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