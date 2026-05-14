<?php

require_once 'Usuario.php';
session_start()

?>
<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro para saludo</title>
    </head>
    <body>

        <!--Registro--> 
    
        <form method="post">
            <input type="text" id="id_email" name="email" placeholder="Introduce tu email" required ></input>
            <input type="text" id="id_nombre" name="nombre" placeholder="Introduce tu nombre " required ></input>
            <input type="text" id="id_apellidos" name="apellidos" placeholder="Introduce tus apellidos" required></input>
            <input type="password" id="id_contraseña" name="contraseña" placeholder="Introduce la contraseña" required></input>
            <button type="submit">Registrarse</button>
        </form>

        <?php

        /**Consigue el nombre y apellido del usuario que se registra y comprueba que no haya ninguno igual, 
         * si el usuario no existe se añade al array usuarios.json y envia a la zona de inicio de sesión para ser saludado*/

        if (isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['contraseña'])){

            $email_introducido = htmlspecialchars($_POST['email']);
            $nombre_introducido = htmlspecialchars($_POST['nombre']);
            $apellido_introducido = htmlspecialchars($_POST['apellidos']);
            $contraseña_introducida = htmlspecialchars($_POST['contraseña']);

            $repo = new UsuariosRepository();

            //Comprueba que no esté el usuario ya registrado
            if (!$repo->comprobar_existencia($email_introducido)){
                $usuarioNuevo=new Usuario($nombre_introducido, $apellido_introducido, $email_introducido, $contraseña_introducida);
                
                $repo->guardar_usuario($usuarioNuevo);

                $_SESSION['usuario_email'] = $_POST['email'];
                
                echo "Registro completado con éxito";
                ?>
                <a href="inicio_de_sesión.php">Inicie sesión aquí</a>
            <?php
            }else{
                echo "Usted ya está registrado\n";
                ?>

                <a href="Inicio_de_sesión.php">Haga click aquí para iniciar sesión</a>

                <?php
            }
        }
        ?>
    </body>
</html>