<?php
include 'conexion.php';
$nombre =$_POST['nombre'];
$apellidos =$_POST['apellidos'];
$ident =$_POST ['ident'];
$email =$_POST['email'];
$estado =$_POST['estado'];
$fecha =$_POST['fecha'];

$query = "INSERT INTO registro (nombre, apellidos, ident, email, estado, fecha) VALUES ('$nombre', '$apellidos', '$ident', '$email', '$estado', '$fecha')";



$ejecutar=mysqli_query($conexion, $query);
if($ejecutar){
    echo'
    <script>
    alert("Datos Guardados");
    window.location="../vistas/login.php";
    </script>
    ';
}else{
    echo'
    <script>
    alert("Datos no Guardados");
    window.location="../vistas/formulario.php";
    </script>
    ';
}

mysqli_close($conexion);


?>