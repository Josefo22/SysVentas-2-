<?php
include_once "includes/header.php";
require_once "../conexion.php";
$id_user = $_SESSION['idUser'];
$permiso = "ventas";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}

// Consulta para obtener las ventas con los clientes
$query = mysqli_query($conexion, "SELECT v.id, v.id_cliente, v.fecha, c.nombre FROM ventas v INNER JOIN cliente c ON v.id_cliente = c.idcliente");

?>
<table class="table table-light" id="tbl">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>PDF</th>
            <th>Acciones</th> <!-- Nueva columna para acciones -->
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) { 
            // Obtener el total de la venta sumando los subtotales de los productos
            $detalleVenta = mysqli_query($conexion, "SELECT SUM(d.cantidad * d.precio) AS total_venta FROM detalle_venta d WHERE d.id_venta = " . $row['id']);
            $detalle = mysqli_fetch_assoc($detalleVenta);
            $totalVenta = $detalle['total_venta'];
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo number_format($totalVenta, 0, ',', '.'); ?> COP</td>
                <td><?php echo $row['fecha']; ?></td>
                <td>
                    <a href="pdf/generar.php?cl=<?php echo $row['id_cliente'] ?>&v=<?php echo $row['id'] ?>" target="_blank" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                </td>
                <td>
                    <form action="eliminar_factura.php?id=<?php echo $row['id']; ?>" method="post" class="d-inline">
                        <button type="submit" class="btn btn-danger"><i class='fas fa-trash-alt'></i> Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once "includes/footer.php"; ?>
