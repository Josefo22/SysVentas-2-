<?php
include_once "includes/header.php";
include "../conexion.php";

$id_user = $_SESSION['idUser']; // Asigna el valor de $_SESSION['idUser'] a $id_user
$id = mysqli_real_escape_string($conexion, $id_user); // Escapa el valor de $id_user

$permiso = "usuarios";
$sql = mysqli_query($conexion, "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id AND p.nombre = '$permiso'");
$existe = mysqli_fetch_all($sql);
if (empty($existe) && $id_user != 1) {
    header("Location: permisos.php");
    exit; // Asegura que la ejecución del código se detiene después de la redirección
}

$sqlpermisos = mysqli_query($conexion, "SELECT * FROM permisos");
if (!$sqlpermisos) {
    // Manejo de errores en la conexión o consulta SQL
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}

$usuarios = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = $id");
$consulta = mysqli_query($conexion, "SELECT * FROM detalle_permisos WHERE id_usuario = $id");
$resultUsuario = mysqli_num_rows($usuarios);

if ($resultUsuario == 0) {
    header("Location: usuarios.php");
    exit();
}

$datos = array();
foreach ($consulta as $asignado) {
    $datos[$asignado['id_permiso']] = true;
}

if (isset($_POST['permisos'])) {
    $permisos = $_POST['permisos'];

    // Primero, eliminamos los permisos actuales del usuario en `detalle_permisos`
    mysqli_query($conexion, "DELETE FROM detalle_permisos WHERE id_usuario = $id");

    // Luego, asignamos los nuevos permisos seleccionados
    if (!empty($permisos)) {
        foreach ($permisos as $permiso) {
            $sql = mysqli_query($conexion, "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES ($id, $permiso)");
            if (!$sql) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Error al actualizar permisos
                          </div>';
                break;
            }
        }
        // Redireccionar después de actualizar permisos correctamente
        if (!isset($alert)) {
            header("Location: rol.php?id=$id&m=si");
            exit();
        }
    }
}
?>
<style>
/* Estilos para los interruptores */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin-right: 10px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Opcional: Estilo para las etiquetas de permisos */
.form-check-inline label {
    font-weight: bold;
    font-size: 1rem;
    color: #333;
    margin-left: 8px;
    vertical-align: middle;
}

/* Estilos para organizar las casillas en una cuadrícula */
.permission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.permission-checkbox label {
    font-weight: bold;
    margin-left: 8px;
    color: #333;
    vertical-align: middle;
}
</style>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg-warning text-white">
                Permisos
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <?php if (isset($_GET['m']) && $_GET['m'] == 'si') { ?>
                        <div class="alert alert-success" role="alert">
                            Permisos actualizados
                        </div>
                    <?php } ?>
                    <?php while ($row = mysqli_fetch_assoc($sqlpermisos)) { ?>
                        <div class="form-check form-check-inline m-4">
                            <input 
                                id="permiso_<?php echo $row['id']; ?>" 
                                type="checkbox" 
                                name="permisos[]" 
                                value="<?php echo $row['id']; ?>"
                                <?php if (isset($datos[$row['id']])) echo "checked"; ?>
                            >
                            <label for="permiso_<?php echo $row['id']; ?>" class="p-2 text-uppercase">
                                <?php echo htmlspecialchars($row['nombre']); ?>
                            </label>
                        </div>
                    <?php } ?>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit">Modificar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>
