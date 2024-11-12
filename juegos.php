<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';

// Muestra mensaje si existe uno
if($mensaje != "") { ?>
  <div class="alert alert-success">
    <?php echo($mensaje); ?>
    <a href="mostrarcarrito.php" class="badge badge-success">Ver carrito</a>
  </div>
<?php }

// Consulta para obtener los productos
$sentencia = $pdo->prepare("SELECT * FROM producto");
$sentencia->execute();
$listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Lista de productos -->
<div class="row row-cols-1 row-cols-md-3 g-3" id="product-list" style="padding: 2px;">
  <?php foreach($listaProductos as $producto) { ?>
    <div class="col">
      <div class="card h-100">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" class="card-img-top" alt="Imagen del producto" style="height: 250px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $producto['nombre_juego']; ?></h5>
          <h5 class="card-title"><?php echo $producto['fk_categoria']; ?></h5>
          <h5 class="card-title">$<?php echo $producto['precio_venta']; ?></h5>
           
          <!-- Formulario para agregar al carrito -->
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID_producto'], COD, KEY); ?>">
            <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($producto['nombre_juego'], COD, KEY); ?>">
            <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio_venta'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">

            <button class="btn btn-success" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php 
include 'templates/pie.php';
?>
