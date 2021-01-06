<?php
require_once(__DIR__ . "/../Controllers/DiseñoExteriorController.php");

use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/

class DisenoExteriores
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
    public function Insertar($Auth)
    {
        $this->app->post("/Insertar", function (Request $request, Response $response, array $args) {
            $color = $request->getParam("color");
            $neumaticos = $request->getParam("neumaticos");
            $focos = $request->getParam("focos");
            $peso = $request->getParam("peso");
            $motor = $request->getParam("motor");
            $velocidades = $request->getParam("velocidades");
            $idauto = $request->getParam("idauto");
            $diseñoexteriores = new DisenoExteriorController();
            $data = $diseñoexteriores->ControllerInsertar($color, $neumaticos, $focos, $peso, $motor,$velocidades, $idauto);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar", function (Request $request, Response $response, array $args) {
            $diseñoexteriores = new DisenoExteriorController();
            $data = $diseñoexteriores->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{iddiseño_exterior}", function (Request $request, Response $response, array $args) {
             $color = $request->getParam("color");
            $neumaticos = $request->getParam("neumaticos");
            $focos = $request->getParam("focos");
            $peso = $request->getParam("peso");
            $motor = $request->getParam("motor");
            $velocidades = $request->getParam("velocidades");
            $idauto = $request->getParam("idauto");
            $iddiseño_exterior = $request->getAttribute("iddiseño_exterior");
            $diseñoexteriores = new DisenoExteriorController();
            $data = $diseñoexteriores->ControllerActualizar($color, $neumaticos, $focos, $peso, $motor,$velocidades, $idauto,$iddiseño_exterior);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
}
