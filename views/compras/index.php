<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
    <a href="<?php echo BASE_URL; ?>Compra/create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Nueva Compra
    </a>
</div>

<?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Compra registrada correctamente
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
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
                                <th>Proveedor</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($compras)) : ?>
                                <?php foreach ($compras as $compra) : ?>
                                    <tr>
                                        <td><?php echo isset($compra['id']) ? $compra['id'] : ''; ?></td>
                                        <td><?php echo isset($compra['proveedor']) ? $compra['proveedor'] : ''; ?></td>
                                        <td><?php echo isset($compra['usuario']) ? $compra['usuario'] : ''; ?></td>
                                        <td><?php echo isset($compra['fecha']) ? date('d/m/Y', strtotime($compra['fecha'])) : ''; ?></td>
                                        <td><?php echo isset($compra['total']) ? number_format($compra['total'], 2) : '0.00'; ?></td>
                                        <td>
                                            <a href="<?php echo BASE_URL; ?>Compra/ver/<?php echo isset($compra['id']) ? $compra['id'] : ''; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay compras registradas</td>
                                </tr>
                            <?php endif; ?>
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
            },
            order: [[0, 'desc']]
        });
    });
</script>

<?php require_once 'views/layouts/footer.php'; ?> 