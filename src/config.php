<?php
include_once "includes/header.php";
require_once "../conexion.php";

$id_user = $_SESSION['idUser'];
$permiso = "configuracion";

// Verificar permisos
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p 
    INNER JOIN detalle_permisos d ON p.id = d.id_permiso 
    WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'");

$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
}

$alert = '';

// Obtener datos actuales del usuario
$query = mysqli_query($conexion, "SELECT nombre, telefono, correo FROM usuario WHERE idusuario = $id_user");
$data = mysqli_fetch_assoc($query);

if ($_POST) {
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['direccion'])) {
        $alert = '<div class="alert alert-danger" role="alert">
            Todos los campos son obligatorios
        </div>';
    } else {
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);

        $update = mysqli_query($conexion, "UPDATE usuario 
            SET nombre = '$nombre', telefono = '$telefono', correo = '$correo', direccion = '$direccion'
            WHERE idusuario = $id_user");

        if ($update) {
            $alert = '<div class="alert alert-success" role="alert">
                Datos modificados correctamente
            </div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">
                Error al actualizar los datos
            </div>';
        }
    }
}
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Datos de la Empresa
            </div>
            <div class="card-body">
                <form action="" method="post" class="p-3">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" 
                               value="<?php echo $data['nombre'] ?? 'DROGUERIA MI BUENA ESPERANZA'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" 
                               value="<?php echo $data['telefono'] ?? '3113433423'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico:</label>
                        <input type="email" name="correo" class="form-control" 
                               value="<?php echo $data['correo'] ?? 'hilda-aguirre34j@hotmail.com'; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" name="direccion" class="form-control" 
                               value="<?php echo $data['direccion'] ?? ''; ?>" required>
                    </div>
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Modificar Datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
