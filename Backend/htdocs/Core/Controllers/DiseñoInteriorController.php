<?php 
require_once(__DIR__."/../Models/DiseñoInterior.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class DisenoInteriorController extends DiseñoInterior
{
    public function ControllerInsertar($capacidad,$volante,$radio,$tapiz,$airbags,$idauto)
    {   /*
            Estos datos los manda a Models
        */
        $this->capacidad = $capacidad;
        $this->volante = $volante;
        $this->radio = $radio;
        $this->tapiz = $tapiz;
        $this->airbags = $airbags;
        $this->idauto = $idauto;
        $response = $this->Insertar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerActualizar($capacidad,$volante,$radio,$tapiz,$airbags,$idauto,$iddiseño_interior)
    {
        /*
            Estos datos los manda a Models
        */
        $this->capacidad = $capacidad;
        $this->volante = $volante;
        $this->radio = $radio;
        $this->tapiz = $tapiz;
        $this->airbags = $airbags;
        $this->idauto = $idauto;
        $this->iddiseño_interior = $iddiseño_interior;

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
}