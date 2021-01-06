<?php 
require_once(__DIR__."/../Controllers/UsuarioController.php");
use \Slim\App;
use \Slim\Http\Request as Request;
use \Slim\Http\Response as Response;
/*
    El Routes es el segundo orden
*/
class Usuarios
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;

    }
    public function Registro()
    {
        //Registro no lleva $Auth
        $this->app->post("/Registro",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $correo = $request-> getParam("correo");
            $contraseña = $request-> getParam("contraseña");
            $usuario = new UsuarioController();
            $data = $usuario->ControllerRegistro($nombre, $correo, $contraseña);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        });
    }
    public function Listar($Auth)
    {
        //Los listar no reciben parametros, entonces solamente se muestran
        $this->app->get("/Listar",function(Request $request, Response $response, array $args ){
            $usuario = new UsuarioController();
            $data = $usuario->ControllerListar();
            $response = $response->withJson($data["response"], $data["status"]);
            return $response; 
        })->add($Auth);
    }
    public function Actualizar($Auth)
    {
        $this->app->put("/Actualizar/{idusuario}",function(Request $request, Response $response, array $args){
            $nombre = $request-> getParam("nombre");
            $correo = $request-> getParam("correo");
            $idusuario = $request-> getAttribute("idusuario");
            $usuario = new UsuarioController();
            $data = $usuario->ControllerActualizar($nombre, $correo, $idusuario);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        })->add($Auth);
    }

    public function Login()
    {
        //LOS METODOS PARA LOGIN NO LLEVAN $AUTH
        $this->app->post("/Login",function(Request $request, Response $response, array $args){
            $correo = $request-> getParam("correo");
            $contraseña = $request-> getParam("contraseña");
            $usuario = new UsuarioController();
            $data = $usuario->ControllerLogin($correo, $contraseña);
            $response = $response->withJson($data["response"], $data["status"]);
            return $response;
        });
    } 
}
