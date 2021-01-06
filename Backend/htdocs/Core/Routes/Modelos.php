<?php 
require_once(__DIR__."/../Controllers/ModeloController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Modelos
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
            $idmarca = $request-> getParam("idmarca");
            $modelo = new ModeloController();
            $data = $modelo->ControllerInsertar($nombre,$idmarca);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $modelo = new ModeloController();
            $data = $modelo->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idmodelo}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idmarca = $request-> getParam("idmarca");
            $idmodelo = $request-> getAttribute("idmodelo");
            $modelo = new ModeloController();
            $data = $modelo->ControllerActualizar($nombre,$idmarca,$idmodelo);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
