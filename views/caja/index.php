<?php require_once 'views/layouts/header.php'; ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $pageTitle; ?></h1>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="<?php echo BASE_URL; ?>Caja" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="fecha" class="mr-2">Seleccionar fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Ventas del Día</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo number_format($totalVentas, 2); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Número de Ventas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numeroVentas; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Promedio por Venta</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            $<?php echo $numeroVentas > 0 ? number_format($totalVentas / $numeroVentas, 2) : '0.00'; ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Productos Más Vendidos del Día</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($productosMasVendidos)) : ?>
                                <?php foreach ($productosMasVendidos as $producto) : ?>
                                    <tr>
                                        <td><?php echo isset($producto['descripcion']) ? $producto['descripcion'] : ''; ?></td>
                                        <td><?php echo isset($producto['total_vendido']) ? $producto['total_vendido'] : ''; ?></td>
                                        <td>$<?php echo isset($producto['total_ingresos']) ? number_format($producto['total_ingresos'], 2) : '0.00'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay productos vendidos</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Resumen de Ventas</h6>
            </div>
            <div class="card-body">
                <div id="ventas-chart"></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ventas del Día</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Hora</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ventas)) : ?>
                        <?php foreach ($ventas as $venta) : ?>
                            <tr>
                                <td><?php echo isset($venta['id']) ? $venta['id'] : ''; ?></td>
                                <td><?php echo isset($venta['cliente']) ? $venta['cliente'] : ''; ?></td>
                                <td><?php echo isset($venta['vendedor']) ? $venta['vendedor'] : ''; ?></td>
                                <td><?php echo isset($venta['fecha']) ? date('H:i:s', strtotime($venta['fecha'])) : ''; ?></td>
                                <td>$<?php echo isset($venta['total']) ? number_format($venta['total'], 2) : '0.00'; ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>Venta/ver/<?php echo isset($venta['id']) ? $venta['id'] : ''; ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>Venta/pdf/<?php echo isset($venta['id']) ? $venta['id'] : ''; ?>" class="btn btn-danger btn-sm" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay ventas registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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