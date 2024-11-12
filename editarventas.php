<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';


// Verificar si se recibió un ID de producto válido para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales del producto
    $sentencia = $pdo->prepare("SELECT * FROM detalleventa WHERE id = :id");
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $detalleventa = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$detalleventa) {
        echo "Venta no encontrada.";
        exit();
    }
}

// Guardar cambios al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $preciounitario = $_POST['preciounitario'];
    $cantidad = $_POST['cantidad'];
    $fecha = $_POST['fecha'];

    // Actualizar el producto en la base de datos
    $sentencia = $pdo->prepare("UPDATE detalleventa SET preciounitario = :preciounitario, cantidad = :cantidad, fecha = :fecha WHERE id = :id");
    $sentencia->bindParam(':preciounitario', $preciounitario);
    $sentencia->bindParam(':cantidad', $cantidad);
    $sentencia->bindParam(':fecha', $fecha);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);

    if ($sentencia->execute()) {
        echo "Venta actualizado exitosamente.";
        header('Location: ventas.php');
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!-- Formulario de edición -->
<form method="post" action="" class="form p-4 shadow-sm rounded bg-light">
    <input type="hidden" name="id" value="<?php echo $detalleventa['id']; ?>" class="form-control">

    <div class="mb-3">
        <label for="precio" class="form-label">Precio de Venta:</label>
        <input type="number" name="preciounitario" value="<?php echo htmlspecialchars($detalleventa['preciounitario']); ?>" required class="form-control" placeholder="Ingrese el precio de venta">
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad:</label>
        <input type="number" name="cantidad" value="<?php echo htmlspecialchars($detalleventa['cantidad']); ?>" required class="form-control" placeholder="Ingrese la cantidad">
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Fecha:</label>
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($detalleventa['fecha']); ?>" required class="form-control" placeholder="Ingrese la fecha">
    </div>

    <button type="submit" class="btn btn-primary w-100" style="margin: 2px;">Guardar Cambios</button>
</form>

<?php
include 'templates/pie.php';
?>