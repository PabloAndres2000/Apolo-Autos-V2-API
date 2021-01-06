<?php 
require_once(__DIR__."/../Controllers/RegionController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Regiones
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;

    }
    public function Insertar($Auth)
    {
        $this->app->post("/Insertar",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $region = new RegionController();
            $data = $region->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $region = new RegionController();
            $data = $region->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idregion}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idregion = $request-> getAttribute("idregion");
            $region = new RegionController();
            $data = $region->ControllerActualizar($nombre,$idregion);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
