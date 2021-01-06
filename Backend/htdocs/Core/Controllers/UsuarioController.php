<?php 
require_once(__DIR__."/../Models/Usuario.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class UsuarioController extends Usuario
{
    public function ControllerRegistro($nombre, $correo, $contraseña)
    {   /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contraseña = $contraseña;


        $response = $this->Registro();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); 
    }

    public function ControllerActualizar($nombre,$correo,$idusuario)
    {
        /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->idusuario = $idusuario;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerLogin($correo, $contraseña) {
        $this->correo = $correo;
        $this->contraseña = $contraseña;

        $response = $this->Login();
        
        return $response->makeResponse();
    }
    
}


?>