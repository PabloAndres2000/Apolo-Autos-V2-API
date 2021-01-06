<?php 
require_once(__DIR__."/../Controllers/EstadoAutoController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class EstadoAutos
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
            $estadoauto = new EstadoAutoController();
            $data = $estadoauto->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $estadoauto = new EstadoAutoController();
            $data = $estadoauto->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idestado_auto}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idestado_auto = $request-> getAttribute("idestado_auto");
            $estadoauto = new EstadoAutoController();
            $data = $estadoauto->ControllerActualizar($nombre,$idestado_auto);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
