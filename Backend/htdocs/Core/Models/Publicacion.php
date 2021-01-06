<?php
require_once(__DIR__ . "/../App/Database.php");
require_once(__DIR__ . "/../App/Response.php");

$db = new Database();
/*
    El model recibe lo que le envio el controllers y se hace la conexion a la base de datos y luegos los datos ingresados 
    en el model se envia al controllador de nuevo
*/
class Publicacion
{
    //atributos
    public $idpublicacion;
    public $premium;
    public $fecha_publicacion;
    public $idauto;
    public $idregion;
    public $idtipo_vendedor;
    public $idusuario;
    public $titulo;
    public $descripcion;
    public $telefono;
    public $idforma_pago;
    public $imagenes;

    public function Insertar()
    {
        //Siempre es global $db;

        global $db;

        $query = $db->con->prepare("INSERT INTO publicaciones(premium,fecha_publicacion,idauto,idregion,idtipo_vendedor,idusuario,titulo,descripcion,telefono,idforma_pago) values(?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param("isiiiisssi", $premium, $fecha_publicacion, $idauto, $this->idregion, $this->idtipo_vendedor, $idusuario, $this->titulo, $this->descripcion, $this->telefono, $this->idforma_pago);
        $premium = 0;
        $idauto = $db->con->insert_id;
        $idusuario = $_SESSION['IDUSUARIO'];
        $fecha_publicacion = date('Y-m-d');

        if ($query->execute()) {

            $idpublicacion = $db->Con->insert_id;
            foreach ($this->imagenes['tmp_name'] as $imagen) {
                $image = $imagen;
                $img = base64_encode(file_get_contents(addslashes($image)));
                $query2 = $db->Con->prepare("INSERT INTO imagenes(images,idpublicacion) values(?,?)");
                $query2->bind_param("bi", $image, $idpublicacion);
                $query2->send_long_data(0, $img);

                $query2->execute();
                $response = new Response(200, "Publicacion agregada correctamente");
            }
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
        $query = $db->con->query("SELECT publi.*, a.año, r.nombre AS region, tipo.nombre AS tipovendedor,
        u.correo AS usuario, pago.nombre AS formapago FROM publicaciones AS publi INNER JOIN autos AS a ON a.idauto =  publi.idauto
        INNER JOIN regiones AS r ON r.idregion = publi.idregion INNER JOIN  
        tipo_vendedores AS tipo ON tipo.idtipo_vendedor = publi.idtipo_vendedor INNER JOIN usuarios AS u ON u.idusuario = publi.idusuario INNER JOIN formas_pagos 
        AS pago ON pago.idforma_pago = publi.idforma_pago");

        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);  //El feth_all trae toda la informacion que rescate la query DE SELECT. El MYSQLI_ASSOC Es para darle formatos a los datos por separado asociativamente por eso assoc.
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las publicaciones");
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

        $query = $db->con->prepare("UPDATE publicaciones SET premium = ?, fecha_publicacion = ?, idauto = ?, idregion = ?, idtipo_vendedor = ?, idusuario = ?, titulo = ?, descripcion = ?, telefono = ?, idforma_pago = ? WHERE idpublicacion = ?");
        $query->bind_param("isiiiisssii", $this->premium, $this->fecha_publicacion, $this->idauto, $this->idregion, $this->idtipo_vendedor, $this->idusuario, $this->titulo, $this->descripcion, $this->telefono, $this->idforma_pago, $this->idpublicacion);

        if ($query->execute()) {
            $response = new Response(200, "Su actualizacion a sido exitosa");
        } else {
            $response = new Response(500, "Ha ocurrido un error");
        }
        //se cierra la conexion a la base de datoss
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function ListarAuto()
    {
        //Siempre es global $db;
        global $db;
        $query = $db->Con->query("SELECT * FROM autos ORDER BY idauto DESC");

        //num_rows devuelve los numeros de  registros de la base de datos, cuando es mayor a 0 es por que existen datos
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las publicaciones de vehiculos");
        }
        //se cierra la conexion a la base de datoss
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function ListarPublicacionesPremium()
    {
        //Siempre es global $db;
        global $db;
        $query = $db->Con->query("SELECT * FROM publicaciones  WHERE premium=1 ORDER BY idpublicacion DESC ");

        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las publicaciones premium");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function ListarAutosDeUsuarios()
    {
        //siempre es global $db;
        global $db;
        $idusuario = $_SESSION['IDUSUARIO'];
        $query = $db->Con->query("SELECT * FROM publicaciones  WHERE idusuario=$idusuario ORDER BY idpublicacion DESC ");

        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de las publicaciones De los usuarios");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }
    
    public function VistaDePublicaciones()
    {
        //siempre es global $db;
        global $db;
        $idauto =$db->Con->insert_id;
        $idauto = $_GET['id'];
        $query = $db->Con->query("SELECT * FROM publicaciones WHERE idauto=$idauto");
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de los vehiculos");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }

    public function ListarPagoGratis()
    {
        //siempre es global $db;
        global $db;
        $query = $db->Con->query("SELECT * FROM formas_pagos WHERE nombre = 'gratis'");
        if ($query->num_rows > 0) {
            $data = $query->fetch_all(MYSQLI_ASSOC);
            $response = new Response(200, $data);
        } else {
            $response = new Response(404, "No se han encontrado registros de forma de pago gratuito");
        }
        //se cierra la conexion a la base de datos
        $db->con->close();
        //se cierra la consulta que se hace mediante la variable $query
        $query->close();
        return $response;
    }
}
