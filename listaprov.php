<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';

// Procesar solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Eliminar') {
    $id = openssl_decrypt($_POST['id'], COD, KEY);

    if ($id) {
        $sentencia = $pdo->prepare("DELETE FROM proveedores WHERE id = :id");
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $mensaje = "Proveedor eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el Proveedor.";
    }
}

// Consulta para obtener los productos
$sentencia = $pdo->prepare("SELECT * FROM proveedores");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Capturar los datos del formulario
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $categoria = $_POST['categoria'];
    $contacto = $_POST['contacto'];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO proveedores (nombre_proveedor, categoria, contacto) VALUES (:nombre_proveedor, :categoria, :contacto)";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    $stmt->bindParam(':nombre_proveedor', $nombre_proveedor);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':contacto', $contacto);

    if ($stmt->execute()) {
        echo "<script>alert('Proveedor registrado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al registrar el Proveedor.');</script>";
    }
}
?>
<div class="row">
<div class="col-6" style="padding: 15px;">
    <h2>Nuevo proveedor</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="producto">Nombre proveedor:</label>
            <input type="text" class="form-control" name="nombre_proveedor" required>
        </div>
        <div class="form-group">
            <label for="producto">Categoria:</label>
            <input type="text" class="form-control" name="categoria" required>
        </div>
        <div class="form-group">
            <label for="producto">Contacto:</label>
            <input type="number" class="form-control" name="contacto" required>
        </div>
        <br>
        <button type="submit" name="register" class="btn btn-primary">Registrar Proveedor</button>
    </form>
</div>

<?php if (!empty($mensaje)) { ?>
    <div class="alert alert-success">
        <?php echo $mensaje; ?>
    </div>
<?php } ?>
    <main class="col-md-6">
        <div class="table-responsive" style="padding: 20px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="6"><h2>Lista Proveedor</h2></th>
                    </tr>
                    <tr>
                        <th>Nombre proveedor</th>
                        <th>Categoria</th>
                        <th>Contacto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProductos as $proveedores) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($proveedores['nombre_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedores['categoria']); ?></td>
                            <td><?php echo htmlspecialchars($proveedores['contacto']); ?></td>
                            <td>
                                <a href="editarproveedor.php?id=<?php echo $proveedores['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                
                                <!-- Formulario para eliminar producto -->
                                <form action="" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($proveedores['id'], COD, KEY); ?>">
                                    <button class="btn btn-sm btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

</div>

<?php
include 'templates/pie.php';

?>
