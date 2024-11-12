<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';


// Verificar si se recibió un ID de producto válido para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales del producto
    $sentencia = $pdo->prepare("SELECT * FROM proveedores WHERE id = :id");
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $proveedores = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$proveedores) {
        echo "Producto no encontrado.";
        exit();
    }
}

// Guardar cambios al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $categoria = $_POST['categoria'];
    $contacto = $_POST['contacto'];
    // Actualizar el producto en la base de datos
    $sentencia = $pdo->prepare("UPDATE proveedores SET nombre_proveedor = :nombre_proveedor, categoria = :categoria, contacto = :contacto WHERE id = :id");
    $sentencia->bindParam(':nombre_proveedor', $nombre_proveedor);
    $sentencia->bindParam(':categoria', $categoria);
    $sentencia->bindParam(':contacto', $contacto);
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);

    if ($sentencia->execute()) {
        echo "Producto actualizado exitosamente.";
        header('Location: listaprov.php');
        exit();
    } else {
        echo "Error al actualizar el producto.";
    }
}
?>

<!-- Formulario de edición -->
<form method="post" action="" class="form p-4 shadow-sm rounded bg-light">
    <input type="hidden" name="id" value="<?php echo $proveedores['id']; ?>" class="form-control">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre proveedor:</label>
        <input type="text" name="nombre_proveedor" value="<?php echo htmlspecialchars($proveedores['nombre_proveedor']); ?>" required class="form-control" placeholder="Ingrese el nombre del proveedor">
    </div>

    <div class="mb-3">
        <label for="precio" class="form-label">Categoria:</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($proveedores['categoria']); ?>" required class="form-control" placeholder="Ingrese la categoria">
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Contacto:</label>
        <input type="number" name="contacto" value="<?php echo htmlspecialchars($proveedores['contacto']); ?>" required class="form-control" placeholder="Ingrese el contacto">
    </div>


    <button type="submit" class="btn btn-primary w-100" style="margin: 2px;">Guardar Cambios</button>
</form>

<?php
include 'templates/pie.php';
?>