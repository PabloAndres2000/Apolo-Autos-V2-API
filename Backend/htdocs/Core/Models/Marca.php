<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class Marca
{
    //atributos
    public $idmarca;
    public $nombre;

    public function Insertar()
    {
        //siempre es global $db;
        global $db;

        $query = $db->con->prepare("INSERT INTO marcas(nombre) values(?)");
        $query->bind_param("s", $this->nombre);

        if ($query->execute()) {
            $response = new Response(200, "Marca agregada correctamente");
        } else {
            $response = new Response(500, "Ha ocurrido un error");
        }
        //se cierra la conexion a la base de datoss
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function Listar()
    {
        //siempre es global $db;
        global $db;

        //prepare es cuando se le envia datos. Como es una query no se usa el execute()
        $query = $db->con->query("SELECT * FROM marcas");

        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);  //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las marcas");
        }
        //se cierra la conexion a la base de datoss
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function Actualizar()
    {
        //siempre es global $db;
        global $db;

        $query = $db->con->prepare("UPDATE marcas SET nombre = ? WHERE idmarca = ?");
        $query->bind_param("si", $this->nombre, $this->idmarca);
        if ($query->execute()) {
            $response = new Response(200, "Su actualizacion ha sido exitosa");
        } else {
            $response = new Response(500, "A ocurrido un error");
        }

        //se cierra la conexion a la base de datoss
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }
}
