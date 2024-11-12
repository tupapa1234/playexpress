<?php
// Inicia la sesión
session_start();

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Script para mostrar mensaje de sesión cerrada correctamente
echo "<script>alert('Sesión cerrada correctamente.'); window.location.href='login.php';</script>";

exit();
?>
