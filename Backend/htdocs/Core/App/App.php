<?php
// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as Request;
/*
    El App es el comienzo de todo.
    Aqui se crean las rutas

*/

use Slim\App;

require __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/Auth.php");
require_once(__DIR__ . "/../Routes/Usuarios.php");
require_once(__DIR__ . "/../Routes/Transmisiones.php");
require_once(__DIR__ . "/../Routes/TipoVendedores.php");
require_once(__DIR__ . "/../Routes/Regiones.php");
require_once(__DIR__ . "/../Routes/Publicaciones.php");
require_once(__DIR__ . "/../Routes/Modelos.php");
require_once(__DIR__ . "/../Routes/Marcas.php");
require_once(__DIR__ . "/../Routes/FormaPagos.php");
require_once(__DIR__ . "/../Routes/EstadoAutos.php");
require_once(__DIR__ . "/../Routes/DiseñoInteriores.php");
require_once(__DIR__ . "/../Routes/DiseñoExteriores.php");
require_once(__DIR__ . "/../Routes/Combustibles.php");
require_once(__DIR__ . "/../Routes/Categorias.php");
require_once(__DIR__ . "/../Routes/Autos.php");

$app = new App();

$app->group('/api', function () use ($app) {

    $app->group('/Usuarios', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $usuarios = new Usuarios($app);
        $usuarios->Registro(); //Registro Se va a Routes de Usuarios.php, Al ser un metodo de registro no requiere $Auth
        $usuarios->Listar($Auth); //Listar Se va a Routes de Usuarios.php
        $usuarios->Actualizar($Auth); //Actualizar Se va a Routes de Usuarios.php
        $usuarios->Login(); //Login Se va a Routes de Usuarios.php, al ser un metodo de Login no requiere $Auth
    });
    $app->group('/Transmisiones', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $transmision = new Transmisiones($app);
        $transmision->Insertar($Auth); //Insertar Se va a Routes de Transmisiones.php
        $transmision->Listar($Auth); //Listar Se va a Routes de Transmisiones.php
        $transmision->Actualizar($Auth); //Actualizar Se va a Routes de Transmisiones.php

    });
    $app->group('/TipoVendedores', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $tipovendedor = new TipoVendedores($app);
        $tipovendedor->Insertar($Auth); //Insertar Se va a Routes de Transmisiones.php
        $tipovendedor->Listar($Auth); //Listar Se va a Routes de Transmisiones.php
        $tipovendedor->Actualizar($Auth); //Actualizar Se va a Routes de Transmisiones.php
    });
    $app->group('/Regiones', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $region = new Regiones($app);
        $region->Insertar($Auth); //Insertar Se va a Routes de Regiones.php
        $region->Listar($Auth); //Listar Se va a Routes de Regiones.php
        $region->Actualizar($Auth); //Actualizar Se va a Routes de Regiones.php
    });

    $app->group('/Publicaciones', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $publicacion = new Publicaciones($app);
        $publicacion->Insertar($Auth); //Insertar Se va a Routes de Publicaciones.php
        $publicacion->Listar($Auth); //Listar Se va a Routes de Publicaciones.php
        $publicacion->Actualizar($Auth); //Actualizar Se va a Routes de Publicaciones.php
    });
    $app->group('/Modelos', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $modelo = new Modelos($app);
        $modelo->Insertar($Auth); //Insertar Se va a Routes de Modelos.php
        $modelo->Listar($Auth); //Listar Se va a Routes de Modelos.php
        $modelo->Actualizar($Auth); //Actualizar Se va a Routes de Modelos.php


    });

    $app->group('/Marcas', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $marca = new Marcas($app);
        $marca->Insertar($Auth); //Insertar Se va a Routes de Marcas.php
        $marca->Listar($Auth); //Listar Se va a Routes de Marcas.php
        $marca->Actualizar($Auth); //Actualizar Se va a Routes de Marcas.php


    });

    $app->group('/FormaPagos', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $formapago = new FormaPagos($app);
        $formapago->Insertar($Auth); //Insertar Se va a Routes de FormaPagos.php
        $formapago->Listar($Auth); //Listar Se va a Routes de FormaPagos.php
        $formapago->Actualizar($Auth); //Actualizar Se va a Routes de FormaPagos.php


    });
    $app->group('/EstadoAutos', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $estadoauto = new EstadoAutos($app);
        $estadoauto->Insertar($Auth); //Insertar Se va a Routes de EstadoAutos.php
        $estadoauto->Listar($Auth); //Listar Se va a Routes de EstadoAutos.php
        $estadoauto->Actualizar($Auth); //Actualizar Se va a Routes de EstadoAutos.php


    });
    $app->group('/DiseñoInteriores', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $diseñointerior = new DisenoInteriores($app);
        $diseñointerior->Insertar($Auth); //Insertar Se va a Routes de DiseñoInteriores.php
        $diseñointerior->Listar($Auth); //Listar Se va a Routes de DiseñoInteriores.php
        $diseñointerior->Actualizar($Auth); //Actualizar Se va a Routes de DiseñoInteriores.php


    });
    $app->group('/DiseñoExteriores', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $diseñoexteriores = new DisenoExteriores($app);
        $diseñoexteriores->Insertar($Auth); //Insertar Se va a Routes de DiseñoExteriores.php
        $diseñoexteriores->Listar($Auth); //Listar Se va a Routes de DiseñoExteriores.php
        $diseñoexteriores->Actualizar($Auth); //Actualizar Se va a Routes de DiseñoExteriores.php


    });
    $app->group('/Combustibles', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $combustible = new Combustibles($app);
        $combustible->Insertar($Auth); //Insertar Se va a Routes de Combustibles.php
        $combustible->Listar($Auth); //Listar Se va a Routes de Combustibles.php
        $combustible->Actualizar($Auth); //Actualizar Se va a Routes de Combustibles.php


    });
    $app->group('/Categorias', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $categoria = new Categorias($app);
        $categoria->Insertar($Auth); //Insertar Se va a Routes de Categorias.php
        $categoria->Listar($Auth); //Listar Se va a Routes de Categorias.php
        $categoria->Actualizar($Auth); //Actualizar Se va a Routes de Categorias.php


    });
    $app->group('/Autos', function () use ($app) { //usuarios es un recurso
        $Auth = new Auth();
        $auto = new Autos($app);
        $auto->Insertar($Auth); //Insertar Se va a Routes de Categorias.php
        $auto->Listar($Auth); //Listar Se va a Routes de Categorias.php
        $auto->Actualizar($Auth); //Actualizar Se va a Routes de Categorias.php


    });
});


$app->run();
