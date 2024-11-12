<?php
include 'templates/cabecera.php';
?>
<style>
.card {
    position: relative;
    overflow: hidden;
    transition: background-color 0.3s ease;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% 100%; /* Imagen fluida */
    height: 300px; /* Altura predeterminada para pantallas más grandes */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra predeterminada */
}

/* Ajusta el tamaño del contenedor en pantallas pequeñas */
@media (max-width: 767px) {
    .card {
        background-size: cover; /* Ajusta la imagen en pantalla pequeña */
        height: 200px; /* Ajusta la altura del contenedor en pantallas pequeñas */
    }
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0); /* Fondo transparente inicialmente */
    transition: background-color 0.3s ease;
    z-index: 1;
}

.card:hover::before {
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro al hacer hover */
}

.card-body {
    position: relative;
    z-index: 2; /* Para que el contenido esté por encima del fondo oscuro */
    color: white; /* Color de texto blanco */
}

/* Sombra al pasar el ratón sobre la tarjeta */
.card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Aumenta la sombra al hacer hover */
}
</style>

<div class="row text-center">
<div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="ventas.php">
            <div class="card shadow" style="background-image: url('img/movimientos2.jpeg');">
                <div class="card-body">
                    <h5 class="card-title">Movimientos</h5>
                </div>
            </div>
        </a>
    </div>


    
    <div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="listaprov.php">
            <div class="card shadow" style="background-image: url('img/supliers.jpg');">
                <div class="card-body">
                    <h5 class="card-title">Provedorees</h5>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="listastock.php">
            <div class="card shadow" style="background-image: url('img/stock2.jpeg');">
                <div class="card-body">
                    <h5 class="card-title">Stock</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="cambiarcontrasena.php">
            <div class="card shadow" style="background-image: url('img/contrasena.webp');">
                <div class="card-body">
                    <h5 class="card-title">Cambiar Contraseña</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="cerrarsesion.php">
            <div class="card shadow" style="background-image: url('img/cerrarsesion.jpg');">
                <div class="card-body">
                    <h5 class="card-title">Cerrar Sesion</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4 col-lx-4 mb-3 mt-3">
        <a href="juegos.php">
            <div class="card shadow" style="background-image: url('img/juegoss.webp');">
                <div class="card-body">
                    <h5 class="card-title">Juegos</h5>
                </div>
            </div>
        </a>
    </div>


</div>


<?php 
include 'templates/pie.php';
?>
