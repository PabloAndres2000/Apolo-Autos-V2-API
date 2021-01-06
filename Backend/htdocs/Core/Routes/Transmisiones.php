<?php 
require_once(__DIR__."/../Controllers/TransmisionController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Transmisiones
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
            $transmision = new TransmisionController();
            $data = $transmision->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $transmision = new TransmisionController();
            $data = $transmision->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idtransmision}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idtransmision = $request-> getAttribute("idtransmision");
            $transmision = new TransmisionController();
            $data = $transmision->ControllerActualizar($nombre,$idtransmision);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
