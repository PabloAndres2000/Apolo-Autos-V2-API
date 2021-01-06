<?php 
require_once(__DIR__."/../Models/Publicacion.php");
require_once(__DIR__."/../App/Response.php");
/*
    El Controllers recibe lo que se envio en los Routes.
    Controllers es el tercer orden.

*/
class PublicacionController extends Publicacion
{
    public function ControllerInsertar($premium,$fecha_publicacion,$idauto,$idregion,$idtipo_vendedor,$idusuario,$titulo,$descripcion,$telefono,$idforma_pago)
    {   /*
            Estos datos los manda a Models
        */
        $this->premium = $premium;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->idauto = $idauto;
        $this->idregion = $idregion;
        $this->idtipo_vendedor = $idtipo_vendedor;
        $this->idusuario = $idusuario;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->telefono = $telefono;
        $this->idforma_pago = $idforma_pago;
        $response = $this->Insertar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }

    public function ControllerListar()
    {
        $response = $this->Listar(); // Muesta los datos del la public function listar de usuarios
        return $response->makeResponse(); 
    }

    public function ControllerActualizar($premium,$fecha_publicacion,$idauto,$idregion,$idtipo_vendedor,$idusuario,$titulo,$descripcion,$telefono,$idforma_pago,$idpublicacion)
    {
        /*
            Estos datos los manda a Models
        */
        $this->idpublicacion = $idpublicacion;
        $this->premium = $premium;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->idauto = $idauto;
        $this->idregion = $idregion;
        $this->idtipo_vendedor = $idtipo_vendedor;
        $this->idusuario = $idusuario;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->telefono = $telefono;
        $this->idforma_pago = $idforma_pago;
        

        $response = $this->Actualizar();//Recibe los datos del models

        return $response->makeResponse();//Retorna los datos mediante makeResponse que es para darle formato de response a todos los datos
    }
    
}


?>