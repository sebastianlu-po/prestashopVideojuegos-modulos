<?php
session_start();
session_destroy(); // Borra toda la información de la sesión
header("Location: Inicio_de_sesión.php");
exit();
?>