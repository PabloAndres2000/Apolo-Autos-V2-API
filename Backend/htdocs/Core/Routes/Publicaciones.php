<?php 
require_once(__DIR__."/../Controllers/PublicacionController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Publicaciones
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;

    }
    public function Insertar($Auth)
    {
        $this->app->post("/Insertar",function(Request $request, Response $response, array $args){
            $premium = $request-> getParam("premium");
            $fecha_publicacion = $request-> getParam("fecha_publicacion");
            $idauto = $request-> getParam("idauto");
            $idregion = $request-> getParam("idregion");
            $idtipo_vendedor = $request-> getParam("idtipo_vendedor");
            $idusuario = $request-> getParam("idusuario");
            $titulo = $request-> getParam("titulo");
            $descripcion = $request-> getParam("descripcion");
            $telefono = $request-> getParam("telefono");
            $idforma_pago = $request-> getParam("idforma_pago");
            $publicacion = new PublicacionController();
            $data = $publicacion->ControllerInsertar($premium,$fecha_publicacion,$idauto,$idregion,$idtipo_vendedor,$idusuario,$titulo,$descripcion,$telefono,$idforma_pago);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $publicacion = new PublicacionController();
            $data = $publicacion->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idpublicacion}",function(Request $request, Response $response, array $args){
            $premium = $request-> getParam("premium");
            $fecha_publicacion = $request-> getParam("fecha_publicacion");
            $idauto = $request-> getParam("idauto");
            $idregion = $request-> getParam("idregion");
            $idtipo_vendedor = $request-> getParam("idtipo_vendedor");
            $idusuario = $request-> getParam("idusuario");
            $titulo = $request-> getParam("titulo");
            $descripcion = $request-> getParam("descripcion");
            $telefono = $request-> getParam("telefono");
            $idforma_pago = $request-> getParam("idforma_pago");
            $idpublicacion = $request-> getAttribute("idpublicacion");
            $publicacion = new PublicacionController();
            $data = $publicacion->ControllerActualizar($premium,$fecha_publicacion,$idauto,$idregion,$idtipo_vendedor,$idusuario,$titulo,$descripcion,$telefono,$idforma_pago,$idpublicacion);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
