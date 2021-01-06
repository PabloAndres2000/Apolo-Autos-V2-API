<?php 
require_once(__DIR__."/../Models/TipoVendedor.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class TipoVendedorController extends TipoVendedor
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
        return $response->makeResponse(); 
    }

    public function ControllerActualizar($nombre,$idtipo_vendedor)
    {
        /*
            Estos datos los manda a Models
        */
        $this->nombre = $nombre;
        $this->idtipo_vendedor = $idtipo_vendedor;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
    
}


?>