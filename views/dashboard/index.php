<?php require_once 'views/layouts/header.php'; ?>

<h1 class="mt-4">Panel de Control</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<div class="row">
    <?php if (isset($_SESSION['permisos']['clientes']) && $_SESSION['permisos']['clientes'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Clientes</div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $clientes; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Cliente">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['productos']) && $_SESSION['permisos']['productos'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Productos</div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $productos; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-product-hunt fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Producto">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['ventas']) && $_SESSION['permisos']['ventas'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Ventas</div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $ventas; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Venta">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['caja']) && $_SESSION['permisos']['caja'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Caja</div>
                        <div class="h5 mb-0 font-weight-bold">
                            <i class="fas fa-cash-register"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Caja">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['compras']) && $_SESSION['permisos']['compras'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Compras</div>
                        <div class="h5 mb-0 font-weight-bold">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Compra">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['proveedores']) && $_SESSION['permisos']['proveedores'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Proveedores</div>
                        <div class="h5 mb-0 font-weight-bold">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-people-carry fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Proveedor">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['usuarios']) && $_SESSION['permisos']['usuarios'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Usuarios</div>
                        <div class="h5 mb-0 font-weight-bold"><?php echo $usuarios; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Usuario">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['permisos']['configuracion']) && $_SESSION['permisos']['configuracion'] == 1): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Configuración</div>
                        <div class="h5 mb-0 font-weight-bold">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cog fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo BASE_URL; ?>Configuracion">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Gráficos de Ventas -->
<div class="row">
    <!-- Gráfico de Ventas por Mes -->
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ventas por Mes (Último Año)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="ventasPorMesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ventas por Día -->
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ventas por Día (Última Semana)</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="ventasPorDiaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Gráfico de Productos Más Vendidos -->
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Productos Más Vendidos</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie">
                    <canvas id="productosMasVendidosChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ventas por Categoría -->
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ventas por Producto</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie">
                    <canvas id="ventasPorCategoriaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos para el gráfico de ventas por mes
        const ventasPorMesData = <?php echo json_encode($ventasPorMes); ?>;
        const mesesLabels = ventasPorMesData.map(item => item.mes);
        const ventasTotales = ventasPorMesData.map(item => item.total);
        
        // Configuración del gráfico de ventas por mes
        const ventasPorMesChart = new Chart(
            document.getElementById('ventasPorMesChart'),
            {
                type: 'line',
                data: {
                    labels: mesesLabels,
                    datasets: [{
                        label: 'Ventas Mensuales',
                        data: ventasTotales,
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointBorderColor: 'rgba(78, 115, 223, 1)',
                        pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                        pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            }
        );
        
        // Datos para el gráfico de ventas por día
        const ventasPorDiaData = <?php echo json_encode($ventasPorDia); ?>;
        const diasLabels = ventasPorDiaData.map(item => item.dia);
        const ventasDiarias = ventasPorDiaData.map(item => item.total);
        
        // Configuración del gráfico de ventas por día
        const ventasPorDiaChart = new Chart(
            document.getElementById('ventasPorDiaChart'),
            {
                type: 'bar',
                data: {
                    labels: diasLabels,
                    datasets: [{
                        label: 'Ventas Diarias',
                        data: ventasDiarias,
                        backgroundColor: 'rgba(28, 200, 138, 0.8)',
                        borderColor: 'rgba(28, 200, 138, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            }
        );
        
        // Datos para el gráfico de productos más vendidos
        const productosMasVendidosData = <?php echo json_encode($productosMasVendidos); ?>;
        const productosLabels = productosMasVendidosData.map(item => item.descripcion);
        const productosCantidades = productosMasVendidosData.map(item => item.cantidad);
        
        // Configuración del gráfico de productos más vendidos
        const productosMasVendidosChart = new Chart(
            document.getElementById('productosMasVendidosChart'),
            {
                type: 'doughnut',
                data: {
                    labels: productosLabels,
                    datasets: [{
                        data: productosCantidades,
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(28, 200, 138, 0.8)',
                            'rgba(246, 194, 62, 0.8)',
                            'rgba(231, 74, 59, 0.8)',
                            'rgba(54, 185, 204, 0.8)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
                            'rgba(28, 200, 138, 1)',
                            'rgba(246, 194, 62, 1)',
                            'rgba(231, 74, 59, 1)',
                            'rgba(54, 185, 204, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    }
                }
            }
        );
        
        // Datos para el gráfico de ventas por categoría
        const ventasPorCategoriaData = <?php echo json_encode($ventasPorCategoria); ?>;
        const categoriasLabels = ventasPorCategoriaData.map(item => item.categoria);
        const categoriasTotales = ventasPorCategoriaData.map(item => item.total);
        
        // Configuración del gráfico de ventas por categoría
        const ventasPorCategoriaChart = new Chart(
            document.getElementById('ventasPorCategoriaChart'),
            {
                type: 'pie',
                data: {
                    labels: categoriasLabels,
                    datasets: [{
                        data: categoriasTotales,
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(28, 200, 138, 0.8)',
                            'rgba(246, 194, 62, 0.8)',
                            'rgba(231, 74, 59, 0.8)',
                            'rgba(54, 185, 204, 0.8)',
                            'rgba(104, 109, 224, 0.8)',
                            'rgba(225, 112, 85, 0.8)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
                            'rgba(28, 200, 138, 1)',
                            'rgba(246, 194, 62, 1)',
                            'rgba(231, 74, 59, 1)',
                            'rgba(54, 185, 204, 1)',
                            'rgba(104, 109, 224, 1)',
                            'rgba(225, 112, 85, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    }
                }
            }
        );
    });
</script>

<?php require_once 'views/layouts/footer.php'; ?>