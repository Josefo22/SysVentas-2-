<?php
// Verificar si el usuario está autenticado
if (empty($_SESSION['active'])) {
    header('location: ' . BASE_URL . 'Auth');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistema de ventas" />
    <meta name="author" content="SysVentas" />
    <title>SysVenta - <?php echo isset($pageTitle) ? $pageTitle : 'Panel de Control'; ?></title>
    <link href="<?php echo BASE_URL; ?>assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/autocomplete.css">
    <script src="<?php echo BASE_URL; ?>assets/js/all.min.js" crossorigin="anonymous"></script>
    <script>
        const BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <!-- Custom styles for this template-->
    <link href="<?php echo BASE_URL; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/styles.css" rel="stylesheet">
    
    <!-- Estilos para gráficos -->
    <style>
        .chart-area {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        .chart-pie {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .chart-area, .chart-pie {
                height: 250px;
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>Dashboard">SysVenta</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>Usuario/profile">Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>Auth/logout">Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <?php if (isset($_SESSION['permisos']['nueva_venta']) && $_SESSION['permisos']['nueva_venta'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Venta/create">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Nueva venta
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['clientes']) && $_SESSION['permisos']['clientes'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Cliente">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['ventas']) && $_SESSION['permisos']['ventas'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Venta">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Ventas
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['caja']) && $_SESSION['permisos']['caja'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Caja">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Caja
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['compras']) && $_SESSION['permisos']['compras'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Compra">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                            Compras
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['proveedores']) && $_SESSION['permisos']['proveedores'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Proveedor">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck-loading"></i></div>
                            Proveedores
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['productos']) && $_SESSION['permisos']['productos'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Producto">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                            Productos
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['usuarios']) && $_SESSION['permisos']['usuarios'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Usuario">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Usuarios
                        </a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['permisos']['configuracion']) && $_SESSION['permisos']['configuracion'] == 1): ?>
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Configuracion">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Configuración
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2"> 