<?php
include 'conexion.php';
session_start();
$ident =  $_SESSION['user']['ident'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];


$update_sql = "UPDATE registro SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion',email='$email', fecha='$fecha', estado='$estado' WHERE ident='$ident'";
$update_query = mysqli_query($conexion, $update_sql);

if ($update_query) {

    $consulta = "SELECT * FROM registro WHERE ident='$ident'";
    
    $resultado = mysqli_query($conexion, $consulta);
    $_SESSION['user'] =  mysqli_fetch_array($resultado);

    echo '
    <script>
    alert("Informacion Actualizada");
    window.location="../perfil-usuario.php";
    </script>
    '; // Envía una respuesta al cliente para indicar que se guardó con éxito
} else {
    echo '
    <script>
    alert("Informacion no Actualizada");
    window.location="../perfil-usuario.php";
    </script>
    ';
}



mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>