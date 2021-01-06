<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class Transmision
{
    //atributos
    public $idtransmision;
    public $nombre;

    public function Insertar()
    {
        //siempre es global $db;
        global $db;

        $query = $db->con->prepare("INSERT INTO transmisiones(nombre) values(?)");
        $query->bind_param("s", $this->nombre);

        if ($query->execute()) {
            $response = new Response(200, "Transmision agregada correctamente");
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
        $query = $db->con->query("SELECT * FROM transmisiones");

        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);  //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las transmisiones");
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

        $query = $db->con->prepare("UPDATE transmisiones SET nombre = ? WHERE idtransmision = ?");
        $query->bind_param("si", $this->nombre, $this->idtransmision);
        if ($query->execute()) {
            $response = new Response(200, "Su actualizacion a sido exitosa");
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
