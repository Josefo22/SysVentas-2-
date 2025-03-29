<?php
require_once 'Model.php';

/**
 * Clase modelo para gestionar la caja
 */
class CajaModel extends Model {
    protected $table = 'caja';
    
    /**
     * Constructor de la clase
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Método para obtener las ventas del día actual
     */
    public function getVentasDia($fecha = null) {
        // Si no se proporciona fecha, usar la fecha actual
        if ($fecha === null) {
            $fecha = date('Y-m-d');
        }
        
        $query = "SELECT v.*, c.nombre as cliente, u.nombre as vendedor 
                FROM ventas v 
                INNER JOIN cliente c ON v.id_cliente = c.idcliente 
                INNER JOIN usuario u ON v.id_usuario = u.idusuario 
                WHERE DATE(v.fecha) = ? 
                ORDER BY v.fecha DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $ventas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ventas[] = $row;
            }
        }
        
        return $ventas;
    }
    
    /**
     * Método para obtener el total de ventas del día
     */
    public function getTotalVentasDia($fecha = null) {
        // Si no se proporciona fecha, usar la fecha actual
        if ($fecha === null) {
            $fecha = date('Y-m-d');
        }
        
        $query = "SELECT SUM(total) as total FROM ventas WHERE DATE(fecha) = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'] ?? 0;
        }
        
        return 0;
    }
    
    /**
     * Método para obtener el número de ventas del día
     */
    public function getNumeroVentasDia($fecha = null) {
        // Si no se proporciona fecha, usar la fecha actual
        if ($fecha === null) {
            $fecha = date('Y-m-d');
        }
        
        $query = "SELECT COUNT(*) as cantidad FROM ventas WHERE DATE(fecha) = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['cantidad'] ?? 0;
        }
        
        return 0;
    }
    
    /**
     * Método para obtener los productos más vendidos del día
     */
    public function getProductosMasVendidosDia($fecha = null, $limite = 5) {
        // Si no se proporciona fecha, usar la fecha actual
        if ($fecha === null) {
            $fecha = date('Y-m-d');
        }
        
        $query = "SELECT p.descripcion, SUM(d.cantidad) as total_vendido, SUM(d.cantidad * d.precio) as total_ingresos  
                FROM detalle_venta d 
                INNER JOIN ventas v ON d.id_venta = v.id 
                INNER JOIN producto p ON d.id_producto = p.codproducto 
                WHERE DATE(v.fecha) = ? 
                GROUP BY p.codproducto 
                ORDER BY total_vendido DESC 
                LIMIT ?";
                
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $fecha, $limite);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $productos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        
        return $productos;
    }
} 