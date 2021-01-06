<?php
require_once(__DIR__ . "/../Models/DiseñoExterior.php");
require_once(__DIR__ . "/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class DisenoExteriorController extends DisenoExterior
{
    public function ControllerInsertar($color, $neumaticos, $focos, $peso, $motor, $velocidades, $idauto)
    {
        /*
            Estos datos los manda a Models
        */
        $this->color = $color;
        $this->neumaticos = $neumaticos;
        $this->focos = $focos;
        $this->peso = $peso;
        $this->motor = $motor;
        $this->velocidades = $velocidades;
        $this->idauto = $idauto;
        $response = $this->Insertar(); //Recibe los datos del models

        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerActualizar($color, $neumaticos, $focos, $peso, $motor, $velocidades, $idauto, $iddiseño_exterior)
    {
        /*
            Estos datos los manda a Models
        */
        $this->color = $color;
        $this->neumaticos = $neumaticos;
        $this->focos = $focos;
        $this->peso = $peso;
        $this->motor = $motor;
        $this->velocidades = $velocidades;
        $this->idauto = $idauto;
        $this->iddiseño_exterior = $iddiseño_exterior;


        $response = $this->Actualizar(); //Recibe los datos del models

        return $response->makeResponse(); //Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
}
