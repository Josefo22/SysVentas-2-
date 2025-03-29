<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detalle de Venta</h1>
    <a href="<?php echo BASE_URL; ?>Venta" class="btn btn-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Información de la Venta</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Cliente:</strong> <?php echo $venta['cliente']; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Vendedor:</strong> <?php echo $venta['vendedor']; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Fecha:</strong> <?php echo date('d/m/Y', strtotime($venta['fecha'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Productos</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = 0;
                            foreach ($detalle as $item) { 
                                $subtotal = $item['cantidad'] * $item['precio'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td><?php echo $item['producto']; ?></td>
                                    <td><?php echo $item['cantidad']; ?></td>
                                    <td><?php echo number_format($item['precio'], 2); ?></td>
                                    <td><?php echo number_format($subtotal, 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold">TOTAL</td>
                                <td class="font-weight-bold"><?php echo number_format($total, 2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-md-4">
        <a href="<?php echo BASE_URL; ?>Venta/pdf/<?php echo $venta['id']; ?>" class="btn btn-danger btn-block" target="_blank">
            <i class="fas fa-file-pdf"></i> Generar PDF
        </a>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?> 