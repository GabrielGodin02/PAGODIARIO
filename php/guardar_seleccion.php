<?php
    include 'conexion.php';
    $estado =$_POST['estado'];
    $id_usuario =$_POST['id_usuario'];

    $update_sql = "UPDATE prestamo SET estado ='$estado' WHERE id_usuario ='$id_usuario'";
    $update_query = mysqli_query($conexion, $update_sql);

    if ($update_query) {
        echo '
        <script>
        alert("Solicitud Aceptada");
        window.location="../index.php";
        </script>
        '; // Envía una respuesta al cliente para indicar que se guardó con éxito
    } else {
        echo '
        <script>
        alert("Solicitud no Aceptada");
        window.location="../index.php";
        </script>
        ';
    }



 mysqli_close($conexion);
?>
