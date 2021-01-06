<?php 
require_once(__DIR__."/../Models/Marca.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class MarcaController extends Marca
{
    public function ControllerInsertar($nombre)
    {   /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $response = $this->Insertar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerActualizar($nombre,$idmarca)
    {
        /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $this->idmarca = $idmarca;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
    
}


?>