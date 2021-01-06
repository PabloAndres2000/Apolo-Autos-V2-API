<?php 
require_once(__DIR__."/../Models/Modelo.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class ModeloController extends Modelo
{
    public function ControllerInsertar($nombre,$idmarca)
    {   /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $this->idmarca = $idmarca;
        $response = $this->Insertar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); 
    }

    public function ControllerActualizar($nombre,$idmarca,$idmodelo)
    {
        /*
            Estos datos los manda a Models
        */
        $this->idmodelo = $idmodelo;
        $this->nombre = $nombre;
        $this->idmarca = $idmarca;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
    
}


?>