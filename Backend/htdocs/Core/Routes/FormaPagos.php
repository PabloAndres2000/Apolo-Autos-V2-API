<?php 
require_once(__DIR__."/../Controllers/FormaPagoController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class FormaPagos
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
            $formapago = new FormaPagoController();
            $data = $formapago->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $formapago = new FormaPagoController();
            $data = $formapago->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idforma_pago}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idforma_pago = $request-> getAttribute("idforma_pago");
            $formapago = new FormaPagoController();
            $data = $formapago->ControllerActualizar($nombre,$idforma_pago);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
