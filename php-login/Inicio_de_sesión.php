<?php
    require_once 'Usuario.php';

    session_start();

    if(isset($_POST['email']) && isset($_POST['contraseña'])) {

        $usuario_logueandose = htmlspecialchars($_POST['email']);
        $contraseña_introducida = htmlspecialchars($_POST['contraseña']);

        $repo = new UsuariosRepository();
        $usuarios = $repo->leer_usuarios();
        
        if (isset($usuarios[$usuario_logueandose])){
            //Compara contraseña para poder ser saludado, en caso de ser incorrecta da un mensaje.
            if($repo->verificar_contraseña($usuario_logueandose,$contraseña_introducida)){
                
                $_SESSION['usuario_email'] = $_POST['email'];
                
                header("Location: Pagina_principal.php");
                exit();

            }else{
                echo "Contraseña incorrecta";
            }

        }else{
            echo "Usuario no existe";
            ?>
            </br>
            <a href="registro.php">Registrese aquí</a>
            <?php
        }
    }
    ?>

<DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión para saludo</title>
    </head>
    <body>
        <!--Login--> 
        <form method="post">
            <input type="text" id="id_email" name="email" placeholder="Email" required ></input>
            <input type="password" id="id_contraseña" name="contraseña" placeholder="Contraseña" required></input>
            <button type="submit">Iniciar sesión</button>
        </form>
    </body>
</html>