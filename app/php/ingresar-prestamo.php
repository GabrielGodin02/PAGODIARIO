<?php
include 'conexion.php';
$id_usuario =$_POST['id_usuario'];
$direccion =$_POST['direccion'];
$telefono =$_POST['telefono'];
$dia_solicitado =$_POST['dia_solicitado'];
$hora =$_POST['hora'];
$cantida_prestamo =$_POST['cantida_prestamo'];


$query = "INSERT INTO prestamo (id_usuario,direccion, telefono,dia_solicitado, hora, cantida_prestamo) VALUES ('$id_usuario','$direccion', '$telefono','$dia_solicitado','$hora', '$cantida_prestamo')";


$ejecutar=mysqli_query($conexion, $query);
if($ejecutar){
    echo'
    <script>
    alert("Solicitud de prestamo envianda");
    window.location="../panel-control-usuario.php";
    </script>
    ';
}else{
    echo'
    <script>
    alert("Datos no Guardados");
    window.location="../panel-control-usuario.php";
    </script>
    ';
}

mysqli_close($conexion);
?>