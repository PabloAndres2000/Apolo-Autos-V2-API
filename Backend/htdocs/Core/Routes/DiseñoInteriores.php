<?php
require_once(__DIR__ . "/../Controllers/DiseñoInteriorController.php");

use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/

class DisenoInteriores
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
    public function Insertar($Auth)
    {
        $this->app->post("/Insertar", function (Request $request, Response $response, array $args) {
            $capacidad = $request->getParam("capacidad");
            $volante = $request->getParam("volante");
            $radio = $request->getParam("radio");
            $tapiz = $request->getParam("tapiz");
            $airbags = $request->getParam("airbags");
            $idauto = $request->getParam("idauto");
            $diseñointeriores = new DisenoInteriorController();
            $data = $diseñointeriores->ControllerInsertar($capacidad, $volante, $radio, $tapiz, $airbags, $idauto);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar", function (Request $request, Response $response, array $args) {
            $diseñointeriores = new DisenoInteriorController();
            $data = $diseñointeriores->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{iddiseño_interior}", function (Request $request, Response $response, array $args) {
            $capacidad = $request->getParam("capacidad");
            $volante = $request->getParam("volante");
            $radio = $request->getParam("radio");
            $tapiz = $request->getParam("tapiz");
            $airbags = $request->getParam("airbags");
            $idauto = $request->getParam("idauto");
            $iddiseño_interior = $request->getAttribute("iddiseño_interior");
            $diseñointeriores = new DisenoInteriorController();
            $data = $diseñointeriores->ControllerActualizar($capacidad, $volante, $radio, $tapiz, $airbags, $idauto, $iddiseño_interior);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }
}
