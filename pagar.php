<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';

$total = 0;
if ($_POST) {
    $SID = session_id();
    $correo = $_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $total += $producto['PRECIO'] * $producto['CANTIDAD'];
    }

    // Inserta la venta en la base de datos
    $sentencia = $pdo->prepare("INSERT INTO `ventas` (`ID`, `clavetransaccion`, `paypaldatos`, `fecha`, `correo`, `total`, `status`) 
    VALUES (NULL, :clavetransaccion, '', NOW(), :correo, :total, 'pendiente');");
    $sentencia->bindParam(":clavetransaccion", $SID);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":total", $total);
    $sentencia->execute();
    $idventa = $pdo->lastInsertId();

    // Inserta los detalles de la venta
    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $sentencia = $pdo->prepare("INSERT INTO `detalleventa` (`id`, `idventa`, `idproducto`, `preciounitario`, `cantidad`,`fecha`, `descargado`) 
        VALUES (NULL, :idventa, :idproducto, :preciounitario, :cantidad, NOW(),'0');");
        $sentencia->bindParam(":idventa", $idventa);
        $sentencia->bindParam(":idproducto", $producto['ID']);
        $sentencia->bindParam(":preciounitario", $producto['PRECIO']);
        $sentencia->bindParam(":cantidad", $producto['CANTIDAD']);
        $sentencia->execute();
    }

    // Reinicia el carrito
    unset($_SESSION['CARRITO']);
}
?>

<script src="https://www.paypal.com/sdk/js?client-id=AZDxjDScFpQtjWTOUtWKbyN_bDt40gqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R&currency=USD"></script>

<style>
    #paypal-button-container {
        width: 100%;
    }
</style>

<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Abona la cantidad de:</p>
    <h4>$<?php echo number_format($total, 2); ?></h4>
    <div id="paypal-button-container"></div>
    <h4>Alias: playexpress.mp</h4>
    <p>Los productos podrán ser descargados una vez que se procese el pago.<br>
        <strong>(Para aclaraciones: andaarezaralaiglesia@gmail.com)</strong>
    </p>
    <form action="juegos.php" method="post">
        <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">
            Finalizar Compra
        </button>
    </form>
</div>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: 'USD',
                        value: '<?php echo $total; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transacción completada por ' + details.payer.name.given_name + '!');
                window.location.href = "gracias.php";
            });
        },
        onError: function(err) {
            console.error('Ocurrió un error con la transacción', err);
        }
    }).render('#paypal-button-container');
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
