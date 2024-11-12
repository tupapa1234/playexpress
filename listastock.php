<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';

// Procesar solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Eliminar') {
    $id = openssl_decrypt($_POST['id'], COD, KEY);

    if ($id) {
        $sentencia = $pdo->prepare("DELETE FROM producto WHERE ID_producto = :id");
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el producto.";
    }
}

// Consulta para obtener los productos
$sentencia = $pdo->prepare("SELECT * FROM producto");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    // Capturar los datos del formulario
    $nombre_juego = $_POST['nombre_juego'];
    $precio_venta = $_POST['precio_venta'];
    $stock = $_POST['stock'];
    $fk_categoria = $_POST['fk_categoria'];

    // Verificar si se subió una imagen y obtener su contenido
    $imagen = null;
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO producto (nombre_juego, precio_venta, stock, fk_categoria, imagen) VALUES (:nombre_juego, :precio_venta, :stock, :fk_categoria, :imagen)";
    $stmt = $pdo->prepare($sql);

    // Ejecutar la consulta
    $stmt->bindParam(':nombre_juego', $nombre_juego);
    $stmt->bindParam(':precio_venta', $precio_venta);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':fk_categoria', $fk_categoria);
    $stmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        echo "<script>alert('Producto registrado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al registrar el producto.');</script>";
    }
}
?>

<div class="row">
<div class="col-6" style="padding: 15px;">
    <h2>Nuevo producto</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="producto">Nombre juego:</label>
            <input type="text" class="form-control" name="nombre_juego" required>
        </div>
        <div class="form-group">
            <label for="producto">Precio juego:</label>
            <input type="number" class="form-control" name="precio_venta" required>
        </div>
        <div class="form-group">
            <label for="producto">Cantidad stock:</label>
            <input type="number" class="form-control" name="stock" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <input type="text" class="form-control" name="fk_categoria" placeholder="Ej. Play 3, Play 4, Play 5" required>
        </div>
        <div class="form-group">
            <label for="imag" class="form-label">Imagen (opcional):</label>
            <input type="file" name="imagen" class="form-control">
        </div>
        <br>
        <button type="submit" name="register" class="btn btn-primary">Registrar producto</button>
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
                        <th colspan="6"><h2>Lista stock</h2></th>
                    </tr>
                    <tr>
                        <th>Juego</th>
                        <th>Valor</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProductos as $producto) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['nombre_juego']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio_venta']); ?></td>
                            <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                            <td><?php echo htmlspecialchars($producto['fk_categoria']); ?></td>
                            <td>
                                <a href="editarstock.php?id=<?php echo $producto['ID_producto']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                
                                <!-- Formulario para eliminar producto -->
                                <form action="" method="post" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID_producto'], COD, KEY); ?>">
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
