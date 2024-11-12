<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<h3>Lista del carrito</h3>
  <?php if(!empty($_SESSION['CARRITO'])){

   ?>
<table class="table table-light table-border">
    <tbody>
        <tr>
           <th style="width: 40%; text-align: center;">nombre</th>
           <th style="width: 40%; text-align: center;">cantidad</th>
           <th style="width: 20%; text-align: center;">Precio</th>
           <th style="width: 20%;"></th>

        </tr>
        <?php $total=0;  ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
        <tr>
           <td style="width: 40%; text-align: center;"><?php echo $producto['NOMBRE'] ?></td>
           <td style="width: 20%; text-align: center;"><?php echo $producto['CANTIDAD'] ?></td>
           <td style="width: 20%; text-align: center;"><?php echo number_format( $producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>

           <form action="" method="post">
           <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY); ?>">
           <td style="width: 20%;"><button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button></td>
           </form>
        </tr>
        <?php $total=$total+( $producto['PRECIO']*$producto['CANTIDAD']);  ?>

        <?php } ?>

        <tr>
            <td colspan="3" ><h3>Total</h3></td>
            <td><h3><?php echo number_format($total,2) ?></h3></td>
            <td></td>

        </tr>
        <tr>
        <td colspan="5=" >
        <form action="pagar.php" method="post">
            <div class="alert alert-success">
            <div class="form-group">
            <label for="my-input">Correo de contacto:</label>
            <input id="email" name="email" class="form-control" type="email" placeholder="Escribe tu correo" required>
            </div>
            <small id="emailhelp" class="form-text text-muted">
                Los productos se enviaran a este correo.
            </small>
            </div>     
            <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">
                Proceder a pagar
            </button>   
        </form>       
        </td>
        </tr>

    </tbody>

</table>
<?php }else{ ?>
<div class="alert alert-success">
    No hay productos en el carrito
</div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>