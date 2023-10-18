<?php
include 'conexion.php';

$id=$_GET['id'];

$query = "DELETE FROM prestamo WHERE id_prestamo='$id' ";

$ejecutar=mysqli_query($conexion, $query);
if($ejecutar){
    echo'
    <script>
    alert("Datos Eliminados");
    window.location="../index.php";
    </script>
    ';
}else{
    echo'
    <script>
    alert("Datos no Eliminados");
    window.location="../index.php";
    </script>
    ';
}

mysqli_close($conexion);


?>