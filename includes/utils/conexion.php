<?php
$host = "localhost";
$usr = "root";
$pw = "";
$db = "visual";

$conexion = mysqli_connect($host, $usr, $pw, $db);

function hacerConsulta($sql, $params = [])
{
    global $conexion;
    $result = false;
    $stmt = $conexion->prepare($sql);
    if ($stmt) {
        // Vincular parámetros si existen
        if (!empty($params)) {
            $tipos = str_repeat('s', count($params));
            $stmt->bind_param($tipos, ...$params);
        }

        // ejecutar y asignar valor si es un select
        $result = $stmt->execute();
        if ($stmt->field_count > 0) $result = $stmt->get_result();

        // Manejar errores
        if ($stmt->error) echo "Error en la consulta: " . $stmt->error;
        $stmt->close();
    } else echo "Error en la preparación de la consulta: " . $conexion->error;
    
    return $result;
    /*realizar una consulta my_sqli protegida    */
}
