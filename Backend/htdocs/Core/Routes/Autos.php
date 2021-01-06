<?php 
require_once(__DIR__."/../Controllers/AutoController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Autos
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;

    }
    public function Insertar($Auth)
    {
        $this->app->post("/Insertar",function(Request $request, Response $response, array $args){
            $año = $request-> getParam("año");
            $precio = $request-> getParam("precio");
            $cilindros = $request-> getParam("cilindros");
            $kilometraje = $request-> getParam("kilometraje");
            $idcombustible = $request-> getParam("idcombustible");
            $idcategoria = $request-> getParam("idcategoria");
            $idtransmision = $request-> getParam("idtransmision");
            $idestado_auto = $request-> getParam("idestado_auto");
            $idmodelo = $request-> getParam("idmodelo");
            $auto = new AutoController();
            $data = $auto->ControllerInsertar($año,$precio,$cilindros,$kilometraje,$idcombustible,$idcategoria,$idtransmision,$idestado_auto,$idmodelo);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $auto = new AutoController();
            $data = $auto->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idauto}",function(Request $request, Response $response, array $args){
            $año = $request-> getParam("año");
            $precio = $request-> getParam("precio");
            $cilindros = $request-> getParam("cilindros");
            $kilometraje = $request-> getParam("kilometraje");
            $idcombustible = $request-> getParam("idcombustible");
            $idcategoria = $request-> getParam("idcategoria");
            $idtransmision = $request-> getParam("idtransmision");
            $idestado_auto = $request-> getParam("idestado_auto");
            $idmodelo = $request-> getParam("idmodelo");
            $idauto = $request-> getAttribute("idauto");
            $auto = new AutoController();
            $data = $auto->ControllerActualizar($año,$precio,$cilindros,$kilometraje,$idcombustible,$idcategoria,$idtransmision,$idestado_auto,$idmodelo,$idauto);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    
}
