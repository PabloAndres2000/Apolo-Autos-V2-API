<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class Auto
{
    //atributos
    public $idauto;
    public $año;
    public $precio;
    public $cilindros;
    public $kilometraje;
    public $idcombustible;
    public $idcategoria;
    public $idtransmision;
    public $idestado_auto;
    public $idmodelo;
    
    public function Insertar()
    {
        //siempre es global $db;
        global $db;

        $query = $db->con->prepare("INSERT INTO autos(año,precio,cilindros,kilometraje,idcombustible,idcategoria,idtransmision,idestado_auto,idmodelo) values(?,?,?,?,?,?,?,?,?)");
        $query->bind_param("iiisiiiii",$this->año,$this->precio,$this->cilindros,$this->kilometraje,$this->idcombustible,$this->idcategoria,$this->idtransmision,$this->idestado_auto,$this->idmodelo);

        if($query->execute()){
            $response = new Response(200,"Autos agregados correctamente");
        }else{
            $response = new Response(500,"Ha ocurrido un error");
        }
        
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function Listar()
    {
        //siempre es global $db;

        global $db;

        $query = $db->con->query("SELECT car.*, combust.nombre AS combustible, categ.nombre AS categoria, transmi.nombre AS transmision, estado.nombre AS estadoauto, 
        model.nombre AS modelo FROM autos AS car INNER JOIN combustibles AS combust ON combust.idcombustible = car.idcombustible 
        INNER JOIN categorias AS categ ON categ.idcategoria = car.idcategoria INNER JOIN transmisiones AS transmi ON transmi.idtransmision = car.idtransmision
        INNER JOIN estados_autos AS estado ON estado.idestado_auto = car.idestado_auto INNER JOIN modelos AS model ON model.idmodelo = car.idmodelo");

        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);  //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de los autos");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }
    public function Actualizar()
    {
        //siempre es global $db;
        global $db;
        $query = $db->con->prepare("UPDATE autos SET año = ?, precio = ?, cilindros = ?, kilometraje = ?, idcombustible = ?, idcategoria = ?, idtransmision = ?, idestado_auto = ?, idmodelo = ? WHERE idauto = ?");
        $query->bind_param("iiisiiiiii",$this->año,$this->precio,$this->cilindros,$this->kilometraje,$this->idcombustible,$this->idcategoria,$this->idtransmision,$this->idestado_auto,$this->idmodelo,$this->idauto);
        
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