<?php
require_once 'Usuario.php';
session_start();

if (!isset($_SESSION['usuario_email'])){
    header("Location: Inicio_de_sesión.php");
    exit();
}

$repo = new UsuariosRepository();
$usuario_email=$_SESSION['usuario_email'];

$usuario_array = $repo->conseguir_usuario($usuario_email); //array
$nombre = $usuario_array['nombre'];
$apellidos = $usuario_array['apellidos'];

/**Saluda al usuario con nombre y apellidos y muestra las novedades de la pagina */
?>
<h1 style="color: #2c3e50;">
    ¡Bienvenido, <?php echo htmlspecialchars($nombre ." ". $apellidos); ?>!
    <a href="logout.php">Cerrar sesión</a>
</h1>