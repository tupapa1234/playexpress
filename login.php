<?php
include 'global/config.php';
include 'global/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Inicio de Sesión</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #004dff;">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="backregistro.php" method="POST" class="bg-white p-4 rounded">
          <img src="img/playexpress.jpg" alt="" class="mb-4" style="width: 150px; height: 150px; border-radius: 50%;">

          <div class="mb-3">
            <label for="nombre_titular" class="form-label">Usuario</label>
            <input type="text" name="nombre_titular" required placeholder="Usuario" class="form-control">
          </div>

          <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" name="contrasena" required placeholder="Contraseña" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
