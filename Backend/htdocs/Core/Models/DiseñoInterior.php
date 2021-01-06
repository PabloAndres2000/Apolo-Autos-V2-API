<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class DiseñoInterior
{
    //atributos 
    public $iddiseño_interior;
    public $capacidad;
    public $volante;
    public $radio;
    public $tapiz;
    public $airbags;
    public $idauto;

    public function Insertar()
    {
        //Siempre es global $db;

        global $db;

        $query = $db->con->prepare("INSERT INTO diseños_interiores(capacidad,volante,radio,tapiz,airbags,idauto) values(?,?,?,?,?,?)");
        $query->bind_param("sssssi", $this->capacidad, $this->volante, $this->radio, $this->tapiz, $this->airbags, $this->idauto);
        if ($query->execute()) {
            $response = new Response(200, "Diseños interiores fueron agregadas correctamente");
        } else {
            $response = new Response(500, "Ha ocurrido un error");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function Listar()
    {
        //Siempre es global $db;
        global $db;
        //prepare es cuando se le envia datos. Como es una query no se usa el execute()

        $query = $db->con->query("SELECT diseño.*, car.precio FROM diseños_interiores AS diseño INNER JOIN autos AS car ON car.idauto = diseño.idauto");
        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);  //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de los diseños interiores");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function Actualizar()
    {
        //Siempre es global $db;
        global $db;

        $query = $db->con->prepare("UPDATE diseños_interiores SET capacidad = ?, volante = ?, radio = ?, tapiz = ?, airbags = ? WHERE idauto = ?");
        $query->bind_param("sssssii", $this->capacidad, $this->volante, $this->radio, $this->tapiz, $this->airbags, $this->idauto);
        if ($query->execute()) {
            $response = new Response(200, "Su actualizacion ha sido exitosa");
        } else {
            $response = new Response(500, "Ha ocurrido un error");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }
}
