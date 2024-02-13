<?php
class Controller
{
    public function checkToken()
    {
        $token =$_SESSION["token"];
        $user = $_SESSION["user"]["ident"];
        $query = "SELECT * FROM inicio_sesion WHERE token = ? AND id_usuario = ?";

        $resultado = hacerConsulta($query, [$token, $user]);
        return $resultado;
    }
}
