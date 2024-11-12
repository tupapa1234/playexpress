<?php
session_start(); // Iniciar la sesión al principio del archivo
include 'global/config.php';
include 'global/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos el usuario y la contraseña del formulario
    $nombre_titular = $_POST['nombre_titular'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar si el usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE nombre_titular = :nombre_titular";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nombre_titular', $nombre_titular);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verificamos si la contraseña ingresada coincide con la almacenada en la base de datos
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Si la contraseña es correcta, asigna el ID de usuario a la sesión
            $_SESSION['usuario_id'] = $usuario['id']; // Asegúrate de que la columna sea 'id'
            
            // Redirecciona a la página principal
            header("Location: index.php");
            exit();
        } else {
            // Contraseña incorrecta
            echo "<script>alert('Contraseña incorrecta'); window.location.href='login.php';</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('Usuario no encontrado'); window.location.href='login.php';</script>";
    }
}
?>
