<?php
$host = "localhost";
$usr = "root";
$pw = "";
$db = "visual";

$conexion = mysqli_connect($host, $usr, $pw, $db);

function hacerConsulta($sql)
{
    $result = false;
    global $conexion;
    // verifica si el sql no es un intento de inyeccion sql
    $result = $conexion->query($sql);

    return $result;
}
