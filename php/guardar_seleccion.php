<?php
    include 'conexion.php';
    $estado =$_POST['estado'];
    $id_prestamo =$_POST['id_prestamo'];

    $update_sql = "UPDATE prestamo SET estado ='$estado' WHERE id_prestamo ='$id_prestamo'";
    $update_query = mysqli_query($conexion, $update_sql);

    if ($update_query) {
        echo '
        <script>
        alert("Solicitud Aceptada");
        window.location="../admin.php";
        </script>
        '; // Envía una respuesta al cliente para indicar que se guardó con éxito
    } else {
        echo '
        <script>
        alert("Solicitud no Aceptada");
        window.location="../admin.php";
        </script>
        ';
    }



 mysqli_close($conexion);
?>
