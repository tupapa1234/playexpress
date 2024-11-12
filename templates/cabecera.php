<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #004dff;">
  <div class="container-fluid">
    <img src="img/playexpress.jpg" style="width: 80px; height: 80px; border-radius:15px;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="ventas.php" style="color: white;">Movimientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listaprov.php" style="color: white;">Proveedores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listastock.php" style="color: white;">Stock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php" style="color: white;">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="juegos.php" style="color: white;">Juegos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mostrarcarrito.php" style="color: white;">carrito(<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="row m-0 p-0">