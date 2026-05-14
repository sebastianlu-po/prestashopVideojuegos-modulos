
<?php 
class Usuario implements JsonSerializable{

    /**Atributos */
    private string $nombre;
    private string $apellidos;
    private string $contraseña;
    private string $email;


    /**Constructor */
    public function __construct(string $nombre, string $apellidos, string $email, string $contraseña) {

    $this -> nombre = $nombre;
    $this -> apellidos = $apellidos;
    $this -> email = $email;
    $this -> contraseña = $contraseña;
    }


    /**Devuelve el email del usuario */
    function get_email(): string{
        
        return $this->email;

    }

    /**Devuelve el nombre del usuario */
    function get_nombre(): string{
        
        return $this->nombre;

    }

    /**Devuelve los apellidos del usuario recibido */
    function get_apellidos(): string{
        
        return $this->apellidos;

    }

    // Este método se activa solo cuando haces json_encode($usuario)
    public function jsonSerialize(): mixed {
        return [
            'nombre'   => $this->nombre,
            'apellidos' => $this->apellidos,
            'email'    => $this->email,
            'contraseña' => $this->contraseña // Solo aquí se "expone"
        ];
    }
}

class UsuariosRepository {

    private string $archivo = 'usuarios.json';

    /**Mira toda la base de datos y la devuelve en formato array */
    public function leer_usuarios() : array{
        $contenido = file_get_contents($this->archivo , true); 

        if (empty($contenido)) {
            
            return [];

        }else{

            return json_decode($contenido, true);

        }
    }

    /**Mira toda la base de datos y la devuelve en formato array */
    public function conseguir_usuario($email_recibido) : array{
        $usuarios = $this -> leer_usuarios();

        return $usuarios[$email_recibido];

    }

    /**Comprueba que el usuario recibido esté en la base de datos */
    public function comprobar_existencia($email) : bool{
        $usuarios = $this -> leer_usuarios();
        return isset($usuarios[$email]);
    }

    /**Guarda el usuario en la base de datos poniendo como identificador su email */
    public function guardar_usuario(Usuario $usuario) : void{
        $usuarios = $this -> leer_usuarios();

        $usuarios[$usuario->get_email()]=$usuario;

        file_put_contents($this->archivo, json_encode($usuarios,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**Verifica que la contraseña introducida sea correcta, devuelve la confirmación de forma booleana */
    function verificar_contraseña($email, $contraseña_introducida) : bool {
        $respuesta = false;
        $usuarios = $this->leer_usuarios();

        if($usuarios[$email]['contraseña'] == $contraseña_introducida){       
            $respuesta = true;
        }else{
            $respuesta = false;
        }

        return $respuesta;
    }
}
?>

