<?php 
require_once(__DIR__."/../Controllers/CombustibleController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Combustibles
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
            $combustible = new CombustibleController();
            $data = $combustible->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $combustible = new CombustibleController();
            $data = $combustible->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idcombustible}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idcombustible = $request-> getAttribute("idcombustible");
            $combustible = new CombustibleController();
            $data = $combustible->ControllerActualizar($nombre,$idcombustible);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
