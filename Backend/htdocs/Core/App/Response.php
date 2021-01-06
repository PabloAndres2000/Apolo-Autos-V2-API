<?php 

class Response{

    
    //atributos
    private $status; // 200 = "OK".  404 = "No encontrado". 500 = "Error".
    private $data; //el body puede haber texto o datos
    private $response; // array con informacion de la consulta mi rey

    //recibe parametros
    public function __construct($status,$data)
    {
        //inicializacion de variables
        $this->status = $status;
        $this->data = $data;

        
    }
    public function makeResponse()
    {
        $this->response = array("response" => $this->data, "status" => $this->status);

        return $this->response;
    }
}

?>
