<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detalle de Compra</h1>
    <a href="<?php echo BASE_URL; ?>Compra" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Información de la Compra</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Proveedor:</strong> <?php echo isset($compra['proveedor']) ? $compra['proveedor'] : ''; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Usuario:</strong> <?php echo isset($compra['usuario']) ? $compra['usuario'] : ''; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha:</strong> <?php echo isset($compra['fecha']) ? date('d/m/Y', strtotime($compra['fecha'])) : ''; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Productos</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detalle)) : ?>
                                <?php foreach ($detalle as $item) : ?>
                                    <tr>
                                        <td><?php echo isset($item['descripcion']) ? $item['descripcion'] : ''; ?></td>
                                        <td><?php echo isset($item['cantidad']) ? $item['cantidad'] : ''; ?></td>
                                        <td>$<?php echo isset($item['precio']) ? number_format($item['precio'], 2) : '0.00'; ?></td>
                                        <td>$<?php echo isset($item['cantidad']) && isset($item['precio']) ? number_format($item['cantidad'] * $item['precio'], 2) : '0.00'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">No hay productos en esta compra</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold">TOTAL</td>
                                <td class="font-weight-bold">$<?php echo isset($compra['total']) ? number_format($compra['total'], 2) : '0.00'; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?> 