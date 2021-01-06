<?php 
require_once(__DIR__."/../Models/Auto.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class AutoController extends Auto
{
    public function ControllerInsertar($año,$precio,$cilindros,$kilometraje,$idcombustible,$idcategoria,$idtransmision,$idestado_auto,$idmodelo)
    {   /*
            Estos datos los manda a Models
        */
        $this->año = $año;
        $this->precio = $precio;
        $this->cilindros = $cilindros;
        $this->kilometraje = $kilometraje;
        $this->idcombustible = $idcombustible;
        $this->idcategoria = $idcategoria;
        $this->idtransmision = $idtransmision;
        $this->idestado_auto = $idestado_auto;
        $this->idmodelo = $idmodelo;
        $response = $this->Insertar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerActualizar($año,$precio,$cilindros,$kilometraje,$idcombustible,$idcategoria,$idtransmision,$idestado_auto,$idmodelo,$idauto)
    {
        /*
            Estos datos los manda a Models
        */
        $this->año = $año;
        $this->precio = $precio;
        $this->cilindros = $cilindros;
        $this->kilometraje = $kilometraje;
        $this->idcombustible = $idcombustible;
        $this->idcategoria = $idcategoria;
        $this->idtransmision = $idtransmision;
        $this->idestado_auto = $idestado_auto;
        $this->idmodelo = $idmodelo;
        $this->idauto = $idauto;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
}