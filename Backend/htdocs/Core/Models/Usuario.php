<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class Usuario
{

    //atributos
    public $idusuario;
    public $nombre;
    public $correo;
    public $contraseña;

    public function Registro()
    {
        //siempre es global $db;
        global $db;
        $password_hash = password_hash($this->contraseña, PASSWORD_DEFAULT);
        $query = $db->con->prepare("INSERT INTO usuarios(nombre,correo,contraseña) values(?,?,?)");
        $query->bind_param("sss", $this->nombre, $this->correo, $password_hash);

        if ($query->execute()) {
            $response = new Response(200, "Usuario Agregado Con Exito");
        } else {
            $response = new Response(500, "Ha ocurrido Un Error");
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
        $query = $db->con->query("SELECT * FROM usuarios");
        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos

        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC); //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de usuarios");
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

        $query = $db->con->prepare("UPDATE usuarios SET nombre = ?, correo = ? WHERE idusuario = ?");
        $query->bind_param("ssi", $this->nombre, $this->correo,$this->idusuario);
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

    public function Login()
    {
        global $db;
        $query = $db->con->prepare("SELECT idusuario, nombre, correo, contraseña FROM usuarios WHERE correo = ?");
        $query->bind_param("s", $this->correo);
        $query->execute();
        $query->store_result();
        $count = $query->num_rows;

        if ($count > 0) {
            $query->bind_result($idusuario, $nombre, $correo, $contraseña);
            $query->fetch();

            if (password_verify($this->contraseña, $contraseña)) {
                $data = array("idusuario" => $idusuario, "nombre" => $nombre, "correo" => $correo);
                $response = new Response(200, $data);
                $_SESSION["LOGUEADO"] = true;
                $_SESSION["IDUSUARIO"] = $idusuario;
                $_SESSION["NOMBRE"] = $nombre;
                $_SESSION["CORREO"] = $correo;
                $db->con->close();
                $query->close();
            } else {
                $response = new Response(404, "Contraseña incorrecta");
                $db->con->close();
                $query->close();
            }
        } else {
            $response = new Response(404, "Usuario no existe");
            $db->con->close();
            $query->close();
        }


        return $response;
    }
}
