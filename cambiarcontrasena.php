<?php
session_start();
include 'global/config.php';
include 'global/conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // Redirige al inicio de sesión si el usuario no está autenticado
    echo "<script>alert('Debe iniciar sesión para cambiar la contraseña'); window.location.href = 'login.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_id = $_SESSION['usuario_id']; // ID del usuario autenticado
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verifica si la nueva contraseña coincide con la confirmación
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "<script>alert('La nueva contraseña y la confirmación no coinciden');</script>";
    } else {
        // Consulta para obtener la contraseña actual del usuario
        $query = "SELECT contrasena FROM usuarios WHERE id = :usuario_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si la contraseña actual ingresada es correcta
        if ($usuario && password_verify($contrasena_actual, $usuario['contrasena'])) {
            // Encripta la nueva contraseña y actualiza la base de datos
            $nueva_contrasena_encriptada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET contrasena = :nueva_contrasena WHERE id = :usuario_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nueva_contrasena', $nueva_contrasena_encriptada);
            $stmt->bindParam(':usuario_id', $usuario_id);
            
            // Verifica si la actualización fue exitosa
            if ($stmt->execute()) {
                echo "<script>alert('Contraseña actualizada correctamente'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar la contraseña, por favor intente nuevamente');</script>";
            }
        } else {
            echo "<script>alert('La contraseña actual es incorrecta');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #004dff;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="cambiarcontrasena.php" method="POST" class="bg-white p-4 rounded">
                    <h3 class="mb-4">Cambiar Contraseña</h3>

                    <div class="mb-3">
                        <label for="contrasena_actual" class="form-label">Contraseña Actual</label>
                        <input type="password" name="contrasena_actual" required placeholder="Contraseña Actual" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="nueva_contrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="nueva_contrasena" required placeholder="Nueva Contraseña" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_contrasena" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="confirmar_contrasena" required placeholder="Confirmar Nueva Contraseña" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
