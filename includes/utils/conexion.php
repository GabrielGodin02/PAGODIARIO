<?php
$host = "localhost";
$usr = "root";
$pw = "";
$db = "visual";

$conexion = mysqli_connect($host, $usr, $pw, $db);
function hacerConsulta($sql)
{
    global $conexion;
    $result = $conexion->query($sql);
    return $result;
}
