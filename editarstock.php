<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';


// Verificar si se recibió un ID de producto válido para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales del producto
    $sentencia = $pdo->prepare("SELECT * FROM producto WHERE ID_producto = :id");
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }
}

// Guardar cambios al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];

    // Actualizar el producto en la base de datos
    $sentencia = $pdo->prepare("UPDATE producto SET nombre_juego = :nombre, precio_venta = :precio, stock = :cantidad, fk_categoria = :categoria WHERE ID_producto = :id");
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':precio', $precio);
    $sentencia->bindParam(':cantidad', $cantidad);
    $sentencia->bindParam(':categoria', $categoria);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);

    if ($sentencia->execute()) {
        echo "Producto actualizado exitosamente.";
        header('Location: listastock.php');
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!-- Formulario de edición -->
<form method="post" action="" class="form p-4 shadow-sm rounded bg-light">
    <input type="hidden" name="id" value="<?php echo $producto['ID_producto']; ?>" class="form-control">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Juego:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_juego']); ?>" required class="form-control" placeholder="Ingrese el nombre del juego">
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Precio de Venta:</label>
        <input type="number" name="precio" value="<?php echo htmlspecialchars($producto['precio_venta']); ?>" required class="form-control" placeholder="Ingrese el precio de venta">
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad en Stock:</label>
        <input type="number" name="cantidad" value="<?php echo htmlspecialchars($producto['stock']); ?>" required class="form-control" placeholder="Ingrese la cantidad en stock">
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría:</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($producto['fk_categoria']); ?>" required class="form-control" placeholder="Ingrese la categoría">
    </div>

    <button type="submit" class="btn btn-primary w-100" style="margin: 2px;">Guardar Cambios</button>
</form>

<?php
include 'templates/pie.php';
?>