<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Eliminar') {
    $id = $_POST['id'];

    if ($id) {
        $sentencia = $pdo->prepare("DELETE FROM detalleventa WHERE id = :id");
        $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
        $sentencia->execute();
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el producto.";
    }
}

// Consulta para obtener los productos
$sentencia = $pdo->prepare("SELECT * FROM detalleventa");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (!empty($mensaje)) { ?>
    <div class="alert alert-success">
        <?php echo $mensaje; ?>
    </div>
<?php } ?>

<div class="table-responsive" style="padding: 20px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="5"><h2>Ventas</h2></th>
            </tr>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $detalleventa) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($detalleventa['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($detalleventa['idproducto']); ?></td>
                    <td><?php echo htmlspecialchars($detalleventa['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($detalleventa['preciounitario']); ?></td>
                    <td>
                        <a href="editarventas.php?id=<?php echo $detalleventa['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                        
                        <!-- Formulario para eliminar producto -->
                        <form action="" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $detalleventa['id']; ?>">
                            <button class="btn btn-sm btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include 'templates/pie.php';
?>
