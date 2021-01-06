<?php
require_once(__DIR__ . "/Database.php");

class Auth
{
    public function __invoke($request, $response, $next)
    {
        //siempre es global $db;

        global $db;

        if ($request->hasHeader("Authorization")) {
            $Authorization = $request->getHeaderLine("Authorization");
            $Credenciales = explode(":", $Authorization);
            $query = $db->con->prepare("SELECT contraseña FROM usuarios WHERE correo = ?");
            $query->bind_param("s", $Credenciales[0]);
            $query->execute();
            $query->store_result();
            $query->bind_result($contraseña);
            $query->fetch();
            $count = $query->num_rows;

            if ($count > 0) {
                //esto es cuando esta correcto
                if (password_verify($Credenciales[1], $contraseña)) {
                    $response = $next($request, $response);
                    return $response;
                } else {
                    $response = $response->withJson("Contraseña incorrecta", 500);
                }
                
                return $response;
            } else {
                $response = $response->withJson("Usuario no autorizado", 500);
            }
            
        } else {
            $response = $response->withJson("Usuario no autorizado", 500);
        }

        return $response;
    }

   
}
