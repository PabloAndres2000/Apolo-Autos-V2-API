<?php 
require_once(__DIR__."/../Controllers/TipoVendedorController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class TipoVendedores
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
            $tipovendedor = new TipoVendedorController();
            $data = $tipovendedor->ControllerInsertar($nombre);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $tipovendedor = new TipoVendedorController();
            $data = $tipovendedor->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idtipo_vendedor}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $idtipo_vendedor = $request-> getAttribute("idtipo_vendedor");
            $tipovendedor = new TipoVendedorController();
            $data = $tipovendedor->ControllerActualizar($nombre,$idtipo_vendedor);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
