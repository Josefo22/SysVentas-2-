<?php
require_once 'Controller.php';

/**
 * Controlador para el Dashboard
 */
class DashboardController extends Controller {
    private $usuarioModel;
    private $productoModel;
    private $clienteModel;
    private $ventaModel;
    private $cajaModel;
    private $compraModel;
    private $proveedorModel;
    
    /**
     * Constructor de la clase
     */
    public function __construct() {
        parent::__construct();
        $this->usuarioModel = $this->loadModel('Usuario');
        $this->productoModel = $this->loadModel('Producto');
        $this->clienteModel = $this->loadModel('Cliente');
        $this->ventaModel = $this->loadModel('Venta');
        $this->cajaModel = $this->loadModel('Caja');
        $this->compraModel = $this->loadModel('Compra');
        $this->proveedorModel = $this->loadModel('Proveedor');
    }
    
    /**
     * Método para mostrar el dashboard
     */
    public function index() {
        // Verificar si el usuario está logueado
        if (!$this->checkAccess()) {
            return;
        }
        
        // Obtener datos para el dashboard
        $usuarios = count($this->usuarioModel->getUsuariosActivos());
        $productos = count($this->productoModel->getProductosActivos());
        $clientes = count($this->clienteModel->getClientesActivos());
        $ventas = count($this->ventaModel->getVentas());
        
        // Obtener datos para gráficos
        $ventasPorMes = $this->ventaModel->getVentasPorMes();
        $ventasPorDia = $this->ventaModel->getVentasPorDia();
        $productosMasVendidos = $this->ventaModel->getProductosMasVendidos(5);
        $ventasPorCategoria = $this->ventaModel->getVentasPorCategoria();
        
        // Datos para la vista
        $data = [
            'pageTitle' => 'Dashboard',
            'usuarios' => $usuarios,
            'productos' => $productos,
            'clientes' => $clientes,
            'ventas' => $ventas,
            'ventasPorMes' => $ventasPorMes,
            'ventasPorDia' => $ventasPorDia,
            'productosMasVendidos' => $productosMasVendidos,
            'ventasPorCategoria' => $ventasPorCategoria
        ];
        
        $this->view('dashboard/index', $data);
    }
    
    /**
     * Método para obtener datos para las gráficas (vía AJAX)
     */
    public function getChartData() {
        // Verificar si el usuario está logueado
        if (!$this->checkAccess()) {
            return;
        }
        
        // Datos para las gráficas
        $ventasPorMes = $this->ventaModel->getVentasPorMes();
        $ventasPorDia = $this->ventaModel->getVentasPorDia();
        $productosMasVendidos = $this->ventaModel->getProductosMasVendidos(5);
        $ventasPorCategoria = $this->ventaModel->getVentasPorCategoria();
        
        $data = [
            'ventasPorMes' => $ventasPorMes,
            'ventasPorDia' => $ventasPorDia,
            'productosMasVendidos' => $productosMasVendidos,
            'ventasPorCategoria' => $ventasPorCategoria
        ];
        
        // Devolver datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>