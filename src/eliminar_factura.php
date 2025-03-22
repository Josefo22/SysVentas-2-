<?php
session_start();
require_once "../conexion.php";

$id_user = $_SESSION['idUser'];
$permiso = "ventas";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para eliminar la factura
    $query_eliminar = mysqli_query($conexion, "DELETE FROM ventas WHERE id = $id");

    mysqli_close($conexion);
    header("Location: lista_ventas.php"); // Redirige a la página de facturas
}
