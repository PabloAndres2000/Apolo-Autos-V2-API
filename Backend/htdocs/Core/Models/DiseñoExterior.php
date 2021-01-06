<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class DisenoExterior
{
    //atributos
    public $iddiseño_exterior;
    public $color;
    public $neumaticos;
    public $focos;
    public $peso;
    public $motor;
    public $velocidades;
    public $idauto;

    public function Insertar()
    {
        //Siempre es global $db;
        global $db;

        $query = $db->con->prepare("INSERT INTO diseños_exteriores(color,neumaticos,focos,peso,motor,velocidades,idauto) values(?,?,?,?,?,?,?)");
        $query->bind_param("sssssssi", $this->color, $this->neumaticos, $this->focos, $this->peso, $this->motor, $this->velocidades, $this->idauto);

        if ($query->execute()) {
            $response = new Response(200, "Diseño exteriores agregada correctamente");
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
        //siempre es global $db;
        global $db;
        $query = $db->con->query("SELECT diseño.* car.precio FROM diseños_exteriores AS diseño INNER JOIN autos AS car ON car.idauto = diseño.idauto");
        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        
        if($query->num_rows > 0){
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200,$data);
        }else{
            $response = new Response(404,"No se han encontrado registros en los diseños exteriores");
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
        
        $query = $db->con->prepare("UPDATE diseños_exteriores SET color = ?, neumaticos = ?, focos = ?, peso = ?, motor = ?, velocidades = ?, idauto = ? WHERE iddiseño_exterior = ?");
        $query->bind_param("sssssssii",$this->color, $this->neumaticos, $this->focos, $this->peso, $this->motor, $this->velocidades, $this->idauto,$this->iddiseño_exterior);
        
        if($query->execute())
        {
            $response = new Response(200,"Actualizacion Exitosa");
        }else{
            $response = new Response(500,"Ha ocurrido un error");
        }

        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;

    }
}
